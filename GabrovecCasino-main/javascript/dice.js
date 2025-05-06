document.addEventListener('DOMContentLoaded', () => {
    const diceElements = [
        document.getElementById('dice1'),
        document.getElementById('dice2'),
        document.getElementById('dice3')
    ];
    const currentPlayerElement = document.getElementById('currentPlayer');
    const scoreDisplayElement = document.getElementById('scoreDisplay');
    const rollButton = document.getElementById('rollButton');
    
    let currentPlayerIndex = 0;
    let players = [];
    let isRolling = false;
    let highestScore = 0;  // Track highest score
    const diceFaces = ['1', '2', '3', '4', '5', '6'];
    

    function initGame() {
        // Get players from sessionStorage
        const playersData = sessionStorage.getItem('players');
        
        if (playersData) {
            players = JSON.parse(playersData);
            if (players.length === 3) {
                currentPlayerElement.textContent = players[0].name;
                rollButton.textContent = 'ROLL DICE';
                updateHighestScoreDisplay(); 
                return;
            }
        }
        
        Swal.fire({
            title: 'No Players Found',
            text: 'Please register 3 players first',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'userlog.php';
        });
    }
    
    function updateHighestScoreDisplay() {
        highestScore = Math.max(...players.map(p => p.score || 0));
        scoreDisplayElement.textContent = `Score to win: ${highestScore}`;
    }
    
    function rollDie(dieElement, delay) {
        return new Promise(resolve => {
            setTimeout(() => {
                dieElement.classList.add('rolling');
                
                // Animation
                let rolls = 0;
                const rollInterval = setInterval(() => {
                    const randomFace = Math.floor(Math.random() * 6);
                    dieElement.textContent = diceFaces[randomFace];
                    rolls++;
                    
                    if (rolls > 5) {
                        clearInterval(rollInterval);
                        dieElement.classList.remove('rolling');
                        const finalValue = Math.floor(Math.random() * 6) + 1;
                        dieElement.textContent = diceFaces[finalValue - 1];
                        resolve(finalValue);
                    }
                }, 100);
            }, delay);
        });
    }
    
    async function rollAllDice() {
        if (isRolling) return;
        isRolling = true;
        
        diceElements.forEach(die => die.textContent = '?');
        
        const die1 = await rollDie(diceElements[0], 0);
        const die2 = await rollDie(diceElements[1], 300);
        const die3 = await rollDie(diceElements[2], 600);
        
        const currentScore = die1 + die2 + die3;
        players[currentPlayerIndex].score = currentScore;
        
        sessionStorage.setItem('players', JSON.stringify(players));
        
        updateHighestScoreDisplay();
        
        currentPlayerIndex++;
        
        if (currentPlayerIndex < players.length) {
            currentPlayerElement.textContent = players[currentPlayerIndex].name;
            
            Swal.fire({
                title: `${players[currentPlayerIndex-1].name}'s Roll`,
                html: `Rolled: <b>${currentScore}</b><br>Current Highest: <b>${highestScore}</b>`,
                icon: 'info',
                confirmButtonText: 'Continue'
            });
        } else {
            determineWinner();
        }
        
        isRolling = false;
    }
    
    function determineWinner() {
        const maxScore = Math.max(...players.map(p => p.score));
        const winners = players.filter(p => p.score === maxScore);
        
        let winnerMessage;
        if (winners.length === 1) {
            winnerMessage = `The winner is <b>${winners[0].name}</b> with ${maxScore} points!`;
        } else {
            winnerMessage = `It's a tie between ${winners.map(w => w.name).join(' and ')} with ${maxScore} points each!`;
        }
        
        // Show all scores
        let scoresMessage = '<br><br><u>Final Scores</u>:<br>';
        players.forEach(player => {
            scoresMessage += `${player.name}: ${player.score}<br>`;
        });
        
        Swal.fire({
            title: 'Game Over!',
            html: winnerMessage + scoresMessage,
            icon: 'success',
            showDenyButton: true,
            confirmButtonText: 'Save Score',
            denyButtonText: 'Exit',
            showCancelButton: false,
        }).then((result) => {
            if (result.isConfirmed) {
                // Save to leaderboard
                if (winners.length === 1) {
                    saveToLeaderboard(winners[0].name, maxScore);
                    Swal.fire('Saved!', 'Score saved to leaderboard', 'success');
                } else {
                    winners.forEach(winner => {
                        saveToLeaderboard(winner.name, maxScore);
                    });
                    Swal.fire('Saved!', 'All winners saved to leaderboard', 'success');
                }
            }
    
            if (result.dismiss === Swal.DismissReason.cancel || result.isDenied) {
                window.location.href = 'index.php';
            }
        });
    }
    
    function saveToLeaderboard(name, score) {
        // Get the current leaderboard from localStorage
        let leaderboard = JSON.parse(localStorage.getItem('leaderboard')) || [];
    
        leaderboard.push({
            name: name,
            score: score,
            date: new Date().toISOString()
        });
    
        leaderboard.sort((a, b) => b.score - a.score);
    
        localStorage.setItem('leaderboard', JSON.stringify(leaderboard.slice(0, 10)));
    
        Swal.fire('Saved!', 'Score saved to leaderboard', 'success');
    }
    

    function resetGame() {
        currentPlayerIndex = 0;
        currentPlayerElement.textContent = players[0].name;
        diceElements.forEach(die => die.textContent = '?');
        
        players.forEach(player => player.score = 0);
        sessionStorage.setItem('players', JSON.stringify(players));
        updateHighestScoreDisplay();
    }

    rollButton.addEventListener('click', () => {
        if (rollButton.textContent === 'START GAME') {
            initGame();
        } else {
            rollAllDice();
        }
    });
    
    initGame();
});
