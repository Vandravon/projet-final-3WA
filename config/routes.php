<?php

//
// Lie les routes à leurs controllers et methodes associés
//

return [
    'app_index' => [
      'controller' => App\Controller\AppController::class,
      'method' => 'index'
    ],
    'app_contact' => [
      'controller' => App\Controller\ContactController::class,
      'method' => 'contact'
    ],
    'app_contact_submit' => [
      'controller' => App\Controller\ContactController::class,
      'method' => 'submit'
    ],
    'app_user_login' => [
      'controller' => App\Controller\UserController::class,
      'method' => 'login'
    ],
    'app_user_signup' => [
      'controller' => App\Controller\UserController::class,
      'method' => 'signup'
    ],
    'app_user_logout' => [
      'controller' => App\Controller\UserController::class,
      'method' => 'logout'
    ],
    'app_user_setting' => [
      'controller' => App\Controller\UserController::class,
      'method' => 'setting'
    ],
    'app_user_administration' => [
      'controller' => App\Controller\UserController::class,
      'method' => 'administration'
    ],
    'app_user_boredAdmin' => [
      'controller' => App\Controller\UserController::class,
      'method' => 'boredAdmin'
    ],
    'app_user_delete' => [
      'controller' => App\Controller\UserController::class,
      'method' => 'delete'
    ],
    'app_contact_delete' => [
      'controller' => App\Controller\ContactController::class,
      'method' => 'delete'
    ],
    'app_bookmark_index' => [
      'controller' => App\Controller\BookmarkController::class,
      'method' => 'index'
    ],
    'app_bookmark_add' => [
      'controller' => App\Controller\BookmarkController::class,
      'method' => 'add'
    ],
    'app_bookmark_addApi' => [
      'controller' => App\Controller\BookmarkController::class,
      'method' => 'addApi'
    ],
    'app_bookmark_edit' => [
      'controller' => App\Controller\BookmarkController::class,
      'method' => 'edit'
    ],
    'app_bookmark_editTag' => [
      'controller' => App\Controller\CategoryController::class,
      'method' => 'editTag'
    ],
    'app_bookmark_delete' => [
      'controller' => App\Controller\BookmarkController::class,
      'method' => 'delete'
    ],
];