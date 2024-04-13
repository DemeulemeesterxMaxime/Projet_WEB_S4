// Description: Ce fichier contient les fonctions utilisées pour le traitement des données dans le projet.
// Fonction qui permet de se connecter à la base de données
function DB_connect() {
  let conn = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "root",
    database: "jreuttus_projet_web_s4",
  });
  conn.connect((err) => {
    if (err) {
      console.error("Erreur de connexion à la base de données : " + err.stack);
      return;
    }

    console.log(
      "Connexion à la base de données réussie avec l'ID " + conn.threadId
    );
  });

  return conn;
}

// Fonction qui permet de valider les données entrées par l'utilisateur
function valider_donnees(donnees) {
  donnees = donnees.trim();
  donnees = donnees.replace(/\\/g, "");
  donnees = donnees.replace(/</g, "&lt;");
  donnees = donnees.replace(/>/g, "&gt;");
  donnees = donnees.replace(/"/g, "&quot;");
  return donnees;
}

// Fonction qui permet de valider le format des emails junia
function verificationEmail(email) {
  const patteremail1 = /[a-zA-Z.-]+@[a-z.A-Z]*(junia.com)$/;
  return patteremail1.test(email);
}

// Fonction qui permet d'extraire le prénom et le nom de l'email
function extrairePrenomNom(email) {
  // Vérification de l'email
  const matches = email.match(/^([a-zA-Z]+)\.([a-zA-Z]+)@student\.junia\.com$/);
  if (matches) {
    const prenom = matches[1].charAt(0).toUpperCase() + matches[1].slice(1);
    const nom = matches[2].charAt(0).toUpperCase() + matches[2].slice(1);
    return { prenom, nom };
  } else {
    return "Format d'email invalide.";
  }
}

// CREATION DES TAGS afin de trouver à partir du code la matiere approprié

// Module Math
// S1
const TAG1_1_1 = "MATH1";
const TAG1_1_2 = "MATH2";
const TAG1_1_3 = "S1_MATH_TP";
// S2
const TAG1_2_1 = "MATH3";
const TAG1_2_2 = "MATH4";
const TAG1_2_3 = "S2_MATH_TP";

// Module Physique
// S1
const TAG2_1_1 = "OPTIQUE";
const TAG2_1_2 = "ELEC_TP";
const TAG2_1_3 = "ELEC";
// S2
const TAG2_2_1 = "MECA";
const TAG2_2_2 = "THERMO";

// Module Info
// S1
const TAG3_1_1 = "PROG1";
const TAG3_1_2 = "S1_INFO_PRAT";
const TAG3_1_3 = "S1_WEB_";
// S2
const TAG3_2_1 = "PROG2";
const TAG3_2_2 = "S2_INFO_PRAT";
const TAG3_2_3 = "S2_INFO_WEB";
const TAG3_2_4 = "null"; // info embarqué
const TAG3_2_5 = "null"; // proj fin année

// Module MDP
// S1
const TAG4_1_1 = "S1_ANGLAIS";
const TAG4_1_2 = "S1_COMM";
const TAG4_1_3 = "null"; // sport
// S2
const TAG4_2_1 = "S2_ANGLAIS";
const TAG4_2_2 = "EPISTEMO";
const TAG4_2_3 = "null"; // sport
const TAG4_2_4 = "null"; // voltaire
// Création des tags à détecter pour l'anglais
// S1
const TAG4_1_1_1 = "S1_ANGLAIS_GLOBAL_EXAM";
const TAG4_1_1_2_1 = "S1_ANGLAIS_1_NOTE";
const TAG4_1_1_2_2 = "S1_ANGLAIS_2_NOTE";
const TAG4_1_1_2_3 = "S1_ANGLAIS_3_NOTE";
const TAG4_1_1_2_4 = "S1_ANGLAIS_4_NOTE";
const TAG4_1_1_2_5 = "S1_ANGLAIS_5_NOTE";
const TAG4_1_1_2_6 = "S1_ANGLAIS_6_NOTE";
const TAG4_1_1_2_7 = "S1_ANGLAIS_7_NOTE";
const TAG4_1_1_2_8 = "S1_ANGLAIS_8_NOTE";
const TAG4_1_1_3 = "S1_ANGLAIS_TOEIC";

// CREATION DU TABLEAU CONTENANT LES TAGS
const test_code_tag = [
  // S2 MATH
  TAG1_2_1,
  TAG1_2_2,
  TAG1_2_3, // 0 1 2
  // S2 PHYSIQUE
  TAG2_2_1,
  TAG2_2_2, // 3 4
  // S2 INFO
  TAG3_2_1,
  TAG3_2_2,
  TAG3_2_3,
  TAG3_2_4,
  TAG3_2_5, // 5 6 7 8 9
  // S2 MDP
  TAG4_2_1,
  TAG4_2_2,
  TAG4_2_3,
  TAG4_2_4, // 10 11 12 13
  // S1 Math
  TAG1_1_1,
  TAG1_1_2,
  TAG1_1_3, // 14 15 16
  // S1 Physique
  TAG2_1_1,
  TAG2_1_2,
  TAG2_1_3, // 17 18 19
  // S1 INFO
  TAG3_1_1,
  TAG3_1_2,
  TAG3_1_3, // 20 21 22
  // S1 MDP
  TAG4_1_1,
  TAG4_1_2,
  TAG4_1_3, // 23 24 25
];

// S2
const TAG4_1_1_4 = "S2_ANGLAIS_GLOBAL_EXAM";
const TAG4_1_1_5_1 = "S2_ANGLAIS_1_NOTE";
const TAG4_1_1_5_2 = "S2_ANGLAIS_2_NOTE";
const TAG4_1_1_5_3 = "S2_ANGLAIS_3_NOTE";
const TAG4_1_1_5_4 = "S2_ANGLAIS_4_NOTE";
const TAG4_1_1_5_5 = "S2_ANGLAIS_5_NOTE";
const TAG4_1_1_5_6 = "S2_ANGLAIS_6_NOTE";
const TAG4_1_1_5_7 = "S2_ANGLAIS_7_NOTE";
const TAG4_1_1_5_8 = "S2_ANGLAIS_8_NOTE";
const TAG4_1_1_6 = "S2_ANGLAIS_TOEIC";

// Création du tableau de tag d'anglais
const test_code_tag_Anglais = [
  // S1
  TAG4_1_1_1, // 0
  TAG4_1_1_2_1,
  TAG4_1_1_2_2,
  TAG4_1_1_2_3,
  TAG4_1_1_2_4, // 1 2 3 4
  TAG4_1_1_2_5,
  TAG4_1_1_2_6,
  TAG4_1_1_2_7,
  TAG4_1_1_2_8, // 5 6 7 8
  TAG4_1_1_3, // 9

  // S2
  TAG4_1_1_4, // 10
  TAG4_1_1_5_1,
  TAG4_1_1_5_2,
  TAG4_1_1_5_3,
  TAG4_1_1_5_4, // 11 12 13 14
  TAG4_1_1_5_5,
  TAG4_1_1_5_6,
  TAG4_1_1_5_7,
  TAG4_1_1_5_8, // 15 16 17 18
  TAG4_1_1_6, // 19
];
// Fonctions qui permet à partir du code d'extraire le tag comme EPISTEMO
function Tag(code) {
  for (const regex of test_code_tag) {
    if (new RegExp(regex).test(code)) {
      return regex;
    }
  }
  return "Échec : aucune expression régulière trouvée";
}

//Fonction qui va détecter le tag précis lorsqu'une note d'anglais apparait
function Tag_Anglais(code) {
  for (const regex of test_code_tag_Anglais) {
    if (new RegExp(regex).test(code)) {
      return regex;
    }
  }
  return "Échec : aucune expression régulière Anglais trouvée";
}

//Fonctions qui va définir à partir du code si c'est un TP ou un autre typé de controle
function Type(code) {
  const test_code_type = ["PROJ", "CC", "TP", "DS", "P", "INT"];
  for (const regex of test_code_type) {
    if (new RegExp(regex).test(code)) {
      return regex;
    }
  }
  return null;
}

//Fonctions qui prend le code de l"évaluation, en déduit son tag,
//nous renvois par association le numéro de la matiere entrée dans la base de donnée
function id_matiere(code) {
  const matiere = Tag(code);
  const type = Type(code);
  for (let i = 0; i < test_code_tag.length; i++) {
    if (test_code_tag[i] === matiere) {
      switch (i) {
        case 0:
          return 4;
        case 1:
          return 5;
        case 2:
          return 6;
        case 3:
          return 10;
        case 4:
          return 11;
        case 5:
          return 15;
        case 6:
          return 16;
        case 7:
          return 17;
        case 8:
          return 18;
        case 9:
          return 19;
        case 10:
          return 23;
        case 11:
          return 24;
        case 12:
          return 25;
        case 13:
          return 26;
        case 14:
          return 1;
        case 15:
          return 2;
        case 16:
          return 3;
        case 17:
          return 7;
        case 18:
          return 9;
        case 19:
          return 8;
        case 20:
          return 12;
        case 21:
          return 13;
        case 22:
          return 14;
        case 23:
          return 20;
        case 24:
          return 21;
        case 25:
          return 22;
        default:
          return 0;
      }
    }
  }
  return 0;
}

//Fonction qui en fonction de l'id de la matière va donner l'id du module
function id_module(code) {
  const id = id_matiere(code);
  if (id >= 1 && id <= 6) {
    return 1;
  } else if (id >= 7 && id <= 11) {
    return 2;
  } else if (id >= 12 && id <= 19) {
    return 3;
  } else if (id >= 20 && id <= 26) {
    return 4;
  } else {
    return 0;
  }
}

//Fonctions qui va donner le numéro de l'évaluation rentré dans la base de donnée
function id_evaluation(code) {
  let conn = DB_connect();

  // Effectuer une requête SQL pour récupérer l'ID de l'évaluation correspondant au code donné
  const query = "SELECT id_eval FROM eval WHERE code = ?";
  conn.query(query, [code], (err, results) => {
    if (err) {
      console.error(
        "Erreur lors de la récupération de l'ID de l'évaluation : " + err.stack
      );
      return;
    }

    if (results.length > 0) {
      // Renvoie l'ID de l'évaluation si elle a été trouvée
      const id_eval = results[0].id_eval;
      console.log("ID de l'évaluation : " + id_eval);
      conn.end();
      return id_eval;
    } else {
      // Renvoie une erreur si aucune évaluation correspondante n'a été trouvée
      console.error(
        "Aucune évaluation correspondante trouvée pour le code : " + code
      );
      conn.end();
      return null;
    }
  });
}
// Fonction qui va afficher le nom de la matière en fonction du code
function affichage_note(code, conn) {
  const id_mat = id_matiere(code);
  const id_mod = id_module(code);
  // Utiliser des promesses pour gérer les requêtes SQL asynchrones
  return new Promise((resolve, reject) => {
    if (id_mod !== 0 && id_mat !== 0) {
        const reqsql = "SELECT matiere FROM module WHERE id_module = ?";
        conn.query(reqsql, [id_mod], (err, results) => {
            if (err) {
                reject(err);
            } else {
                const resultat1 = results;
                const lastLigne = resultat1[resultat1.length - 1];
                const module = lastLigne.matiere;

                const reqsql2 = "SELECT matiere FROM matiere WHERE id_matiere = ?";
                conn.query(reqsql2, [id_mat], (err, results) => {
                if (err) {
                    reject(err);
                } else {
                    const resultat2 = results;
                    const lastLigne2 = resultat2[resultat2.length - 1];
                    const matiere = lastLigne2.matiere;

                    // Renvoie le résultat final en utilisant la fonction resolve()
                    resolve(module + " - " + matiere);
                }
                });
            }
        });
        }else {
            console.log("Erreur");
        }
    
  });
}

// Convertit la date sous le bon format SQL des tables
function convert_date(date) {
  let date_objet = new Date(date);
  let date_convertie = date_objet.toISOString().split("T")[0];
  return date_convertie;
}

// Tableau qui va compter le nombre de note par matiere
let cc_counts = {
  Fonda: 0,
  Analyse: 0,
  TPMATHS1: 0, //2
  Algebre: 0,
  Arith: 0,
  TPMATHS2: 0, //7
  Optique: 0,
  Elec: 0,
  TPE1: 0, //10
  Meca: 0,
  Thermo: 0,
  PFonda: 0,
  TPprogS1: 0, //14
  WebS1: 0,
  Approf: 0,
  TPprogS2: 0, //17
  WebS2: 0,
  InfoEmb: 0,
  Proj: 0,
  AngS1: 0,
  FH: 0,
  SportS1: 0,
  AngS2: 0,
  Epistemo: 0,
  SportS2: 0,
  Voltaire: 0,
};

// Tableau qui va cette fois contenir la somme des notes afin de créer une moyenne

let cc_sums = JSON.parse(JSON.stringify(cc_counts));
// Tableau qui va contenir les matiere (clé) que l'on va utiliser pour parcourir
// les tableaux précédents
let KEY = [
  "Calibrage",
  "Fonda",
  "Analyse",
  "TPMATHS1",
  "Algebre",
  "Arith",
  "TPMATHS2",
  "Optique",
  "Elec",
  "TPE1",
  "Meca",
  "Thermo",
  "PFonda",
  "TPprogS1",
  "WebS1",
  "Approf",
  "TPprogS2",
  "WebS2",
  "InfoEmb",
  "Proj",
  "AngS1",
  "FH",
  "SportS1",
  "AngS2",
  "Epistemo",
  "SportS2",
  "Voltaire",
];

// Fonction qui prend un id de matiere, recherche les notes, pour chaque note la place dans un tableau
// ensuite on utilise le tableaux pour faire des moyennes et on calcule les moyenne générales
function moyenne_matiere(id, id_content) {
  return new Promise((resolve, reject) => {
    let type;
    let code;
    let note;
    let ds;
    let module;
    let partiel;
    let moy_cc;
    let matdumodule;
    let moy_finale_matiere = null;
    const conn = DB_connect();
    let projet1 = 0;
    let projet2 = 0;

    let reqPrep =
      "SELECT `note`,`coef_eval`,`code` FROM `eval` WHERE `id_matiere` = ?";
    conn.query(reqPrep, [id_content], (err, resultat) => {
      if (err) {
        console.error("Erreur lors de l'exécution de la requête :", err);
        return;
      }

      let nombre_note = resultat.length;

      // On parcours toute les notes de la matiere
      for (let i = 0; i < nombre_note; i++) {
        code = resultat[i].code;
        note = resultat[i].note;
        module = id_module(code);
        matdumodule = id_matiere(code);
        type = Type(code);
        let tag_matiere = Tag(code);
        let tag_Anglais = Tag_Anglais(code);
        // Boucle qui va parcourir le nombre de matiere i,
        // si le code de la matiere est égale à i et que c'est CC ou un TP ou autre spécificité,
        // on fais la somme des notes et on incrémente la variable qui compte le nombre de note.
        for (let i = 0; i < KEY.length; i++) {
          if (id_content == i) {
            if (type == "CC" || type == "TP" || type == "INT") {
              // Si c'est un tp ou cc on fait la moy
              cc_counts[KEY[i]]++;
              cc_sums[KEY[i]] += note;
            }
            if (type == "DS") {
              ds = note;
            }
            if (type == "PROJ") {
              // Si c'est un proj on trie la matiere pour savoir si c'est S1 ou S2 en WEB
              if (matdumodule == 14) {
                projet1 = note;
              }
              if (matdumodule == 17) {
                projet2 = note;
              }
            }
            if (type == "P") {
              // Si c'est un partiel on incrémente
              partiel = note;
            }

            if (type == "ORAL" && matdumodule == 21) {
              cc_counts[KEY[i]]++;
              cc_sums[KEY[i]] += note;
              x = cc_sums[KEY[i]];
            }
            if (type == "ORAL" && matdumodule == 24) {
              cc_counts[KEY[i]]++;
              cc_sums[KEY[i]] += note;
            }
            if (tag_matiere == "S1_ANGLAIS" || tag_matiere == "S2_ANGLAIS") {
              if (
                tag_Anglais == test_code_tag_Anglais[1] ||
                tag_Anglais == test_code_tag_Anglais[2] ||
                tag_Anglais == test_code_tag_Anglais[3] ||
                tag_Anglais == test_code_tag_Anglais[4] ||
                tag_Anglais == test_code_tag_Anglais[5] ||
                tag_Anglais == test_code_tag_Anglais[6] ||
                tag_Anglais == test_code_tag_Anglais[7] ||
                tag_Anglais == test_code_tag_Anglais[8]
              ) {
                moyenne_note_ANG_S1 = note;
              }
              if (
                tag_Anglais == test_code_tag_Anglais[11] ||
                tag_Anglais == test_code_tag_Anglais[12] ||
                tag_Anglais == test_code_tag_Anglais[13] ||
                tag_Anglais == test_code_tag_Anglais[14] ||
                tag_Anglais == test_code_tag_Anglais[15] ||
                tag_Anglais == test_code_tag_Anglais[16] ||
                tag_Anglais == test_code_tag_Anglais[17] ||
                tag_Anglais == test_code_tag_Anglais[18]
              ) {
                moyenne_note_ANG_S2 = note;
              }
              if (tag_Anglais == test_code_tag_Anglais[0]) {
                //GLOBAL EXAM S1
                GLOBAL_EXAM_S1 = note;
              }
              if (tag_Anglais == test_code_tag_Anglais[10]) {
                //GLOBAL EXAM S2
                GLOBAL_EXAM_S2 = note;
              }
              if (tag_Anglais == test_code_tag_Anglais[9]) {
                //TOEIC S1
                TOEIC_S1 = note;
              }
              if (tag_Anglais == test_code_tag_Anglais[19]) {
                //TOEIC S2
                TOEIC_S2 = note;
              }
            }
          }
        }
      }

      // Moyenne ANGLAIS quand on a toute les notes,
      // on ne traite pas le cas ou il en manque car
      // elles sont ajouté en même temps
      // Vérifie si id_content est présent dans le tableau [20, 23]
      if ([20, 23].includes(id_content)) {
        if (id_content === 20) {
          if (
            TOEIC_S1 !== undefined &&
            GLOBAL_EXAM_S1 !== undefined &&
            moyenne_note_ANG_S1 !== undefined
          ) {
            moyenne_anglais =
              TOEIC_S1 * 0.5 + GLOBAL_EXAM_S1 * 0.2 + moyenne_note_ANG_S1 * 0.3;
            moyenne_anglais = (moyenne_anglais * 100) / 100;
            return moyenne_anglais;
          } else if (
            moyenne_note_ANG_S1 !== undefined &&
            GLOBAL_EXAM_S1 !== undefined &&
            !TOEIC_S1
          ) {
            moyenne_anglais = GLOBAL_EXAM_S1 * 0.4 + moyenne_note_ANG_S1 * 0.6;
            moyenne_anglais = (moyenne_anglais * 100) / 100;
            return moyenne_anglais;
          } else if (
            moyenne_note_ANG_S1 !== undefined &&
            !GLOBAL_EXAM_S1 &&
            !TOEIC_S1
          ) {
            moyenne_anglais = moyenne_note_ANG_S1;
            moyenne_anglais = (moyenne_anglais * 100) / 100;
            return moyenne_anglais;
          }
        } else if (id_content === 23) {
          if (
            TOEIC_S2 !== undefined &&
            GLOBAL_EXAM_S2 !== undefined &&
            moyenne_note_ANG_S2 !== undefined
          ) {
            moyenne_anglais =
              TOEIC_S2 * 0.5 + GLOBAL_EXAM_S2 * 0.2 + moyenne_note_ANG_S2 * 0.3;
            moyenne_anglais = (moyenne_anglais * 100) / 100;
            return moyenne_anglais;
          } else if (
            moyenne_note_ANG_S2 !== undefined &&
            GLOBAL_EXAM_S2 !== undefined &&
            !TOEIC_S2
          ) {
            moyenne_anglais = GLOBAL_EXAM_S2 * 0.4 + moyenne_note_ANG_S2 * 0.6;
            moyenne_anglais = (moyenne_anglais * 100) / 100;
            return moyenne_anglais;
          } else if (
            moyenne_note_ANG_S2 !== undefined &&
            !GLOBAL_EXAM_S2 &&
            !TOEIC_S2
          ) {
            moyenne_anglais = moyenne_note_ANG_S2;
            moyenne_anglais = (moyenne_anglais * 100) / 100;
            return moyenne_anglais;
          }
        }
      }

      // Moyenne TP ELEC
      if ([3, 6, 9, 13, 16].includes(id_content)) {
        let count = cc_counts[KEY[id_content]];
        if (count !== 0) {
          let moy_tp = cc_sums[KEY[id_content]] / count;
          moy_finale_matiere = (moy_tp * 100) / 100;
          resolve(moy_finale_matiere);
        } else {
          console.log("Il n'y a aucune note de TP d'électronique");
        }
      }
      // Calcule la moy du controle continu
      if (
        cc_counts[KEY[id_content]] !== 0 &&
        (type === "CC" || type === "INT" || type === "ORAL")
      ) {
        moy_cc = cc_sums[KEY[id_content]] / cc_counts[KEY[id_content]];
      }

      // Si on a la moy, le partiel et que l'on calcule une matiere du module math (pas de tp qui intervienne uniquement lors de la moy du mod)
      if (
        moy_cc !== undefined &&
        partiel !== undefined &&
        [1, 2, 4, 5, 7, 10, 11, 26].includes(id_content)
      ) {
        //console.log("Moyenne du controle continu :", moy_cc);
        moy_finale_matiere = moy_cc * 0.4 + 0.6 * partiel;
        moy_finale_matiere = (moy_finale_matiere * 100) / 100;
        resolve(moy_finale_matiere);
      } else if (
        moy_cc !== undefined &&
        !partiel &&
        [1, 2, 4, 5, 7, 10, 11, 26].includes(id_content)
      ) {
        moy_finale_matiere = moy_cc;
        moy_finale_matiere = (moy_finale_matiere * 100) / 100;
        resolve(moy_finale_matiere);
      }

      // Pour la com qui fait 50 50
      if (
        moy_cc !== undefined &&
        partiel !== undefined &&
        [21, 24].includes(id_content)
      ) {
        if (id_content === 21 || id_content === 24) {
          moy_finale_matiere = (moy_cc + partiel) / 2;
          moy_finale_matiere = (moy_finale_matiere * 100) / 100;
          resolve(moy_finale_matiere);
        }
      } else if (
        moy_cc !== undefined &&
        !partiel &&
        [21, 24].includes(id_content)
      ) {
        if (id_content === 21 || id_content === 24) {
          moy_finale_matiere = moy_cc;
          moy_finale_matiere = (moy_finale_matiere * 100) / 100;
          resolve(moy_finale_matiere);
        }
      }

      // Matiere qui ont un ds dans leur module, on les détecte et on fait au cas pas cas sauf pour la prog et le web
      if (
        moy_cc !== undefined &&
        ds !== undefined &&
        partiel !== undefined &&
        [8, 12, 15].includes(id_content)
      ) {
        if (id_content === 8 || id_content === 12 || id_content === 15) {
          moy_finale_matiere =
            moy_cc * 0.1 + (ds * 0.33 + partiel * 0.67) * 0.9;
          moy_finale_matiere = (moy_finale_matiere * 100) / 100;
          resolve(moy_finale_matiere);
        }
      } else if (
        moy_cc !== undefined &&
        ds !== undefined &&
        !partiel &&
        [8, 12, 14, 15, 17].includes(id_content)
      ) {
        if (id_content === 8 || id_content === 12 || id_content === 15) {
          moy_finale_matiere =
            moy_cc * 0.4 + 0.6 * (0.33 * ds + partiel * 0.67);
          moy_finale_matiere = (moy_finale_matiere * 100) / 100;
          resolve(moy_finale_matiere);
        }
        if ([14, 17].includes(id_content)) {
          if (id_content === 14) {
            if (projet1 === 0) {
              moy_finale_matiere = 0.33 * moy_cc + 0.67 * ds;
              moy_finale_matiere = (moy_finale_matiere * 100) / 100;
              resolve(moy_finale_matiere);
            } else {
              moy_finale_matiere =
                (0.33 * moy_cc + 0.67 * ds) * 0.6 + 0.4 * projet1;
              moy_finale_matiere = (moy_finale_matiere * 100) / 100;
              resolve(moy_finale_matiere);
            }
          } else {
            if (projet2 === 0) {
              moy_finale_matiere = 0.33 * moy_cc + 0.66 * ds;
              moy_finale_matiere = (moy_finale_matiere * 100) / 100;
              resolve(moy_finale_matiere);
            } else {
              moy_finale_matiere =
                (0.33 * moy_cc + 0.66 * ds) * 0.6 + 0.4 * projet2;
              moy_finale_matiere = (moy_finale_matiere * 100) / 100;
              resolve(moy_finale_matiere);
            }
          }
        }
      } else if (
        moy_cc !== undefined &&
        !ds &&
        !partiel &&
        [8, 12, 14, 15, 17].includes(id_content)
      ) {
        if (id_content === 8 || id_content === 12 || id_content === 15) {
          moy_finale_matiere = moy_cc;
          moy_finale_matiere = (moy_finale_matiere * 100) / 100;
          resolve(moy_finale_matiere);
        }
        if ([14, 17].includes(id_content)) {
          if (id_content === 14) {
            if (projet1 === 0) {
              moy_finale_matiere = moy_cc;
              moy_finale_matiere = (moy_finale_matiere * 100) / 100;
              resolve(moy_finale_matiere);
            }
          } else {
            if (projet2 === 0) {
              moy_finale_matiere = moy_cc;
              moy_finale_matiere = (moy_finale_matiere * 100) / 100;
              resolve(moy_finale_matiere);
            }
          }
        }
      }
      console.log("Moyenne de la matière :", moy_finale_matiere);
      conn.end();
    });
  });
}

// Fonction qui va supprimer les doublons dans la base de donnée
function deleteDouble() {
  let conn = DB_connect();

  let sql =
    "DELETE e1 FROM eval e1 INNER JOIN eval e2 ON e1.code = e2.code INNER JOIN eval_eleve ee1 ON ee1.id_eval = e1.id_eval INNER JOIN eval_eleve ee2 ON ee2.id_eval = e2.id_eval AND ee1.id_eleve = ee2.id_eleve WHERE (e1.coef_eval < e2.coef_eval) OR (e1.coef_eval = e2.coef_eval AND e1.id_eval > e2.id_eval) AND e1.id_eval IN (SELECT * FROM (SELECT e3.id_eval FROM eval e3 INNER JOIN eval e4 ON e3.code = e4.code AND e3.id_eval > e4.id_eval) AS temp)";

  conn.query(sql, function (error, results, fields) {
    if (error) throw error;
    console.log("Les doublons ont été supprimés");
  });

  conn.end();
}

let moy = 0;
// Fonction qui va mettre à jour la moyenne de la matière
function UpdateMoyenne(id, id_matiere) {
  let conn = DB_connect();
  moyenne_matiere(id, id_matiere)
    .then((resultat) => {
      moy = resultat;

      if (id !== 0 && id_matiere !== 0 && moy !== undefined) {
        let req =
          "UPDATE `eleve_matiere` SET `moyenne_matiere` = ? WHERE (`id_eleve` = ? AND `id_matiere` = ?)";

        conn.query(
          req,
          [moy, id, id_matiere],
          function (error, results, fields) {
            if (error) throw error;
            console.log("La moyenne a été mise à jour à :", moy);
          }
        );
      } else {
        if (moy === null) {
          console.log(`Erreur de mise à jour pour la matière N° ${id_matiere}`);
        } else {
          console.log(
            `Erreur de mise à jour pour la matière N° ${id_matiere} autre que moy vaut null`
          );
        }
      }

      conn.end();
    })
    .catch((erreur) => {
      console.error("Erreur :", erreur);
    });
}

// Fonction qui va mettre à jour la moyenne du module
function Moyenne_module(id) {
  let conn = DB_connect();
  let sommemodule1 = 0;
  let nombredenotemodule1 = 0;
  let sommemodule2 = 0;
  let nombredenotemodule2 = 0;
  let sommemodule3 = 0;
  let nombredenotemodule3 = 0;
  let sommemodule4 = 0;
  let nombredenotemodule4 = 0;

  const req =
    "SELECT * FROM eleve_matiere WHERE id_eleve=? AND moyenne_matiere!='NULL'";
  conn.query(req, [id], (error, results, fields) => {
    if (error) throw error;
    results.forEach((row) => {
      if (
        row.id_matiere === 1 ||
        row.id_matiere === 2 ||
        row.id_matiere === 4 ||
        row.id_matiere === 5
      ) {
        sommemodule1 += row.moyenne_matiere * 3;
        nombredenotemodule1 += 3;
      }
      if (row.id_matiere === 3 || row.id_matiere === 6) {
        sommemodule1 += row.moyenne_matiere * 2;
        nombredenotemodule1 += 2;
      }
      if (row.id_matiere === 7) {
        sommemodule2 += row.moyenne_matiere * 2;
        nombredenotemodule2 += 2;
      }
      if (
        row.id_matiere === 8 ||
        row.id_matiere === 9 ||
        row.id_matiere === 10
      ) {
        sommemodule2 += row.moyenne_matiere * 3;
        nombredenotemodule2 += 3;
      }
      if (row.id_matiere === 11) {
        sommemodule2 += row.moyenne_matiere;
        nombredenotemodule2 += 1;
      }
      if (row.id_matiere === 12 || row.id_matiere === 13) {
        sommemodule3 += row.moyenne_matiere * 3;
        nombredenotemodule3 += 3;
      }
      if (
        row.id_matiere === 14 ||
        row.id_matiere === 15 ||
        row.id_matiere === 16 ||
        row.id_matiere === 17 ||
        row.id_matiere === 18
      ) {
        sommemodule3 += row.moyenne_matiere * 2;
        nombredenotemodule3 += 2;
      }
      if (
        row.id_matiere === 14 ||
        row.id_matiere === 20 ||
        row.id_matiere === 21 ||
        row.id_matiere === 22 ||
        row.id_matiere === 23 ||
        row.id_matiere === 24 ||
        row.id_matiere === 25
      ) {
        sommemodule4 += row.moyenne_matiere * 2;
        nombredenotemodule4 += 2;
      }
      if (row.id_matiere === 26) {
        sommemodule3 += row.moyenne_matiere;
        nombredenotemodule3 += 1;
      }
    });

    if (nombredenotemodule1 !== 0) {
      const moyennemodule1 = (sommemodule1 / nombredenotemodule1).toFixed(2);
      const req2 =
        "UPDATE `eleve_module` SET `moyenne_module` = ? WHERE (`id_eleve` = ? AND `id_module` = '1')";
      conn.query(req2, [moyennemodule1, id], (error, results, fields) => {
        if (error) throw error;
      });
      console.log("moyenne module 1", moyennemodule1);
    }

    if (nombredenotemodule2 !== 0) {
      const moyennemodule2 = (sommemodule2 / nombredenotemodule2).toFixed(2);
      const req3 =
        "UPDATE `eleve_module` SET `moyenne_module` = ? WHERE (`id_eleve` = ? AND `id_module` = '2')";
      conn.query(req3, [moyennemodule2, id], (error, results, fields) => {
        if (error) throw error;
      });
      console.log("moyenne module 2", moyennemodule2);
    }

    if (nombredenotemodule3 !== 0) {
      const moyennemodule3 = (sommemodule3 / nombredenotemodule3).toFixed(2);
      const req4 =
        "UPDATE `eleve_module` SET `moyenne_module` = ? WHERE (`id_eleve` = ? AND `id_module` = '3')";
      conn.query(req4, [moyennemodule3, id], (error, results, fields) => {
        if (error) throw error;
      });
      console.log("moyenne module 3", moyennemodule3);
    }

    if (nombredenotemodule4 !== 0) {
      const moyennemodule4 = (sommemodule4 / nombredenotemodule4).toFixed(2);
      const req5 =
        "UPDATE `eleve_module` SET `moyenne_module` = ? WHERE (`id_eleve` = ? AND `id_module` = '4')";
      conn.query(req5, [moyennemodule4, id], (error, results, fields) => {
        if (error) throw error;
      });
      console.log("moyenne module 4", moyennemodule4);
    }

    conn.end();
  });
}

// Fonction qui va mettre à jour la moyenne générale
function Moyenne_generale(id) {
  let conn = DB_connect();

  let module1 = (module2 = module3 = module4 = 0);
  const req =
    "SELECT `moyenne_module`,`id_module` FROM `eleve_module` WHERE `id_eleve` = ?";
  conn.query(req, [id], (err, resultat) => {
    if (err) throw err;

    // Attribution des moyennes à chaque module
    resultat.forEach((row) => {
      switch (row.id_module) {
        case 1:
          module1 = (row.moyenne_module * (16 * 100)) / 60;
          break;
        case 2:
          module2 = (row.moyenne_module * (12 * 100)) / 60;
          break;
        case 3:
          module3 = (row.moyenne_module * (19 * 100)) / 60;
          break;
        case 4:
          module4 = (row.moyenne_module * (13 * 100)) / 60;
          break;
      }
    });

    // Calcul de la moyenne générale
    let moyenne_generale = (
      (module1 + module2 + module3 + module4) /
      100
    ).toFixed(2);
    const req2 =
      "UPDATE `eleve` SET `moyenne_generale` = ? WHERE `id_eleve` = ?";
    conn.query(req2, [moyenne_generale, id], (err, result) => {
      if (err) throw err;
      console.log(
        "La moyenne générale a été mise à jour avec succès : ",
        moyenne_generale
      );
    });

    conn.end();
  });
}

// Fonction qui va ajouter une note dans la base de donnée
function add_note_line(text) {
  let conn = DB_connect();
  let code = (epreuve = note = coefficient = "undef");

  const regex =
    /Date\s+(\d{2}\/\d{2}\/\d{4})\s+Code\s+([^\s]+)\s+Épreuve\s+(.*?)\s+Note\s+(\d{1,2}\.\d{2})\s+Coefficient\s+(\d+)/;

  if (regex.test(text)) {
    const matches = text.match(regex);
    const date = matches[1];
    code = matches[2];
    epreuve = matches[3].trim(); // utilise trim pour supprimer les espaces supplémentaires
    note = matches[4];
    coefficient = matches[5];

    console.log(date);
    console.log(code);
    console.log(epreuve);
    console.log(note);
    console.log(coefficient);

    if (
      code == "undef" ||
      epreuve == "undef" ||
      note == "undef" ||
      coefficient == "undef"
    ) {
      if (epreuve == "undef") {
        epreuve = "ERREUR DANS PDF";
      } else if (code == "undef") {
        code = "ERREUR DANS PDF";
      }
    }

    if (
      code != "undef" &&
      epreuve != "undef" &&
      note != "undef" &&
      coefficient != "undef"
    ) {
      const id1 = 1; // à remplacer par l'ID de l'utilisateur connecté
      const id_matiere = id_matiere(code); // à implémenter

      // On met la date au bon format
      const Cdate = convert_date(date); // à implémenter

      const requete =
        "INSERT INTO `eval` (`date_eval`,`code`,`epreuve`,`note`,`coef_eval`,`id_matiere`) VALUES (?, ?, ?, ?, ?, ?)";
      const tabdesVals = [Cdate, code, epreuve, note, coefficient, id_matiere];

      conn.query(requete, tabdesVals, (err, result) => {
        if (err) throw err;

        // Ici on va remplir la table eval_eleve avec les id
        const id_eval = id_evaluation(code); // à implémenter
        const requete2 =
          "INSERT INTO `eval_eleve` (`id_eval`, `id_eleve`) VALUES (?, ?)";
        const tabdesID = [id_eval, id1];

        conn.query(requete2, tabdesID, (err, result) => {
          if (err) throw err;
          console.log("Note ajoutée avec succès");
        });
      });
    }
  }
}

// moyenne_matiere(2, 1).then((resultat) => {
//   console.log(resultat);
// });
// UpdateMoyenne(2, 1);
// Moyenne_module(2);
// Moyenne_generale(2);

// Fonction qui va afficher les notes que l'on exporte dans le fichier serveur.js
module.exports = { affichage_note };