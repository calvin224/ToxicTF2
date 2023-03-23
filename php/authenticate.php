<?php
session_start();

require 'openid.php';

try {
    $openid = new LightOpenID('http://localhost:63343/ToxicTF2');

    if(!$openid->mode) {
        // The user is not logged in. Redirect to the Steam login page.
        $openid->identity = 'https://steamcommunity.com/openid';
        header('Location: ' . $openid->authUrl());
    } elseif($openid->mode == 'cancel') {
        // The user cancelled the login. Redirect back to the homepage.
        header('Location: Homepage.php');
    } else {
        // The user has logged in successfully. Authenticate the user.
        if($openid->validate()) {
            $id = $openid->identity;
            $steamid = str_replace('https://steamcommunity.com/openid/id/', '', $id);
            $_SESSION['steamid'] = $steamid;

            // Authenticate the user and redirect them to the homepage.
            header('Location: Messages.php');
        } else {
            echo 'User is not logged in.';
        }
    }
} catch(ErrorException $e) {
    echo $e->getMessage();
}
?>