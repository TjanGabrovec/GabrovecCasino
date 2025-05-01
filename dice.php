<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/dicestyle.css">
    <title>Casino | Lucky Dice</title>
    <link rel="icon" href="images/icon.png" type="images/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Exit button style */
        .exit-button {
            background: linear-gradient(to bottom,rgb(49, 49, 49),rgb(85, 85, 85));
            color: gold;
            border: none;
            padding: 5px 70px;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 50px;
            cursor: pointer;
            margin-top: 20px;
            box-shadow: 0 5px 15px rgb(126, 126, 126);
            transition: all 0.3s;
        }

        .exit-button:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgb(155, 155, 155);
        }
    </style>
</head>
<body>
    <div class="all">
        <div class="midframe">
            <div class="title-container">
                <img src="images/dice.png" alt="Icon" class="title-icon left-icon">
                <div class="title-wrapper">
                    <div class="title1">Gabrovec Casino</div>
                    <div class="title2">LUCKY DICE</div>
                </div>
                <img src="images/dice.png" alt="Icon" class="title-icon right-icon">
            </div>
            <div class="player-display" id="currentPlayer">Waiting for players...</div>

            <div class="dice-container">
                <div class="dice" id="dice1">?</div>
                <div class="dice" id="dice2">?</div>
                <div class="dice" id="dice3">?</div>
            </div>

            <div class="score-display" id="scoreDisplay">Score to win: 0</div>
            <button class="roll-button" id="rollButton">START GAME</button>
            <button class="exit-button" id="exitButton">EXIT</button>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // DOM Elements
        const exitButton = document.getElementById('exitButton');
        
        // Event listener for the exit button
        exitButton.addEventListener('click', () => {
            // Redirect to index.php when the exit button is clicked
            window.location.href = 'index.php';
        });

        // Your existing game logic and functions can stay here
        function saveToLeaderboard(winnerName, winnerScore) {
            // Get existing leaderboard or create empty array
            const leaderboard = JSON.parse(localStorage.getItem('leaderboard')) || [];
            
            // Add new entry
            leaderboard.push({
                name: winnerName,
                score: winnerScore,
                date: new Date().toISOString()
            });
            
            // Sort by score (descending) and keep top 10
            const sortedLeaderboard = leaderboard.sort((a, b) => b.score - a.score).slice(0, 10);
            
            // Save back to localStorage
            localStorage.setItem('leaderboard', JSON.stringify(sortedLeaderboard));
            
            return sortedLeaderboard;
        }

        // Your remaining game logic goes here
    });
    </script>

    <script src="javascript/dice.js"></script>
</body>
</html>
