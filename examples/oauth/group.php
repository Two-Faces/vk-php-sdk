<?php

use VK\OAuth\Group\Display;
use VK\OAuth\Group\DTO\AccessTokenParams;
use VK\OAuth\Group\DTO\AuthorizeUrlParams;
use VK\OAuth\Group\Group;
use VK\OAuth\ResponseType;

require 'vendor/autoload.php';

$clientId = 1234567;
$clientSecret = 'secret';
$redirectUri = 'https://domain.tld';
$state = 'abc';

$auth = new Group();

$authParams = new AuthorizeUrlParams(
    ResponseType::CODE,
    $clientId,
    $redirectUri,
    Display::PAGE,
    $state,
);

$authUrl = $auth->getAuthorizeUrl($authParams);

echo '1. Copy and paste into your browser\'s address bar and press Enter: ' . $auth->getAuthorizeUrl($authParams) . "\n";
echo "2. Login\n";
echo "3. Copy url from the address bar\n";
echo "4. Paste this option below\n\n";

echo 'url > ';
$handle = fopen ('php://stdin','r');
$url = fgets($handle);
fclose($handle);

$query = parse_url($url, PHP_URL_QUERY);
if (empty($query)) {
    echo "[err] empty query in url\n";
    exit(1);
}

parse_str($query, $q);

if (empty($q['code'])) {
    echo "[err] not found parameter code in url\n";
    exit(1);
}

$tokenParams = new AccessTokenParams($clientId, $clientSecret, $redirectUri, $q['code']);
$token = $auth->getAccessToken($tokenParams);
echo "token: " . $token['access_token'] . "\n\n";
