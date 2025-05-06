<?php session_start(); ?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Casino</title>
    <link rel="icon" href="images/icon.png" type="images/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="all">
        <!--<div id="overlay">-->
            <div class="midframe">
                <div class="title-container">
                        <img src="images/icon.png" alt="Icon" class="title-icon left-icon">
                        <div class="title-wrapper">
                            <div class="title1">Gabrovec</div>
                            <div class="title2">CASINO</div>
                        </div>
                        <img src="images/icon.png" alt="Icon" class="title-icon right-icon">
                    </div>            
                    
                    <div class="grid-container">
                        <div class="grid-item">
                            <a href="userlog.php" onclick="<?php $_SESSION['nextPage'] = 'dice.php'; ?>">
                                <img src="images/2.png" alt="Dice Game" class="small-image">
                                <div class="image-caption">Play</div>
                            </a>
                        </div>
                        <div class="grid-item">
                            <a href="leaderboard.php">
                                <img src="images/4.jpg" alt="Leaderboard" class="small-image">
                                <div class="image-caption">Leaderboard</div>
                            </a>
                        </div>
                        <div class="grid-item">
                            <div class="coming-soon">
                                <img src="images/5.png" alt="Coming Soon" class="small-image">
                                <div class="image-caption">Rules</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--</div>-->
    </div>
    
    <script>
        // Add click handler for coming soon items
        document.querySelectorAll('.coming-soon').forEach(item => {
            item.addEventListener('click', () => {
                Swal.fire({
                    title: 'How to play dice',
                    text: '3 players take turns throwing their dice. Whoever scores the most points wins!',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            });
        });
    </script>
    </body>
</html>