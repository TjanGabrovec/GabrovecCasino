<?php session_start(); ?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/scorestyle.css">
    <title>Casino | Leaderboard</title>
    <link rel="icon" href="images/icon.png" type="images/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    <div class="all">
    <div id="overlay"></div>
        <div class="midframe">
            <div class="title-container">
                <img src="images/icon.png" alt="Icon" class="title-icon left-icon">
                <div class="title-wrapper">
                    <div class="title1">Gabrovec Casino</div>
                    <div class="title2">HIGH SCORES</div>
                </div>
                <img src="images/icon.png" alt="Icon" class="title-icon right-icon">
            </div>

            <div class="leaderboard-container" id="leaderboard">
            </div>

            <div class="button-container">
                <button class="menu-button" onclick="window.location.href='index.php'">Back to Menu</button>
                <button class="clear-button" id="clearButton">Clear Leaderboard</button>
            </div>
        </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const leaderboard = JSON.parse(localStorage.getItem('leaderboard')) || [];
            const leaderboardElement = document.getElementById('leaderboard');
            const clearButton = document.getElementById('clearButton');
            
            function displayLeaderboard() {
                if (leaderboard.length === 0) {
                    leaderboardElement.innerHTML = '<div class="no-scores">No scores saved yet</div>';
                    return;
                }
                
                let html = '<table><tr><th>Rank</th><th>Name</th><th>Score</th><th>Date</th></tr>';
                
                leaderboard.forEach((entry, index) => {
                    const date = new Date(entry.date);
                    html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${entry.name}</td>
                            <td>${entry.score}</td>
                            <td>${date.toLocaleDateString()}</td>
                        </tr>
                    `;
                });
                
                html += '</table>';
                leaderboardElement.innerHTML = html;
            }
            
            clearButton.addEventListener('click', () => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This will delete all leaderboard entries!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Clear anyways'
                }).then((result) => {
                    if (result.isConfirmed) {
                        localStorage.removeItem('leaderboard');
                        leaderboard.length = 0;
                        displayLeaderboard();
                        Swal.fire('Cleared!', 'Leaderboard has been cleared.', 'success');
                    }
                });
            });
            
            displayLeaderboard();
        });
    </script>
</body>
</html>