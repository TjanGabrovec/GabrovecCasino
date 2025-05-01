<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['players'])) {
    foreach ($_SESSION['players'] as &$player) {
        $player['score'] = 0;
    }
}

echo json_encode(['success' => true]);
?>