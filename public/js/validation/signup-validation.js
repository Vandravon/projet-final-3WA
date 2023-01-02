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

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  Cette fonction permet de vérifier, lors de la validation du formulaire, que les 2 champs Mot de Passe
//  sont bien identiques
//  Cela a l'avantage d'éviter de recharger la page si la condition n'est pas vraie
//
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

function onChange() {
  const password = document.getElementById("password");
  const confirm = document.getElementById("confirm_password");
  if (confirm.value === password.value) {
    confirm.setCustomValidity('');
  } else {
    confirm.setCustomValidity("Les mots de passe ne correspondent pas !");
  }
}