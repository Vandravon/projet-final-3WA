    <!--
    //
    // Fonction: Permet d'éditer un favori
    // Route: app_bookmark_edit / Controller: BookmarkController / Methode: edit
    //
    -->

<h1>Edit</h1>

<?php include '_errors.php' ?>

<form method="POST" class="form-container">

    <div><label for="title" class="form-label">Nom du favori</label></div>
    <div><input type="text" id="title" name="title"
    <?php if (isset($data['bookmarkView'])) { ?>
    value="<?= $data['bookmarkView']->getTitle(); ?>"
    <?php } ?>
    size="80" required class="form-input"></div>
    
    <div><label for="picture_url" class="form-label">URL de l'image</label></div>
    <div><input type="text" id="picture_url" name="picture_url"
    <?php if (isset($data['bookmarkView'])) { ?>
    value="<?= $data['bookmarkView']->getPictureUrl(); ?>"
    <?php } ?>
    size="80" required class="form-input"></div>

    <div><label for="url" class="form-label">URL du favori</label></div>
    <div><input type="text" id="url" name="url"
    <?php if (isset($data['bookmarkView'])) { ?>
    value="<?= $data['bookmarkView']->getUrl(); ?>"
    <?php } ?>
    size="80" required class="form-input"></div>
  


  <div><input type="submit" value="Editer le favori" class="form-submit" /></div>

</form>