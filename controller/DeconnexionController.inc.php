<?php

class DeconnexionController
{
    public function get_index()
    {
        if (isset($_GET['token']) && $_GET['token'] == $_SESSION['token'])
        {
            session_destroy();
            setcookie('auth', '', time() - 3600, '/', '', false, true);
            header('Location: '.BASEURL);
            exit();
        }
        else
        {
            header('Location: '.BASEURL);
            exit();
        }
    }
}