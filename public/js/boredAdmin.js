const catFacts = document.getElementById('cats');
const textCats = document.getElementById('text-cats');
const buttonCats = document.getElementById('button-cats');
const dogFacts = document.getElementById('dogs');
const textDogs = document.getElementById('text-dogs');
const buttonDogs = document.getElementById('button-dogs');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  Petit ajout fantaisiste qui a pour but de démontrer ma capacité à utiliser une API avec JavaScript
//  pour après exploiter le fichier JSON reçu
//
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Fonction qui permet d'appeler l'appeler l'API Cat Facts dès qu'on la sollicite
function catsFacts() {
    fetch('https://catfact.ninja/fact')
    .then(response => {
        if(response.ok) {
            response.json().then(data => {
                textCats.innerText = data.fact
            })
        }
        else {
            textCats.innerText = "Erreur!";
        }
    });
};

// On appelle la fonction définie ci-dessus à chaque fois qu'on clique sur le bouton
buttonCats.addEventListener("click", () => {
    catsFacts();
});

// Fonction qui permet d'appeler l'API Dogs Facts
function dogsFacts() {
    fetch('https://www.dogfactsapi.ducnguyen.dev/api/v1/facts/?number=1') //L'API permet de récupérer plusieurs faits
    .then(response => {
        if(response.ok) {
            response.json().then(data => {
                textDogs.innerText = data.facts
            })
        }
        else {
            textDogs.innerText = "Erreur!";
        }
    });
};

// On appelle la fonction définie ci-dessus à chaque fois qu'on clique sur le bouton
buttonDogs.addEventListener("click", () => {
    dogsFacts();
});

// Permet de lancer les 2 fonctions définies ci-dessus au chargement de la page
catsFacts();
dogsFacts();