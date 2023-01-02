const img = document.getElementById('carousel');
const rightBtn = document.getElementById('right-btn');
const leftBtn = document.getElementById('left-btn');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  Carrousel qui permet de donner un petit aperçu du site
//
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Tableau qui contient le chemin des images contenues dans le Caroussel
let pictures = ['./public/images/slider-01.jpg', './public/images/slider-02.jpg', './public/images/slider-03.jpg'];

//On charge une image lors du chargement de la page, et on inition la position du compteur
img.src = pictures[0];
let position = 0;

// Fonction qui se lance quand on clique sur la flèche droite
const moveRight = () => {
    // Permet de revenir à 0 si on atteint la dernière image du tableau
    if (position >= pictures.length - 1) {
        position = 0
        img.src = pictures[position];
        return;
    }
    // Incrémente le compteur, pour avancer de 1 dans le tableau contenant les images
    img.src = pictures[position + 1];
    position++;
}

// Fonction qui se lance quand on clique sur la flèche de gauche
const moveLeft = () => {
    // Permet de revenir à la dernière image lorsqu'on arrive à la première image du tableau
    if (position < 1) {
        position = pictures.length - 1;
        img.src = pictures[position];
        return;
    }
    // Décrémente le compteur, on recule de 1
    img.src = pictures[position - 1];
    position--;
}

// Ecouteurs d'évènements quand on clique sur les flèches droites et gauches: lance les fonctions associées
rightBtn.addEventListener("click", moveRight);
leftBtn.addEventListener("click", moveLeft);