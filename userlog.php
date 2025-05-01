<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Casino | Users</title>
    <link rel="icon" href="images/icon.png" type="images/png">
    <link rel="stylesheet" href="css/userstyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="all">
        <div class="midframe">
            <div class="title-container">
                <img src="images/user.png" alt="Icon" class="title-icon left-icon">
                <div class="title-wrapper">
                    <div class="title1">Gabrovec</div>
                    <div class="title2">CASINO</div>
                </div>
                <img src="images/user.png" alt="Icon" class="title-icon right-icon">
            </div>

            <div class="user-form">
                <div class="form-group">
                    <label for="player1">Player 1:</label>
                    <input type="text" id="player1" class="form-input" placeholder="Enter name for Player 1" required>
                </div>
                <div class="form-group">
                    <label for="player2">Player 2:</label>
                    <input type="text" id="player2" class="form-input" placeholder="Enter name for Player 2" required>
                </div>
                <div class="form-group">
                    <label for="player3">Player 3:</label>
                    <input type="text" id="player3" class="form-input" placeholder="Enter name for Player 3" required>
                </div>
                <button id="startBtn" class="submit-btn">START GAME</button>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const button = document.getElementById('startBtn');

        button.addEventListener('click', (e) => {
            e.preventDefault();

            const player1Name = document.getElementById('player1').value.trim();
            const player2Name = document.getElementById('player2').value.trim();
            const player3Name = document.getElementById('player3').value.trim();

            if (!player1Name || !player2Name || !player3Name) {
                Swal.fire('Error', 'Please enter names for all players', 'error');
                return;
            }

            const players = [
                { name: player1Name, score: 0 },
                { name: player2Name, score: 0 },
                { name: player3Name, score: 0 }
            ];

            // ✅ Save players to sessionStorage (not server)
            sessionStorage.setItem('players', JSON.stringify(players));

            // Optional: use PHP fallback for nextPage if needed
            const nextPage = '<?php echo $_SESSION["nextPage"] ?? "dice.php"; ?>';

            Swal.fire({
                title: 'Players Registered!',
                text: `Game starting with ${player1Name}, ${player2Name}, and ${player3Name}`,
                icon: 'success',
                confirmButtonText: 'Continue to Game'
            }).then(() => {
                window.location.href = nextPage;
            });
        });
    });
    </script>
</body>
</html>
