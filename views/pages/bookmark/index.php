    <!--
    //
    // Fonction: Page principale qui liste tous les favoris d'un utilisateur
    // Route: app_bookmark_index / Controller: BookmarkController / Methode: index
    //
    -->

<h1>Index des favoris</h1>



<div class="grid">

    <?php if ($auth->isAuthenticated()) {?>

    <div class="add-buttons-container"> 

        <a href="index.php?page=app_bookmark_add" class="btn btn-add">
            <i class="fa-solid fa-circle-plus fa-2x"></i><p class="mt-small">Ajouter un favori</p>
        </a>

        <a href="index.php?page=app_bookmark_addApi" class="btn btn-add">
            <i class="fa-solid fa-circle-plus fa-2x"></i><p class="mt-small">Ajouter avec API</p>
        </a>

    </div>   
    
        <?php foreach($data['bookmarks'] as $bookmark) { ?>
        
            <div class="bookmark-card col-6 col-m-4 col-l-4">
                
                <a href="index.php?page=app_bookmark_edit&id=<?= $bookmark->getId() ?>">
                    <div class="btn-bookmark-edit"><i class="fa-solid fa-file-pen"></i></div>
                    <p class="btn-bookmark-edit-text">Edit</p>
                </a>
                
                <a href="index.php?page=app_bookmark_delete&id=<?= $bookmark->getId() ?>">
                    <div class="btn-bookmark-delete">
                        <i class="fa-solid fa-trash"></i></div>
                </a>
                
                <a href="index.php?page=app_bookmark_editTag&bookmarkId=<?= $bookmark->getId() ?>" 
                 class="btn-bookmark-names"><i class="fa-solid fa-pen"></i> Editer les tags
                </a>
            
                <a href="<?= $bookmark->getUrl() ?>" target="_blank" rel="noopener noreferrer"
                 class="bookmark-container">
                    
                    <div class="bookmark-title"><?= $bookmark->getTitle() ?></div>
                    
                    <div class="bookmark-image"><img src="<?= $bookmark->getPictureUrl() ?>" alt="<?= $bookmark->getTitle() ?>" loading="lazy" /></div>
                    
                    <div class="bookmark-name">
                        <div class="bookmark-name-text"><span class="text-bold">Tags:</span> 
                        <?php foreach($bookmark->getCategories() as $name) { ?>
                            - <?= $name->getName() . ' ' ?>
                        <?php } ?>
                        </div>
                    </div>
                    
                </a>
                

            </div>
            
        <?php } ?>
    <?php } ?>
        
</div>