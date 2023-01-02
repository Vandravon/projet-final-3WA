    <!--
    //
    // Fonction: Page paramètres où l'utilisateur peut modifier ses informations
    // Route: app_user_setting / Controller: UserController / Methode: setting
    //
    -->

<h1>Paramètres</h1>

<?php include '_errors.php' ?>

<form method="POST" class="form-container">

    <div><label for="nickname" class="form-label">Pseudonyme:</label></div>
    <div><input type="text" id="nickname" name="nickname"
    <?php if (isset($data['user'])) { ?>
    value="<?= $data['user']->getNickname(); ?>"
    <?php } ?>
    required minlength="4" class="form-input"></div>
    
    <div><label for="email" class="form-label">Email:</label></div>
    <div><input type="text" id="email" name="email"
    <?php if (isset($data['user'])) { ?>
    value="<?= $data['user']->getEmail(); ?>"
    <?php } ?>
    size="30" required class="form-input"></div>

    <div><label for="password" class="form-label">Vérification du mot de passe (requis):</label></div>
    <div><input type="password" id="password" name="password"
    size="30" required class="form-input"></div>

    <div><label for="newPassword" class="form-label">Nouveau mot de passe (optionnel):</label></div>
    <div><input type="password" id="newPassword" name="newPassword"
    size="30" class="form-input"></div>



  <div><input type="submit" value="Modifier les informations" class="form-submit" /></div>

</form>

<script src="./public/js/validation/setting-validation.js"></script>