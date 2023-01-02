<?php

// on met des alias pour que ça nous soit plus clair, le dossier où on va chercher
// le principe c'est que ce qui va dans lib est immuable d'un projet à l'autre
// App récupère ce qui change d'un projet à l'autre
const ALIASES = [
    'Symfonette' => 'lib',
    'App' => 'src'
    ];

// on met une fonction anonyme dedans, pour l'appeler dès qu'on lance spl_autoload_register()    
spl_autoload_register(function (string $class):void {
    // à la base il reçoit nameplace\class; on met \\ parce que c'est un caractère d'échappement:
    //  ça évite qu'il fasse s'échapper le ' suivant
    // le explode sépare le chemin de la classe et met chaque partie dans un tableau
    $namespaceParts = explode('\\', $class);
    
    // si tu trouves le premier élément du tableau $namespaceParts dans le tableau ALIASES (Symfonette ou App)
    if (in_array($namespaceParts[0], array_keys(ALIASES))) {
        // on remplace ce namespace par son alias (lib ou src)
        $namespaceParts[0] = ALIASES[$namespaceParts[0]];
    } else {
        // Exception est une classe de PHP, qui met un message d'erreur
        throw new Exception('Namespace non valide "' . $namespaceParts[0] . 
        '". Le namespace doit commencer par "Symfonette" ou "App');
    }
    
    // DIRECTORY_SEPARATOR est une constante de PHP, qui est le séparateur de chaque dossier de répertoire
    // On regroupe les éléments du tableau avec le dossier qui a été remplacé (Symfonette => lib, App => src)
    $filepath = implode(DIRECTORY_SEPARATOR, $namespaceParts) . '.php';
    // Si le fichier est inexistant, message d'erreur
    if (!file_exists($filepath)) {
        throw new Exception("Fichier " . $filepath . "inexistant pour la classe " . $class . ".");
    }

    require $filepath;
});

// Le but est par exemple de passer d'un Symfonette\Router à un lib\Router, pour lire directement le Controlleur