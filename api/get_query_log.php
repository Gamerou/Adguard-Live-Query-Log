<?php

include '/var/www/html/api/AdGuardAPI.php';

$baseURL = 'http://adguard.local/control';
$adGuardAPI = new AdGuardAPI($baseURL);

$params = array(
    'limit' => 70,
    'response_status' => 'all'
);

$queryLog = $adGuardAPI->getQueryLog($params);

// Ausgabe der Query-Logs als JSON
header('Content-Type: application/json');
echo json_encode($queryLog);

?>
