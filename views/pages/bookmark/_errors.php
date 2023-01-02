    <!--
    //
    // Fonction: Affiche des alertes en haut de la page quand il y a des erreurs
    // Utilisé par: add.php, edit.php, editApi.php
    //
    -->

<?php if (!empty($data['errors'])) { ?>
  <?php foreach ($data['errors'] as $error) { ?>
	  <p class="alert alert-danger"><?= $error ?></p>
  <?php } ?>
<?php } ?>