<?php
session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$_SESSION['players'] = $data['players'];

echo json_encode(['success' => true]);
?>