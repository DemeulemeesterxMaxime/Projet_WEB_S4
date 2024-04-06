<?php
require("DB_connect.php");

//Fonction qui permet d'éviter les injections SQL
function valider_donnees($donnees){
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}

//Fonction qui permet de valider le format des emails junia
function verificationEmail($email){
	$patteremail1 = "/[a-zA-Z.-]+@[a-z.A-Z]*(junia.com)$/";
	$testemail = preg_match($patteremail1,$email);
	if ($testemail){
		return true;
	} else {
		return false;
	}
}

//Fonction qui à partir d'une email junia va extraire le nom et le prénom du nouvel inscrit
function extrairePrenomNom($email) {
  // Vérification de l'email
  if (preg_match("/^([a-zA-Z]+)\.([a-zA-Z]+)@student\.junia\.com$/", $email, $matches)) {
      $prenom = $matches[1];
      $nom = $matches[2];
      $prenom = ucfirst($prenom); //On utilise ucfirst pour passer le premier caractère en maj
      $nom = ucfirst($nom);
      return array('prenom' => $prenom, 'nom' => $nom);
  } else {
      return "Format d'email invalide.";
  }
}


//Fonction qui va permettre à partir d'un code d'une note de receullir toute 
//les informations liés et d'avoir un affichage pour les notes
function affichage_note($code){
  require("DB_connect.php");
  $id_mat = id_matiere($code);
  $id_mod = id_module($code);

  $reqsql = "SELECT matiere FROM module WHERE id_module = :id_mod";
  $req = $conn->prepare($reqsql);
  $req->execute(array(':id_mod'=>$id_mod));
  $resultat1 = $req->fetchALL(PDO::FETCH_ASSOC);
  $lastLigne = end($resultat1);
  $module = $lastLigne['matiere'];

  // Chercher dans la table matiere la matiere la ou l'id correspond à la valeur de l'id_matiere ce sera le résultat 2
  $reqsql = "SELECT matiere FROM matiere WHERE id_matiere=:id_matiere";
  $req = $conn -> prepare($reqsql);
  $req -> execute(array(':id_matiere'=>$id_mat));
  $resultat2 = $req->fetchALL(PDO::FETCH_ASSOC);
  $lastLigne = end($resultat2);
  $matiere = $lastLigne['matiere'];
  $conn = NULL;
  return $module . " - " . $matiere;
}
//CREATION DES TAGS afin de trouver à partir du code la matiere approprié

//Module Math
//S1
$TAG1_1_1 = 'MATH1';
$TAG1_1_2 = 'MATH2';
$TAG1_1_3 = 'S1_MATH_TP';
//S2
$TAG1_2_1 = 'MATH3';
$TAG1_2_2 = 'MATH4';
$TAG1_2_3 = 'S2_MATH_TP';
            
//module Physique
//S1
$TAG2_1_1 = 'OPTIQUE';
$TAG2_1_2 = 'ELEC_TP';
$TAG2_1_3 = 'ELEC';
//S2
$TAG2_2_1 = 'MECA';
$TAG2_2_2 = 'THERMO';
                  
//Module Info
//S1
$TAG3_1_1 = 'PROG1';
$TAG3_1_2 = 'S1_INFO_PRAT';
$TAG3_1_3 = 'S1_WEB_';
//S2
$TAG3_2_1 = 'PROG2';
$TAG3_2_2 = 'S2_INFO_PRAT';
$TAG3_2_3 =  'S2_INFO_WEB';
$TAG3_2_4 = 'null';//info embarqué 
$TAG3_2_5= 'null';//proj fin année
            
//Module MDP
//S1
$TAG4_1_1 = 'S1_ANGLAIS';
$TAG4_1_2 = 'S1_COMM';
$TAG4_1_3 = 'null';//sport
//S2
$TAG4_2_1 = 'S2_ANGLAIS';
$TAG4_2_2 = 'EPISTEMO';
$TAG4_2_3 = 'null';//sport
$TAG4_2_4 = 'null';//voltaire


//CREATION DU TABLEAU CONTEANT LES TAGS
$test_code_tag = array(
  //S2 MATH
  $TAG1_2_1, $TAG1_2_2, $TAG1_2_3,// 0 1 2 
  //S2 PHYSIQUE
  $TAG2_2_1, $TAG2_2_2, //3 4  
  //S2 INFO
  $TAG3_2_1, $TAG3_2_2, $TAG3_2_3, $TAG3_2_4, $TAG3_2_5, // 5 6 7 8 9 
  //S2 MDP
  $TAG4_2_1, $TAG4_2_2, $TAG4_2_3, $TAG4_2_4, //10 11 12 13 
  //S1 Math
  $TAG1_1_1, $TAG1_1_2, $TAG1_1_3, //14 15 16 
  //S1 Physique
  $TAG2_1_1, $TAG2_1_2, $TAG2_1_3, //17 18 19 
  //S1 INFO
  $TAG3_1_1, $TAG3_1_2, $TAG3_1_3, //20 21 22 
  //S1 MDP
  $TAG4_1_1, $TAG4_1_2, $TAG4_1_3, //23 24 25  
  //Classé dans cet ordre car la lecture du tableau va du début 
  //a la fin donc on évite des erreurs de tag en mettant les potenciel erreur au début
);

//Fonctions qui permet à partir du code d'extraire le tag comme EPISTEMO
function Tag($code) {
  global $test_code_tag; //on appele le tableau avec global
  foreach($test_code_tag as $regex) {
    //echo"<br>On parcourt $regex  dans $code<br>";
    if (preg_match('/'.$regex.'/', $code)) {
      return  $regex;
    }
  }
  return "Échec : aucune expression régulière trouvée";
}

//creation des tags à détecter pour l'anglais
//S1
$TAG4_1_1_1 = 'S1_ANGLAIS_GLOBAL_EXAM';
$TAG4_1_1_2_1 = 'S1_ANGLAIS_1_NOTE';
$TAG4_1_1_2_2 ='S1_ANGLAIS_2_NOTE';
$TAG4_1_1_2_3 ='S1_ANGLAIS_3_NOTE';
$TAG4_1_1_2_4 ='S1_ANGLAIS_4_NOTE';
$TAG4_1_1_2_5 ='S1_ANGLAIS_5_NOTE';
$TAG4_1_1_2_6 ='S1_ANGLAIS_6_NOTE';
$TAG4_1_1_2_7 ='S1_ANGLAIS_7_NOTE';
$TAG4_1_1_2_8 ='S1_ANGLAIS_8_NOTE';
$TAG4_1_1_3 = 'S1_ANGLAIS_TOEIC';

//S2
$TAG4_1_1_4 = 'S2_ANGLAIS_GLOBAL_EXAM';
$TAG4_1_1_5_1 = 'S2_ANGLAIS_1_NOTE';
$TAG4_1_1_5_2 ='S2_ANGLAIS_2_NOTE';
$TAG4_1_1_5_3 ='S2_ANGLAIS_3_NOTE';
$TAG4_1_1_5_4 ='S2_ANGLAIS_4_NOTE';
$TAG4_1_1_5_5 ='S2_ANGLAIS_5_NOTE';
$TAG4_1_1_5_6 ='S2_ANGLAIS_6_NOTE';
$TAG4_1_1_5_7 ='S2_ANGLAIS_7_NOTE';
$TAG4_1_1_5_8 ='S2_ANGLAIS_8_NOTE';
$TAG4_1_1_6 = 'S2_ANGLAIS_TOEIC';

//Création du tableau de tag d'anglais
$test_code_tag_Anglais = array(
  //S1
  $TAG4_1_1_1, // 0
  $TAG4_1_1_2_1, $TAG4_1_1_2_2, $TAG4_1_1_2_3, $TAG4_1_1_2_4, // 1 2 3 4 
  $TAG4_1_1_2_5, $TAG4_1_1_2_6, $TAG4_1_1_2_7, $TAG4_1_1_2_8, // 5 6 7 8
  $TAG4_1_1_3, //9

  //S2
  $TAG4_1_1_4, //10
  $TAG4_1_1_5_1, $TAG4_1_1_5_2, $TAG4_1_1_5_3, $TAG4_1_1_5_4, //11 12 13 14
  $TAG4_1_1_5_5, $TAG4_1_1_5_6, $TAG4_1_1_5_7, $TAG4_1_1_5_8, //15 16 17 18
  $TAG4_1_1_6 //19

);

//Fonction qui va détecter le tag précis lorsqu'une note d'anglais apparait
function Tag_Anglais($code) {
  global $test_code_tag_Anglais; //on appele le tableau avec global
  foreach($test_code_tag_Anglais as $regex) {
    //echo"<br>On parcourt $regex  dans $code<br>";
    if (preg_match('/'.$regex.'/', $code)) {
      return  $regex;
    }
  }
  return "Échec : aucune expression régulière Anglais trouvée";
}

//Fonctions qui va définir à partir du code si c'est un TP ou un autre typé de controle
function Type($code) {
    $test_code_type = array("PROJ","CC","TP","DS","P","INT");
    foreach($test_code_type as $regex) {
        if (preg_match('/'.$regex.'/', $code)) {
            return $regex;
        }
    }
    return;
}
//Fonctions qui prend le code de l"évaluation, en déduit son tag,
//nous renvois par association le numéro de la matiere entrée dans la base de donnée
function id_matiere($code){
  $matiere = Tag($code);
  $type= Type($code); 
  global $test_code_tag; //on appele le tableau avec global
  $id_matiere = ($test_code_tag[0] == $matiere) ? 4:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }
  $id_matiere = ($test_code_tag[1] == $matiere) ? 5:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }
  $id_matiere = ($test_code_tag[2] == $matiere) ? 6:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }

  $id_matiere = ($test_code_tag[3] == $matiere) ? 10:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }
  $id_matiere = ($test_code_tag[4] == $matiere) ? 11:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }

  $id_matiere = ($test_code_tag[5] == $matiere) ? 15:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }
  $id_matiere = ($test_code_tag[6] == $matiere) ? 16:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }
  $id_matiere = ($test_code_tag[7] == $matiere) ? 17:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }
  $id_matiere = ($test_code_tag[8] == $matiere) ? 18:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }
  $id_matiere = ($test_code_tag[9] == $matiere) ? 19:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }

  $id_matiere = ($test_code_tag[10] == $matiere) ? 23:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }
  $id_matiere = ($test_code_tag[11] == $matiere) ? 24:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }
  $id_matiere = ($test_code_tag[12] == $matiere) ? 25:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }
  $id_matiere = ($test_code_tag[13] == $matiere) ? 26:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }

  $id_matiere = ($test_code_tag[14] == $matiere) ? 1:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }
  $id_matiere = ($test_code_tag[15] == $matiere) ? 2:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }
  $id_matiere = ($test_code_tag[16] == $matiere) ? 3:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }

  $id_matiere = ($test_code_tag[17] == $matiere) ? 7:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }
  $id_matiere = ($test_code_tag[18] == $matiere ) ? 9:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }
  $id_matiere = ($test_code_tag[19] == $matiere) ? 8:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }

  $id_matiere = ($test_code_tag[20] == $matiere) ? 12:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }
  $id_matiere = ($test_code_tag[21] == $matiere) ? 13:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }
  $id_matiere = ($test_code_tag[22] == $matiere) ? 14:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }

  $id_matiere = ($test_code_tag[23] == $matiere) ? 20:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }
  $id_matiere = ($test_code_tag[24] == $matiere) ? 21:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }
  $id_matiere = ($test_code_tag[25] == $matiere) ? 22:'0';
  if($id_matiere != '0'){
    return $id_matiere;
  }
    
}
//Fonction qui en fonction de l'id de la matière va donner l'id du module 
function id_module($code){
  $id = id_matiere($code);
  $id_module = (($id>=1) && $id <=6) ? 1:'0';
  if($id_module != '0'){
    return $id_module;
  }
  $id_module = ($id>=7 && $id <=11) ? 2:'0';
  if($id_module != '0'){
    return $id_module;
  }
  $id_module = ($id>=12 && $id <=19) ? 3:'0';
  if($id_module != '0'){
    return $id_module;
  }
  $id_module = ($id>=20 && $id <=26) ? 4:'0';
  if($id_module != '0'){
    return $id_module;
  }
}

//Fonctions qui va donner le numéro de l'évaluation rentré dans la base de donnée 
function id_evaluation($code){
  require("DB_connect.php");
  $reqPrep="SELECT * FROM `eval` WHERE (CONVERT(`code` USING utf8) REGEXP '$code')";//La requere SQL: SELECT
  $req = $conn->prepare($reqPrep);//Préparer la requete
  $req->execute();//Executer la requete
  $resultat = $req->fetchALL(PDO::FETCH_ASSOC);//récupération du résultat
  foreach($resultat as $row){
	  $id_eval = $row["id_eval"];
  }
  $conn= NULL;
  return $id_eval;
}

//Convertit la date sous le bon forma sql des tables;
function convert_date($date){
  $date_objet = date_create_from_format('d/m/Y', $date);
  $date_convertie = $date_objet->format('Y-m-d');
  return ($date_convertie);
}

//Tableau qui va compter le nombre de note par matiere 
$cc_counts = array(
  'Fonda' => 0,
  'Analyse' => 0,
  'TPMATHS1' =>0,//2
  'Algebre' => 0,
  'Arith' => 0,
  'TPMATHS2' =>0,//7
  'Optique' => 0,
  'Elec' => 0,
  'TPE1' => 0,//10
  'Meca' => 0,
  'Thermo' => 0,
  'PFonda' => 0,
  'TPprogS1' => 0,//14
  'WebS1' => 0,
  'Approf' => 0,
  'TPprogS2' => 0,//17
  'WebS2' => 0,
  'InfoEmb' =>0,
  'Proj' =>0,
  'AngS1' => 0,
  'FH' => 0,
  'SportS1' => 0,
  'AngS2' => 0,
  'Epistemo' => 0,
  'SportS2' => 0,
  'Voltaire' => 0
);

//Tableau qui va cette fois contenir la somme des notes afin de crée une moyenne
$cc_sums = $cc_counts;

//Tableau qui va contenir les matiere (clé) que l'on va utiliser pour parcourir
//les tableaux précédents
$KEY = array(
    'Calibrage',
    'Fonda',
    'Analyse',
    'TPMATHS1',
    'Algebre',
    'Arith',
    'TPMATHS2',
    'Optique',
    'Elec',
    'TPE1',
    'Meca',
    'Thermo',
    'PFonda',
    'TPprogS1',
    'WebS1',
    'Approf',
    'TPprogS2',
    'WebS2',
    'InfoEmb',
    'Proj',
    'AngS1',
    'FH',
    'SportS1',
    'AngS2',
    'Epistemo',
    'SportS2',
    'Voltaire'
);

//Fonction qui prend un id de matiere, recherche les notes, pour chaque note la place dans un tableau
//ensuite on utilise le tableaux pour faire des moyennes et on calcules les moyenne générales
function moyenne_matiere($id,$id_content){
  global $test_code_tag_Anglais;
  $moy_finale_matiere = NULL;
  require("DB_connect.php");
  global $cc_counts;
  global $cc_sums;
  global $KEY;
  $projet1 = 0;
  $projet2=0; 
  
  $reqPrep="SELECT `note`,`coef_eval`,`code` FROM `eval` WHERE `id_matiere` = '$id_content'";//La requere SQL: SELECT
  $req = $conn->prepare($reqPrep);//Préparer la requete
  $req->execute();//Executer la requete
  $resultat = $req->fetchALL(PDO::FETCH_ASSOC);//récupération du résultat
  $nombre_note = count($resultat);

  //echo"<br>Le nombre de note est : $nombre_note<br>";
  
  //On parcours toute les notes de la matiere
  foreach($resultat as $row){
    $code = $row["code"];
    $note = $row["note"];
    $module = id_module($code);
    $matdumodule = id_matiere($code);
    $type = Type($code);
    $tag_matiere = Tag($code);
    $tag_Anglais = Tag_Anglais($code);
    //echo"<br> dans la boucle avec $note<br>";
    //Boucle qui va parcourir le nombre de matiere i,
    //si le code de la matiere est égale à i et que c'est CC ou un TP ou autre spécificité,
    //On fais la somme des notes et on incrémente la variable qui compte le nombre de note.
    for($i =0;$i<count($KEY);$i++){
      if($id_content == $i){
        if($type == "CC" || $type == "TP"|| $type == "INT"){//Si c'est un tp ou cc on fait la moy
          $cc_counts[$KEY[$i]]++;
          $cc_sums[$KEY[$i]]+= $note;
        }
        if($type =="DS"){
          $ds = $note;
        }
        if($type == "PROJ"){ //Si c'est un proj on trie la matiere pour savoir si c'est S1 ou S2 en WEB
          if($matdumodule == 14 ){
            $projet1 = $note;
          } 
          if($matdumodule == 17){
            $projet2 = $note;
            //echo"Note proj web 2 : $projet2<br>";
          }
        }
        if($type == "P"){ //Si c'est un partiel on incrémente
          $partiel = $note;
          //echo"on rentre le partiel qui a une note de $note qui a le code suivant : $code<br>";
        } 
        
        if($type == "ORAL" && $matdumodule == 21){
          $cc_counts[$KEY[$i]]++;
          $cc_sums[$KEY[$i]]+= $note;
          $x = $cc_sums[$KEY[$i]];
          //echo"La somme est de $sx pour la comm<br>";
        }
        if($type == "ORAL" && $matdumodule == 24){
          $cc_counts[$KEY[$i]]++;
          $cc_sums[$KEY[$i]]+= $note;
          //$x = $cc_sums[$KEY[$i]];
          //echo"La somme est de $sx pour l'episthemo<br>";
        }
        if($tag_matiere == "S1_ANGLAIS" || $tag_matiere == "S2_ANGLAIS"){
          if($tag_Anglais == $test_code_tag_Anglais[1] || 
            $tag_Anglais == $test_code_tag_Anglais[2] || 
            $tag_Anglais == $test_code_tag_Anglais[3] ||
            $tag_Anglais == $test_code_tag_Anglais[4] || 
            $tag_Anglais == $test_code_tag_Anglais[5] || 
            $tag_Anglais == $test_code_tag_Anglais[6] || 
            $tag_Anglais == $test_code_tag_Anglais[7] || 
            $tag_Anglais == $test_code_tag_Anglais[8]){
              $moyenne_note_ANG_S1 = $note;
          }
          if($tag_Anglais == $test_code_tag_Anglais[11] || 
            $tag_Anglais == $test_code_tag_Anglais[12] || 
            $tag_Anglais == $test_code_tag_Anglais[13] ||
            $tag_Anglais == $test_code_tag_Anglais[14] || 
            $tag_Anglais == $test_code_tag_Anglais[15] || 
            $tag_Anglais == $test_code_tag_Anglais[16] || 
            $tag_Anglais == $test_code_tag_Anglais[17] || 
            $tag_Anglais == $test_code_tag_Anglais[18]){
              $moyenne_note_ANG_S2 = $note;
          }
          if($tag_Anglais == $test_code_tag_Anglais[0]){
            //GLOBAL EXAM S1
            $GLOBAL_EXAM_S1 = $note;
          }
          if($tag_Anglais == $test_code_tag_Anglais[10]){
            //GLOBAL EXAM S2
            $GLOBAL_EXAM_S2 = $note;
          }
          if($tag_Anglais == $test_code_tag_Anglais[9]){
            //TOEIC S1
            $TOEIC_S1 = $note;
          }
          if($tag_Anglais == $test_code_tag_Anglais[19]){
            //TOEIC S2
            $TOEIC_S2 = $note;
          }
        }
      }
    }
  }
  //Moyenne ANGLAIS quand on a toute les notes, 
  //on ne traite pas le cas ou il en manque car 
  //elles sont ajouté en même temps
  if(in_array($id_content,[20,23])){
    if($id_content == 20){
      if(isset($TOEIC_S1) && isset($GLOBAL_EXAM_S1) && isset($moyenne_note_ANG_S1)){
        $moyenne_anglais = ($TOEIC_S1 * 0.5) + ($GLOBAL_EXAM_S1 * 0.2) + ($moyenne_note_ANG_S1 * 0.3);
        $moyenne_anglais = round($moyenne_anglais,2);
        return $moyenne_anglais;

      } else if(isset($moyenne_note_ANG_S1) && isset($GLOBAL_EXAM_S1) && empty($TOEIC_S1)){
        $moyenne_anglais = ($GLOBAL_EXAM_S1 * 0.4) + ($moyenne_note_ANG_S1 * 0.6);
        $moyenne_anglais = round($moyenne_anglais,2);
        return $moyenne_anglais;
        
      } else if(isset($moyenne_note_ANG_S1) && empty($GLOBAL_EXAM_S1) && empty($TOEIC_S1)){
        $moyenne_anglais = $moyenne_note_ANG_S1;
        $moyenne_anglais = round($moyenne_anglais,2);
        return $moyenne_anglais;

      }
    } else if($id_content == 23){
      if(isset($TOEIC_S1) && isset($GLOBAL_EXAM_S1) && isset($moyenne_note_ANG_S1)){
        $moyenne_anglais = ($TOEIC_S2 * 0.5) + ($GLOBAL_EXAM_S2 * 0.2) + ($moyenne_note_ANG_S2 * 0.3);
        $moyenne_anglais = round($moyenne_anglais,2);
        return $moyenne_anglais;

      }else if(isset($moyenne_note_ANG_S2) && isset($GLOBAL_EXAM_S2) && empty($TOEIC_S2)){
        $moyenne_anglais = ($GLOBAL_EXAM_S2 * 0.4) + ($moyenne_note_ANG_S2 * 0.6);
        $moyenne_anglais = round($moyenne_anglais,2);
        return $moyenne_anglais;

      } else if(isset($moyenne_note_ANG_S2) && empty($GLOBAL_EXAM_S) && empty($TOEIC_S2)){
        $moyenne_anglais = $moyenne_note_ANG_S2;
        $moyenne_anglais = round($moyenne_anglais,2);
        return $moyenne_anglais;
      }
      
    }
  }
  //Moyenne TP ELEC
  if(in_array($id_content,[3, 6, 9, 13, 16])){
    $count = $cc_counts[$KEY[$id_content]];
    if($count != 0){
      $moy_tp = $cc_sums[$KEY[$id_content]] / $count;
      $moy_finale_matiere = round($moy_tp, 2);
      return $moy_finale_matiere;
    } else {
      /* echo("Il n'y a aucune note de TP d'électronique"); */
    }
  }
  //Calcule la moy du controle continu
  if($cc_counts[$KEY[$id_content]] != 0 && ($type == "CC" || $type =="INT" || $type="ORAL")){
    $moy_cc = $cc_sums[$KEY[$id_content]] / $cc_counts[$KEY[$id_content]];
    //echo"Ensuite on fait la moyenne : $moy_cc<br>";
  }

  //Si on a la moy, le partiel et que l'on calcule une matiere du module math (pas de tp qui intervienne uniquement lors de la moy du mod)
  if(isset($moy_cc)  && isset($partiel) && in_array($id_content, [1, 2, 4, 5,7,10,11,26])){
    $moy_finale_matiere = $moy_cc * 0.4 + 0.6 *$partiel;
    $moy_finale_matiere = round($moy_finale_matiere, 2);
    return $moy_finale_matiere;
  } //Si nous n'avons pas la note de partiels alors nous ne la colculons pas  
  else if(isset($moy_cc) && empty($partiel) && in_array($id_content, [1, 2, 4, 5,7,10,11,26])){
    $moy_finale_matiere = $moy_cc;
    $moy_finale_matiere = round($moy_finale_matiere, 2);
    return $moy_finale_matiere;
  }

  //Pour la com qui fait 50 50 
  if(isset($moy_cc) && isset($partiel) && in_array($id_content,[21,24])){
    if($id_content == 21){//Compétence relationnelle
      $moy_finale_matiere = ($moy_cc + $partiel)/2;
      $moy_finale_matiere = round($moy_finale_matiere, 2);
      return $moy_finale_matiere;
    }
    if($id_content == 24){ //pour l'epistemo mais on sait pas comment ca va se passer 
      $moy_finale_matiere = ($moy_cc + $partiel)/2;
      $moy_finale_matiere = round($moy_finale_matiere, 2);
      return $moy_finale_matiere;
    }
  }else if(isset($moy_cc) && empty($partiel) && in_array($id_content, [21,24])){
    if($id_content == 21){
      $moy_finale_matiere = $moy_cc;
      $moy_finale_matiere = round($moy_finale_matiere, 2);
      return $moy_finale_matiere;
    }
    if($id_content == 24){ //pour l'epistemo mais on sait pas comment ca va se passer 
      $moy_finale_matiere = $moy_cc;
      $moy_finale_matiere = round($moy_finale_matiere, 2);
      return $moy_finale_matiere;
    }
  }
  

  //Matiere qui ont un ds dans leur module, on les détecte et on fait au cas pas cas sauf pour la prog et le web
  if(isset($moy_cc) && isset($ds) && isset($partiel) && in_array($id_content, [8, 12, 15])){
    //Electronique
    
    if($id_content == 8){
      $moy_finale_matiere = $moy_cc * 0.1 + ($ds * 0.33 + $partiel * 0.67) * 0.9;
      $moy_finale_matiere = round($moy_finale_matiere, 2);
      return $moy_finale_matiere;
    }

    //PROG
    if($id_content == 12 || $id_content == 15){
      $moy_finale_matiere = $moy_cc * 0.4 + 0.6 *(0.33 * $ds + $partiel * 0.67);
      $moy_finale_matiere = round($moy_finale_matiere, 2);
      return $moy_finale_matiere;
    }
  } else if(isset($moy_cc) && isset($ds) && empty($partiel) && in_array($id_content, [8, 12, 14, 15,17])){
    //Electronique avec ds sans partiels
    if($id_content == 8){
      $moy_finale_matiere = $moy_cc * 0.1 + ($ds) * 0.9;
      $moy_finale_matiere = round($moy_finale_matiere, 2);
      return $moy_finale_matiere;
    }

    //PROG si ds mais pas de partiels
    if($id_content == 12 || $id_content == 15){
      $moy_finale_matiere = $moy_cc * 0.4 + 0.6 *($ds);
      $moy_finale_matiere = round($moy_finale_matiere, 2);
      return $moy_finale_matiere;
    }
    //WEB si on a les projets 
    if(isset($projet1) || isset($projet2)){
      //WEB si ds mais pas de projet
      if($id_content == 14 || $id_content == 17 ){
        if($id_content == 14){
          if($projet1 == 0 ){ //Si pas de projet
            $moy_finale_matiere = (0.33 * $moy_cc + 0.67 * $ds);
            $moy_finale_matiere = round($moy_finale_matiere, 2);
            return $moy_finale_matiere;
          } else { //TEST GOOD sinon si projet alors moyenne complete
            $moy_finale_matiere = ((0.33 * $moy_cc) + (0.67 * $ds))*0.6 + 0.4 * $projet1;
            $moy_finale_matiere = round($moy_finale_matiere, 2);
            return $moy_finale_matiere;
          }
          
        } else {
          if($projet2 = 0){
            $moy_finale_matiere = (0.33 * $moy_cc + 0.66 * $ds);
            $moy_finale_matiere = round($moy_finale_matiere, 2);
            return $moy_finale_matiere;
          } else {
            $moy_finale_matiere = (0.33 * $moy_cc + 0.66 * $ds)*0.6 + 0.4 * $projet2;
            $moy_finale_matiere = round($moy_finale_matiere, 2);
            return $moy_finale_matiere;
          }
        }
      }
    }
  } else if(isset($moy_cc) && empty($partiel) && empty($ds) && in_array($id_content, [8, 12, 14, 15,17])){
    //Electronique juste avec moy
    if($id_content == 8){
      $moy_finale_matiere = $moy_cc;
      $moy_finale_matiere = round($moy_finale_matiere, 2);
      return $moy_finale_matiere;
    }

    //PROG juste avec moy
    if($id_content == 12 || $id_content == 15){
      $moy_finale_matiere = $moy_cc;
      $moy_finale_matiere = round($moy_finale_matiere, 2);
      return $moy_finale_matiere;
    }

    //WEB si juste moy
    if($id_content == 14 || $id_content == 17 ){
      if($id_content == 14){
        if($projet1 = 0 ){
          $moy_finale_matiere =$moy_cc;
          $moy_finale_matiere = round($moy_finale_matiere, 2);
          return $moy_finale_matiere;
        }
        
      } else {
        if($projet2 = 0){
          $moy_finale_matiere = $moy_cc;
          $moy_finale_matiere = round($moy_finale_matiere, 2);
          return $moy_finale_matiere;
        }
      }
    }
  $conn= NULL;
  }
}

//Fonction qui execute une requete sql spéciale, cette requete va supprimer les notes qui existent en double, 
//Lorsque qu'il y a deux notes en double elle va supprimer celle qui a le plus petit coef ou 
//si les coefs sont égaux la note avec le plus grand id_eval
function deleteDouble() {
  require("DB_connect.php");
  // Requête SQL à exécuter
  $sql = "DELETE e1
          FROM eval e1
          INNER JOIN eval e2 ON e1.code = e2.code
          INNER JOIN eval_eleve ee1 ON ee1.id_eval = e1.id_eval
          INNER JOIN eval_eleve ee2 ON ee2.id_eval = e2.id_eval AND ee1.id_eleve = ee2.id_eleve
          WHERE  (e1.coef_eval < e2.coef_eval)
              OR (e1.coef_eval = e2.coef_eval AND e1.id_eval > e2.id_eval)
              AND e1.id_eval IN (
                  SELECT * FROM (
                      SELECT e3.id_eval FROM eval e3
                      INNER JOIN eval e4 ON e3.code = e4.code AND e3.id_eval > e4.id_eval
                  ) AS temp
              )";
  $reqPrep = $conn -> prepare($sql);
  $reqPrep -> execute();
  // Fermeture de la connexion à la base de données
  $conn = NULL;
}
//Fonction qui va calculer la moyenne et mettre à jour la base de données
function UpdateMoyenne($id,$id_matiere){
  require("DB_connect.php");
  $moy = moyenne_matiere($id,$id_matiere);
  //echo($moy); 
  if($id != 0 && $id_matiere != 0 && isset($moy)){
    $req = "UPDATE `eleve_matiere` SET `moyenne_matiere` = :moy WHERE (`id_eleve` = :id AND `id_matiere` = :id_matiere)";
    $reqPrep = $conn -> prepare($req);
    $reqPrep -> execute(array(':id'=>$id,':moy'=>$moy,':id_matiere'=>$id_matiere));
    $conn = NULL;
  } else {
    if($moy == NULL){
      /* echo("Erreur d'ajout pour la matiere N° $id_matiere<br>");  */
    } else {
      /* echo("Erreur d'ajout pour la matiere N° $id_matiere autre que moy vaut null<br>");  */ 
    }
  }
}

function Moyenne_module($id){
  require("DB_connect.php");

  $nombredenotemodule1=0; 
  $sommemodule1=0; 

  $nombredenotemodule2=0; 
  $sommemodule2=0; 

  $nombredenotemodule3=0; 
  $sommemodule3=0; 

  $nombredenotemodule4=0; 
  $sommemodule4=0; 
  try{
    $req="SELECT * FROM eleve_matiere WHERE id_eleve=:id AND moyenne_matiere!='NULL'"; 
    $reqPrep = $conn -> prepare($req);
    $reqPrep -> execute(array(':id'=>$id));
    $resultat = $reqPrep->fetchAll(PDO::FETCH_ASSOC);
    //print_r($resultat); 
    foreach ($resultat as $row){
      //module de mathématiques 
      if($row['id_matiere']==1 || $row['id_matiere']==2  || $row['id_matiere']==4 || $row['id_matiere']==5 ){
        $sommemodule1+=$row['moyenne_matiere']*3; 
        $nombredenotemodule1+=3; 
      }
      if($row['id_matiere']==3 || $row['id_matiere']==6){
        $sommemodule1+=$row['moyenne_matiere']*2; 
        $nombredenotemodule1+=2; 
      }
      //module de physique 
      //optique 
      if($row['id_matiere']==7){
        $sommemodule2+=$row['moyenne_matiere']*2; 
        $nombredenotemodule2+=2; 
      }
      //méca et tp elec et electr
      if($row['id_matiere']==8 || $row['id_matiere']==9  || $row['id_matiere']==10){
        $sommemodule2+=$row['moyenne_matiere']*3; 
        $nombredenotemodule2+=3; 
      }
      //thermo 
      if($row['id_matiere']==11){
        $sommemodule2+=$row['moyenne_matiere']; 
        $nombredenotemodule2+=1; 
      }
      //module info 
      if($row['id_matiere']==12 || $row['id_matiere']==13){
        $sommemodule3+=$row['moyenne_matiere']*3; 
        $nombredenotemodule3+=3; 
      }
      if($row['id_matiere']==14 || $row['id_matiere']==15  || $row['id_matiere']==16 || $row['id_matiere']==17 || $row['id_matiere']==18 ){
        $sommemodule3+=$row['moyenne_matiere']*2; 
        $nombredenotemodule3+=2; 
      }
      //module communication
      if($row['id_matiere']==14 || $row['id_matiere']==20  || $row['id_matiere']==21 || $row['id_matiere']==22 || $row['id_matiere']==23 || $row['id_matiere']==24 || $row['id_matiere']==25){
        $sommemodule4+=$row['moyenne_matiere']*2; 
        $nombredenotemodule4+=2; 
      }
      if($row['id_matiere']==26){
        $sommemodule3+=$row['moyenne_matiere']; 
        $nombredenotemodule3+=1; 
      }
    }
    if($nombredenotemodule1!=0){
      $moyennemodule1=$sommemodule1/$nombredenotemodule1; 
      $moyennemodule1=round($moyennemodule1,2);
      //echo" 1 $moyennemodule1<br>"; 
      $req2="UPDATE `eleve_module` SET `moyenne_module` = :moyennemodule1 WHERE (`id_eleve` = :id AND `id_module` = '1')"; 
      $reqPrep2 = $conn -> prepare($req2);
      $reqPrep2 -> execute(array(':id'=>$id,':moyennemodule1'=>$moyennemodule1));
    }
    if($nombredenotemodule2!=0){
      $moyennemodule2=$sommemodule2/$nombredenotemodule2; 
      $moyennemodule2=round($moyennemodule2,2);
      //echo"2 $moyennemodule2<br>";
      $req3="UPDATE `eleve_module` SET `moyenne_module` = :moyennemodule2 WHERE (`id_eleve` = :id AND `id_module` = '2')"; 
      $reqPrep3 = $conn -> prepare($req3);
      $reqPrep3 -> execute(array(':id'=>$id,':moyennemodule2'=>$moyennemodule2)); 
    }
    if($nombredenotemodule3!=0){
      $moyennemodule3=$sommemodule3/$nombredenotemodule3; 
      $moyennemodule3=round($moyennemodule3,2);
      //echo"3 $moyennemodule3<br>"; 
      $req4="UPDATE `eleve_module` SET `moyenne_module` = :moyennemodule3 WHERE (`id_eleve` = :id AND `id_module` = '3')"; 
      $reqPrep4 = $conn -> prepare($req4);
      $reqPrep4 -> execute(array(':id'=>$id,':moyennemodule3'=>$moyennemodule3)); 
    }
    if($nombredenotemodule4!=0){
      $moyennemodule4=$sommemodule4/$nombredenotemodule4; 
      $moyennemodule4=round($moyennemodule4,2);
      //echo"4 $moyennemodule4<br>"; 
      $req5="UPDATE `eleve_module` SET `moyenne_module` = :moyennemodule4 WHERE (`id_eleve` = :id AND `id_module` = '4')"; 
      $reqPrep5 = $conn -> prepare($req5);
      $reqPrep5 -> execute(array(':id'=>$id,':moyennemodule4'=>$moyennemodule4)); 
    }
    
    $conn=NULL;
  }
  catch(Exception $e){
    die("Erreur : " . $e->getMessage());
  }
}

function Moyenne_generale($id){
  require("DB_connect.php");
  $module1 = $module2 = $module3 = $module4 = 0;
  $req = "SELECT `moyenne_module`,`id_module` FROM `eleve_module` WHERE `id_eleve` = :id";
  $reqPrep = $conn -> prepare($req);
  $reqPrep -> execute(array(':id' => $id));
  $resultat = $reqPrep -> fetchAll();

  // Attribution des moyennes à chaque module
  foreach ($resultat as $row) {
    switch ($row['id_module']) {
      case 1:
        $module1 = $row['moyenne_module'] * (16 * 100) / 60;
        /* echo"<br>$module1"; */
        break;
      case 2:
        $module2 = $row['moyenne_module'] * (12 * 100) / 60;
        /* echo"<br>$module2"; */
        break;
      case 3:
        $module3 = $row['moyenne_module'] * (19 * 100) / 60;
        /* echo"<br>$module3"; */
        break;
      case 4:
        $module4 = $row['moyenne_module'] * (13 * 100) / 60;
        /* echo"<br>$module4"; */
        break;
    }
  }

  // Calcul de la moyenne générale
  $moyenne_generale = ($module1 + $module2 + $module3 + $module4) / 100;
 /*  echo"<br>$moyenne_generale"; */
  $req = "UPDATE `eleve` SET `moyenne_generale` = :moyenne_generale WHERE `id_eleve` = :id";
  $reqPrep = $conn -> prepare($req);
  $reqPrep -> execute(array(':id'=>$id,':moyenne_generale'=>$moyenne_generale));
  $conn = NULL;
  return $moyenne_generale;
}

function fetch_matiere() {
  if(isset($_COOKIE["filtre_mat"])) {
    switch($_COOKIE["filtre_mat"]) {
      case "Fondamentaux":
        return 1;
      case "Analyse":
        return 2;
      case "Tp Maths":
        return 3;
      case "Algebre Lineaire":
        return 4;
      case "Arithmetique":
        return 5;
      case "Tp Maths S2":
        return 6;
      case "Optique":
        return 7;
      case "Electronique":
        return 8;
      case "Tp Electronique":
        return 9;
      case "Mecanique De Point":
        return 10;
      case "Thermodynamique":
        return 11;
      case "Fondamentaux Prog":
        return 12;
      case "Tp Programmation":
        return 13;
      case "Technologies Web":
        return 14;
      case "Approfondissement":
        return 15;
      case "Tp Programmation S2":
        return 16;
      case "Technologies Web S2":
        return 17;
      case "Informatique Embarque":
        return 18;
      case "Projet fin d'année":
        return 19;
      case "Anglais":
        return 20;
      case "Compétences Relationnelles":
        return 21;
      case "Sport":
        return 22;
      case "Anglais S2":
        return 23;
      case "Epistemimologie":
        return 24;
      case "Sport S2":
        return 25;
      case "Voltaire":
        return 26;
      default:
        //echo"<h2>pas de matiere</h2>";
        return false;
    }
  } else {
    //echo"<h2>pas de cookoe</h2>";
    return false;
  }
}

function fetch_module() {
  if(isset($_COOKIE["filtre_mod"])) {
    switch($_COOKIE["filtre_mod"]) {
      case "Mathematique":
        return 1;
      case "Physique":
        return 2;
      case "Informatique":
        return 3;
      case "Management et Développement Personnel":
        return 4;
      default:
        return false;
    }
  } else {
    return false;
  }
}

//On crée une fonction qui avec une note en paramètre  va le mettre dans la base de donéen
function add_note_line($text){
  require("DB_connect.php");
  
  $code = $epreuve = $note = $coefficient = "undef";
  
  $regex = "/Date\s+(\d{2}\/\d{2}\/\d{4})\s+Code\s+([^\s]+)\s+Épreuve\s+(.*?)\s+Note\s+(\d{1,2}\.\d{2})\s+Coefficient\s+(\d+)/";
  
  if (preg_match($regex, $text, $matches)) {
      $date = $matches[1];
      $code = $matches[2];
      $epreuve = trim($matches[3]); // utilise trim pour supprimer les espaces supplémentaires
      $note = $matches[4];
      $coefficient = $matches[5];
  
      echo"$date<br>";
      echo"$code<br>";
      echo"$epreuve<br>";
      echo"$note<br>";
      echo"$coefficient<br>";
  }
  


      ///TRAITEMENT DES ERREURS D'ECRITURE DANS LE PDF
      //si les valeurs ne change pas, ici on ne gere pas date car il a un format particulier
      //dans le pire des cas on met la date la plus récente donc celle de l'eval d'avant
    if(($code == "undef") || ($epreuve == "undef") || ($note == "undef") || ($coefficient == "undef")){
      if($epreuve == "undef"){
        $epreuve = "ERREUR DANS PDF";
      } else if($code == "undef"){
        $code = "ERREUR DANS PDF";
      }
    } if (($code != "undef") && ($epreuve != "undef") && ($note != "undef") && ($coefficient != "undef")) {
      if(isset($_SESSION["id"])){
        try{
            //echo'<br>On est dans le try<br>';
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
            echo'<br>On est dans la fin du try<br>';
          }                 
          catch(Exception $e){
            die("Erreur : " . $e->getMessage());
          }
          
        
      }  
          
    }
  
}
?>