<?php
session_start();
unset($_SESSION['leaderboard']);
echo json_encode(['success' => true]);
?>