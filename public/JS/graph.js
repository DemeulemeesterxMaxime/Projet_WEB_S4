// Récupérer l'élément avec l'ID "para_requete"
var fichier_json = document.getElementById("para_requete");

// Récupérer le innerHTML de l'élément
var innerHtmlContent = JSON.parse(fichier_json.innerHTML);


// Tableau de correspondance entre les ID de module et leur nom
var nomsModules = {
    "1": "Mathématiques",
    "2": "Physique",
    "3": "Informatique",
    "4": "FH"
};

// Objet pour stocker les moyennes des modules
var moyennesModules = {};
var nbr=1;
// Calculer les moyennes des modules
// Parcourir les éléments du tableau JSON et remplir moyennesModules
innerHtmlContent.forEach(function(item) {
    moyennesModules[nbr] = {
        nom: nomsModules[item.id_module],
        moyenne: parseFloat(item.moyenne_module)
    };
    nbr++;
});
console.log(moyennesModules);


// Récupérer les labels et les données pour Chart.js
var labels = [];
var data = [];

for (var module in moyennesModules) {
    labels.push("Module " + moyennesModules[module].nom);
    data.push(moyennesModules[module].moyenne);
}
let points = [];
let xmin=0;
let xmax=4; 
for (let x = xmin; x <= xmax; x += 0.1) {
    points.push({x: x, y: 10});
}

// Créer un graphe en barres avec Chart.js
var ctx = document.getElementById('linec').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        
        labels: labels,
        datasets: [
            {
                label: 'Moyenne des modules',
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                order: 1
            },
            {
                label: 'Moyenne à 10',
                data: points,
                backgroundColor: 'rgb(255, 0, 0)',
                borderColor: 'rgb(255, 0, 0)',
                type: 'line',
                order: 0
              }
            
        ]
    },
    tooltips: {
        enabled: true,
        mode: 'index',
        intersect: false,
    },
    options: {
        maintainAspectRatio: false, // Permet au graphique de ne pas maintenir un ratio d'aspect fixe

        scales: {
            y: {
                min: 0,
                max: 20,
            }
        }
    }
});




//pour le deuxième graphe : 

// Déclaration du tableau des matières
var matieres = {
    "1":"Fondamentaux",
    "2":"Analyse",
    "3":"TP Maths",
    "4":"Algèbre linéaire",
    "5":"Arithmétique",
    "6":"TP Maths",
    "7":"Optique",
    "8":"Electronique",
    "9":"TP Electronique",
    "10":"Mécanique de point",
    "11":"Thermodynamique",
    "12":"Fondamentaux",
    "13":"TP Programmation",
    "14":"Technologies Web",
    "15":"Approfondissement",
    "16":"TP Programmation",
    "17":"Technologies Web",
    "18":"Informatique Embarquée",
    "19":"Projet de fin d'année",
    "20":"Anglais",
    "21":"Compétences Relationnelles",
    "22":"Sport",
    "23":"Anglais",
    "24":"Epistémologie",
    "25":"Sport",
}




var fichier_json2 = document.getElementById("para_requete2");

// Récupérer le innerHTML de l'élément
var innerHtmlContent2 = JSON.parse(fichier_json2.innerHTML);
console.log(innerHtmlContent2); 

var moyennesModulemaths = {};
var moyennesModulePhysique = {};
var moyennesModuleInformations = {};
var moyennesModuleFH = {};
var nbr1=1;
var nbr2=1;
var nbr3=1;
var nbr4=1;
// Calculer les moyennes des modules
// Parcourir les éléments du tableau JSON et remplir moyennesModules
innerHtmlContent2.forEach(function(item) {
    if (item.id_matiere >= 1 && item.id_matiere <= 6) {
        moyennesModulemaths[nbr1] = {
            nom: matieres[item.id_matiere],
            moyenne: parseFloat(item.moyenne_matiere)
        };
        nbr1++;
    } else if (item.id_matiere >= 7 && item.id_matiere <= 11) {
        moyennesModulePhysique[nbr2] = {
            nom: matieres[item.id_matiere],
            moyenne: parseFloat(item.moyenne_matiere)
        };
        nbr2++;
    } else if (item.id_matiere >= 12 && item.id_matiere <= 19) {
        moyennesModuleInformations[nbr3] = {
            nom: matieres[item.id_matiere],
            moyenne: parseFloat(item.moyenne_matiere)
        };
        nbr3++;
    } else {
        moyennesModuleFH[nbr4] = {
            nom: matieres[item.id_matiere],
            moyenne: parseFloat(item.moyenne_matiere)
        };
        nbr4++;
    }
});


console.log(moyennesModulemaths);
console.log(moyennesModulePhysique);
console.log(moyennesModuleInformations);
console.log(moyennesModuleFH);
