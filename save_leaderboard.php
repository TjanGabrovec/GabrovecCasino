<?php
session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$leaderboard = $_SESSION['leaderboard'] ?? [];

$leaderboard[] = [
    'name' => $data['name'],
    'score' => $data['score'],
    'date' => date('Y-m-d H:i:s')
];

usort($leaderboard, function($a, $b) {
    return $b['score'] - $a['score'];
});
$_SESSION['leaderboard'] = array_slice($leaderboard, 0, 10);

echo json_encode(['success' => true]);
?>