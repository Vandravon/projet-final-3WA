    <!--
    //
    // Fonction: Permet d'ajouter un favori
    // Route: app_bookmark_add / Controller: BookmarkController / Model: add
    //
    -->

<h1>Add</h1>

<?php include '_errors.php' ?>

<form method="POST" class="form-container">

    <div><label for="addUrl" class="form-label">URL du favori</label></div>
    <div><input type="text" id="addUrl" name="addUrl" size="30" required maxlength="255" class="form-input" 
    <?php if (isset($_GET['url'])) { ?><?= 'value="' . $_GET['url'] . '"' ?><?php } ?> > </div>
  
    <div><label for="addTitle" class="form-label">Nom du favori</label></div>
    <div><input type="text" id="addTitle" name="addTitle" size="30" required maxlength="255" class="form-input"
    <?php if (isset($_GET['title'])) { ?><?= 'value="' . $_GET['title'] . '"' ?><?php } ?> > </div>
    
    <div><label for="addPicture_url" class="form-label">URL de l'image</label></div>
    <div><input type="text" id="addPicture_url" name="addPicture_url" size="30" required maxlength="255" class="form-input"
    <?php if (isset($_GET['image'])) { ?><?= 'value="' . $_GET['image'] . '"' ?><?php } ?> > </div>

    <div><input type="submit" value="Inscrire le favori" class="form-submit" /></div>
  
</form>

<script src="./public/js/validation/add-validation.js"></script>