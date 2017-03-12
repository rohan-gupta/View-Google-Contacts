<?php

    include('./google-api-php-client-2.1.1/vendor/autoload.php');

    $client = new Google_Client();
    $client->setAuthConfigFile('client_id.json');
    $client->addScope("https://www.googleapis.com/auth/contacts.readonly");
    $client->addScope("https://www.googleapis.com/auth/user.phonenumbers.read");

    $authorization_url = $client->createAuthUrl();
    header('Location: '. $authorization_url);


