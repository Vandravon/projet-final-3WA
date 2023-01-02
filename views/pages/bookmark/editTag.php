    <!--
    //
    // Fonction: Permet d'éditer les tags d'un favori
    // Route: app_bookmark_editName / Controller: CategoryController / Methode: editTag
    //
    -->

<h1>Editer les tags</h1>

<?php if ($auth->isAuthenticated()) {?>

<form method="POST" class="form-container">
    <?php $i = 1 ?>
    
    <?php
        foreach($data['getAllCategories'] as $category) { ?>

        <div>
            <input type="checkbox" id="<?= 'tag' . $i ?>" name="<?= 'tag' . $i ?>" value="<?= $category->getId() ?>"
            <?php foreach($data['getBookmarkNames'] as $bookmarkName) {
                if($bookmarkName->getId() === $category->getId()) { ?>
                <?= "checked" ?>
            <?php 
                }
            } ?> >
            <label for="<?= 'tag' . $i ?>"><?= $category->getName() ?></label>
        </div>
        <?php $i++ ?>  
    <?php } ?>

    <div><input type="submit" value="Editer les tags" class="form-submit" /></div>
    
</form>

    
<?php } ?>