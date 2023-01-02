let addUrl = document.getElementById("addUrl");
let addTitle = document.getElementById("addTitle");
let addPictureUrl = document.getElementById("addPicture_url");

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  Lorsque le formulaire est désélectionné, l'écouteur d'évènement qu'a chacun vérifie qu'il remplit bien
//  les conditions formulées dans le Input HTML
//  Le JavaScript me permet de modifier le message d'erreur
//
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

addUrl.addEventListener("keyup", function (event) {
    if(addUrl.validity.tooLong) {
      addUrl.setCustomValidity("Votre URL est beaucoup trop longue !");
    } else {
      addUrl.setCustomValidity("");
    }
});

  addTitle.addEventListener("keyup", function (event) {
    if(addTitle.validity.tooLong) {
        addTitle.setCustomValidity("Votre Titre est beaucoup trop long !");
    } else {
        addTitle.setCustomValidity("");
    }
});

  addPictureUrl.addEventListener("keyup", function (event) {
    if(addPictureUrl.validity.tooLong) {
        addPictureUrl.setCustomValidity("L'URL de votre image est beaucoup trop longue !");
    } else {
        addPictureUrl.setCustomValidity("");
    }
});