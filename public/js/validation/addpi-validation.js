let urlApi = document.getElementById("urlApi");

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  Lorsque le formulaire est désélectionné, l'écouteur d'évènement qu'a chacun vérifie qu'il remplit bien
//  les conditions formulées dans le Input HTML
//  Le JavaScript me permet de modifier le message d'erreur
//
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

urlApi.addEventListener("keyup", function (event) {
  if(urlApi.validity.typeMismatch) {
    urlApi.setCustomValidity("Merci de mettre une URL valide !");
  } else {
    urlApi.setCustomValidity("");
  }
});