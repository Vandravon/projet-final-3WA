    <!--
    //
    // Fonction: Contient la barre supérieure ainsi que la Nav bar du site
    // Utilisé par: layout.php
    //
    -->

<header class="bg-tertiary grid">
    
        <!-- Nav bar, qui n'apparaît que lorsque l'utilisateur est connecté -->
        <?php if ($auth->isAuthenticated()) { ?>
        
        <nav  id="btn-toggle" class="nav-menu">
           
            <ul class="top-ul">
                <li><a href="index.php?page=app_index">ACCUEIL <i class="fa-solid fa-desktop"></i></a></li>
                <li><a href="index.php?page=app_bookmark_index">FAVORIS 
                    <i class="fa-solid fa-book-bookmark"></i></a></li>
                <li><p class="nav-li-disabled">TODO-LIST <i class="fa-solid fa-person-digging"></i></p></li>
                <li><p class="nav-li-disabled">FLUX RSS <i class="fa-solid fa-person-digging"></i></p></li>
            </ul>

            <ul>
                <li><a href="index.php?page=app_user_setting">PARAMETRES <i class="fa-solid fa-gear"></i></a></li>
                <?php if ($auth->getUser()->getRole()) {?>
                    <li><a href="index.php?page=app_user_administration" class="alert-danger">ADMINISTRATION 
                        <i class="fa-solid fa-hammer"></i></a></li>
                <?php } ?>
                <?php if ($auth->getUser()->getRole()) {?>
                    <li><a href="index.php?page=app_user_boredAdmin" class="alert-danger">BONUS 
                    <i class="fa-solid fa-shuffle"></i></a></li>
                <?php } ?>
            </ul>
        </nav>
            
        <div class="burger-menu-container col-3 col-m-2 col-l-2">
            <div class="nav-menu-btn m-small" onclick="toggleFunc(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </div>

              
                
        <?php } else { ?>
                
              <a href="index.php?page=app_index" class="btn-home col-3 col-m-2 col-l-2">
                <i class="fa-solid fa-desktop fa-2x"></i><p class="mt-small">Accueil</p></a>
          <?php } ?>
          

        
        
        
    <!-- Theme checkbox -->
    
    <div class="toggle col-3 col-m-4 col-l-5">
        <input type="checkbox" id="theme" class="theme">
        <label for="theme" class="label-theme">
        <i class="fa-solid fa-moon"></i>
        <i class="fa-solid fa-sun"></i>
        <span class="ball"></span>
     </label>
    </div>
    
    
    <!--Boutons inscription/connexion/déconnexion-->
    <?php if ($auth->isAuthenticated()) {?>
        <div class="col-3 col-m-3 col-l-3 nickname-navbar">
            <p>Bonjour</p>
            <p class="nickname"><?= $auth->getUser()->getNickname() . '!' ?></p></div>
        <a href="index.php?page=app_user_logout" class="btn col-3 col-m-2 col-l-2">
            <i class="fa-solid fa-right-to-bracket fa-2x"></i><p class="mt-small">Déconnexion</p></a>
    <?php } else { ?>
        <div class="col-3 col-m-2 col-l-2 nickname-navbar">
            <a href="index.php?page=app_user_signup" class="btn">
                <i class="fa-solid fa-pen-to-square fa-2x"></i><p class="mt-small">Inscription</p></a>
        </div>
        <a href="index.php?page=app_user_login" class="btn col-3 col-m-2 col-l-2">
            <i class="fa-solid fa-right-to-bracket fa-2x"></i><p class="mt-small">Connexion</p></a>
    <?php } ?>

        
    
</header>
