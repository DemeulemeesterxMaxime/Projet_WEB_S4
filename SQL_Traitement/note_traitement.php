<?php
    session_start();
      $pdfText = ''; 
      //Test présence d'un fichier
      function estFichierSelectionne($fichier) {
        return !empty($fichier["name"]);
      }
      //Test type de fichier 
      function estTypeFichierAutorise($fichier, $typesAutorises) {
          $nomFichier = basename($fichier["name"]);
          $typeFichier = pathinfo($nomFichier, PATHINFO_EXTENSION);
          return in_array($typeFichier, $typesAutorises);
      }
      //Chargement de la bibliothèque
      function chargerBibliothequePdfParser() {
          include '../vendor/autoload.php';
      }
      //Extraction du texte
      if (isset($_POST['submit'])) {
          if (estFichierSelectionne($_FILES["pdf_file"])) {
            if (estTypeFichierAutorise($_FILES["pdf_file"], ['pdf'])) {
                  chargerBibliothequePdfParser();
      
                  // Initialisez et chargez la bibliothèque PDF Parser
                  $parser = new \Smalot\PdfParser\Parser(); 
                  
                  // Fichier PDF source pour extraire le texte
                  $fichier = $_FILES["pdf_file"]["tmp_name"]; 
                  
                  // Analysez le fichier PDF en utilisant la bibliothèque Parser
                  $pdf = $parser->parseFile($fichier); 
                  
                    
                    // Extract text from PDF 
                    $text = $pdf->getText(); 
      
                    // Add line break 
                    $pdfText = nl2br($text);
                    // Le texte extrait du PDF
                    // Expression régulière pour extraire la date
                    $regex_date = '/Date\s+(\d{2}\/\d{2}\/\d{4})/';
                    
                    // Expression régulière pour extraire le code
                    $regex_code = '/Code\s+(.*)/';
                    // Expression régulière pour extraire l'épreuve
                    $regex_epreuve = '/Épreuve\s+(.*)/';

                    // Expression régulière pour extraire la note
                    $regex_note = '/Note\s+([\d.]+)/';

                    // Expression régulière pour extraire le coefficient
                    $regex_coefficient = '/Coefficient\s+(\d+)/';

                    // Séparation du texte par ligne
                    $lignes = explode("\n", $text);

                    // Initialisation du tableau de résultats
                    $resultats = array();

                    // Parcours de chaque ligne pour extraire les informations
                    $code = $epreuve = $note = $coefficient = "undef";
                    foreach ($lignes as $ligne) {
                      if (preg_match($regex_date, $ligne, $matches)) {
                        $date = $matches[1];
                        $d = true;
                        //echo"$date<br>";
                        //$resultats[count($resultats)-1]['date'] = $matches[1];
                      } elseif (preg_match($regex_code, $ligne, $matches)) {
                        $code = $matches[1];
                        $code = str_replace(' ','',$code); //On supprimer les espaces venant d'erreur de scalp
                        $c = true; 
                        //echo"$code<br>";
                        //$resultats[count($resultats)-1]['code'] = $matches[1];
                      } elseif (preg_match($regex_epreuve, $ligne, $matches)) {
                        $epreuve = $matches[1];
                        $e = true; 
                        //echo"$epreuve<br>";
                        //$resultats[count($resultats)-1]['epreuve'] = $matches[1];
                      } elseif (preg_match($regex_note, $ligne, $matches)) {
                        $note = $matches[1];
                        $n = true; 
                        //echo"$note<br>";
                        //$resultats[count($resultats)-1]['note'] = $matches[1];
                      } elseif (preg_match($regex_coefficient, $ligne, $matches)) {
                        $coefficient = $matches[1]; 
                        $co = true; 
                        //echo"$coefficient<br>";
                        //$resultats[count($resultats)-1]['coefficient'] = $matches[1];


                        ///TRAITEMENT DES ERREURS D'ECRITURE DANS LE PDF
                        //si les valeurs ne change pas, ici on ne gere pas date car il a un format particulier
                        //dans le pire des cas on met la date la plus récente donc celle de l'eval d'avant
                      } else if(($code == "undef") || ($epreuve == "undef") || ($note == "undef") || ($coefficient == "undef")){
                        if($epreuve == "undef"){
                          $epreuve = "ERREUR DANS PDF";
                        } else if($code == "undef"){
                          $code = "ERREUR DANS PDF";
                        }
                      } elseif (($code != "undef") && ($epreuve != "undef") && ($note != "undef") && ($coefficient != "undef")) {
                        if(isset($_SESSION["id"])){
                          try{
                              require_once("fonctions.php");
                              require_once("DB_connect.php");
                              //Compléter ICI
                              $id1 = $_SESSION["id"]; //On prend l'id de l'url
                              //$id1 = 1;
                              $id_matiere = id_matiere($code);
                              //On met la date au bon format
                              $Cdate = convert_date($date);
                              //id_eval || :id_eval || ':id_eval'=> $var,
                              $requete = "INSERT INTO `eval` (`date_eval`,`code`,`epreuve`,`note`,`coef_eval`,`id_matiere`)VALUES(:date_eval, :code, :epreuve,:note, :coef_eval, :id_matiere)";
                              $req = $conn->prepare($requete);
                              $tabdesVals = array(':date_eval'=> $Cdate,':code'=>$code,':epreuve'=>$epreuve,':note' => $note, ':coef_eval'=>$coefficient,':id_matiere'=>$id_matiere);
                              $req->execute($tabdesVals);
                              
                              //Ici on va remplir la table eval_eleve avec les id
                              $id_eval = id_evaluation($code);
                              $requete = "INSERT INTO `eval_eleve`(`id_eval`, `id_eleve`)VALUES(:id_eval, :id_eleve)";
                              $req = $conn->prepare($requete);
                              $tabdesID = array(':id_eval'=> $id_eval,':id_eleve'=>$id1);
                              $req->execute($tabdesID);
                              // Appel de la fonction qui permet de supprimer les doubles
                              deleteDouble();
                              //on remet les var a false pour refaire un cycle d'ajout de note
                              $success = false;
                              $code = $epreuve = $note = $coefficient = "undef";
                              
                            
                            }                 
                            catch(Exception $e){
                              die("Erreur : " . $e->getMessage());
                            }
                            
                          
                          }  
                            
                      }
                    } 
                    $id=$_SESSION["id"]; 
                    //pour l'ajout des moyennes matieres 
                    for($i=1; $i<25; $i++){
                      UpdateMoyenne($id,$i);
                    }
                    //pour l'ajout des moyennes modules 
                    Moyenne_module($id);
                    Moyenne_generale($id);
                    sleep(1);
                    header("Location: ../Page_html/Page_PHP/add_note.php?format=2");
            } else {
              header("Location: ../Page_html/Page_PHP/add_note.php?format=0");
            }
          }
      }else{ 
          $statusMsg = '<p>Please select a PDF file to extract text.</p>'; 
      } 
?>
