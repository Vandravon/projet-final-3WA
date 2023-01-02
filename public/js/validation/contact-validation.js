let title = document.getElementById("title");
let content = document.getElementById("content");

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  Lorsque le formulaire est désélectionné, l'écouteur d'évènement qu'a chacun vérifie qu'il remplit bien
//  les conditions formulées dans le Input HTML
//  Le JavaScript me permet de modifier le message d'erreur
//
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

title.addEventListener("keyup", function (event) {
    if(title.validity.tooLong) {
        title.setCustomValidity("Votre Titre est beaucoup trop long !");
    } else {
        title.setCustomValidity("");
    }
});

content.addEventListener("keyup", function (event) {
    if(content.validity.tooLong) {
        content.setCustomValidity("Votre Message est beaucoup trop long !");
    } else {
        content.setCustomValidity("");
    }
});