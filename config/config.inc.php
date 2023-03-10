<?php

$http = empty($_SERVER['HTTPS']) ? 'http' : 'https';
$srv = $_SERVER['SERVER_NAME'];

if ($srv == 'localhost' || $srv == '127.0.0.1')
{
    define('DEV', true);
    define('BASEURL', $http.'://'.$srv.'/miams/');
    define('ROOT', $_SERVER['DOCUMENT_ROOT'].'/miams/');
    define('LINK', $_SERVER['SERVER_ADDR']);
}

//On génère un token CSRF pour vérifier que c'est bien l'utilisateur lui même qui effectue les actions du site
if (isset($_SESSION['user']) && !isset($_SESSION['token']))
    $_SESSION['token'] = md5(uniqid(mt_rand(), true));