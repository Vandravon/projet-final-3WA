    <!--
    //
    // Fonction: Page d'administration, où l'administrateur liste les utilisateurs et les formulaires de contact
    //              Il peut également supprimer les utilisateurs + leurs données ainsi que les formulaires
    // Route: app_user_administration / Controller: UserController / Methode: administration
    //
    -->

<h1>Administration</h1>

<div class="admin-container">

    <h2 class="bg-light">Utilisateurs inscrits:</h2>

    <div>

        <div class="admin-users-list">
            <div class="text-bold">Pseudonyme:</div>
            <div>Email:</div>
            <div>Suppression des utilisateurs:</div>
        </div>

        <?php foreach($data['users'] as $user) { ?>
            <div class="admin-users-list">
                <div class="text-bold"><?= $user->getNickname() ?></div>
                <div><?= $user->getEmail() ?></div>
                <div><a href="index.php?page=app_user_delete&id=<?= $user->getId() ?>">Supprimer</a></div>
            </div>
        <?php } ?>
    </div>


    <h2 class="bg-light">Formulaires de contact reçus:</h2>

    <div>
        <?php foreach($data['contacts'] as $contact) { ?>
            <div class="admin-contacts-list">
                <div class="text-bold">- <?= $contact->getTitle() ?></div>
                <div><?= $contact->getContent() ?></div>
                <div><a href="index.php?page=app_contact_delete&id=<?= $contact->getId() ?>">
                Supprimer le formulaire de contact</a>
            </div>
            </div>
        <?php } ?>
    </div>

</div>

