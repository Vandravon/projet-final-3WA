let nickname = document.getElementById("nickname");
let email = document.getElementById("email");

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  Lorsque le formulaire est désélectionné, l'écouteur d'évènement qu'a chacun vérifie qu'il remplit bien
//  les conditions formulées dans le Input HTML
//  Le JavaScript me permet de modifier le message d'erreur
//
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

nickname.addEventListener("keyup", function (event) {
  if(nickname.validity.tooShort) {
      nickname.setCustomValidity("Merci de choisir un pseudonyme qui fait au minimum 4 caractères !");
  } else {
      nickname.setCustomValidity("");
  }
});

email.addEventListener("keyup", function (event) {
  if(email.validity.typeMismatch) {
    email.setCustomValidity("Merci de mettre un mail valide !");
  } else {
    email.setCustomValidity("");
  }
});