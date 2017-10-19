#!/bin/php
<?php
use Desmond\Desmond;
require_once __DIR__ . '/../vendor/autoload.php';

$docs = scandir(__DIR__ . '/../src/functions/docs');
$functions = scandir(__DIR__ . '/../src/functions/core');
$diff = array_diff($functions, $docs);

if (!empty($diff)) {
    exit ("Undocumented functions!\n");
}

echo 'Version: ';
$version = str_replace("\n", '', fgets(STDIN));

if ($version !== Desmond::VERSION) {
    $desmondVersion = Desmond::VERSION;
    exit ("Release version $version does not match actual version $desmondVersion\n");
}

echo 'Description: ';
$description = str_replace("\n", '', fgets(STDIN));

$request = json_encode([
    'tag_name' => $version,
    'name' => $version,
    'body' => $description
]);

echo 'GitHub User Name: ';
$username = str_replace("\n", '', fgets(STDIN));
echo 'GitHub Password: ';
$password = str_replace("\n", '', fgets(STDIN));

$curl = curl_init("https://api.github.com/repos/Archer70/desmond/releases");
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($request)
]);
curl_setopt($curl, CURLOPT_USERNAME, $username);
curl_setopt($curl, CURLOPT_USERPWD, $password);
curl_exec($curl);