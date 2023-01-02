<!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="./public/images/favicon.ico">
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="./public/css/style.css" type="text/css" />
	<script src="https://kit.fontawesome.com/e856ee4135.js" crossorigin="anonymous"></script>
  <title><?= $data['title'] ?> - MVC</title>
</head>
<body>

    <!--
    //
    // Fonction: Page de base du site, dans laquelle s'insère toutes les autres pages ainsi que le header et le footer
    //
    -->

  <?php require './views/partials/_header.php'; ?>

  <main>
    <?php require $templatePath ?>
  </main>

  <?php require './views/partials/_footer.php'; ?>
  
  <script src="./public/js/scripts.js"></script>
</body>
</html>