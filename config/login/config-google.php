
<?php
require_once __DIR__ . '/google-api-php-client/src/Google/autoload.php';

$client = new Google_Client();
$client->setClientId('1025089432878-2a0bgjlr8n8e6hgmif7mo2sp904llqqn.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://localhost/rumah-bhinneka/config/login/google-callback.php');
$client->addScope("email");
$client->addScope("profile");
