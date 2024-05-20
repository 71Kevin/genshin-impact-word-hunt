<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genshin Impact Word Search</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #fafafa;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .board {
            display: grid;
            grid-template-columns: repeat(10, 40px);
            grid-gap: 5px;
            justify-content: center;
            margin-bottom: 20px;
        }
        .cell {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e0e0e0;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            user-select: none;
            border-radius: 4px;
            transition: background 0.3s, color 0.3s;
        }
        .cell.selected {
            background: #a0e0a0;
        }
        .cell.correct {
            background: #3498db;
            color: white;
        }
        .cell.help {
            background: #ffeb3b;
        }
        .status {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #0056b3;
        }
        .error {
            color: red;
            font-weight: bold;
        }
        .note {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        h1 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Genshin Impact Word Search</h1>
        <div class="status">
            <p>Found Words: <span id="foundCount">0</span></p>
            <p>Remaining Words: <span id="remainingCount">10</span></p>
            <button class="btn" id="helpButton">Ask Paimon?</button>
            <div class="note">Note: Paimon might not always pick the correct letter from a word.</div>
        </div>
        <div id="board" class="board">
            <?php
            foreach ($board as $row) {
                foreach ($row as $cell) {
                    echo "<div class='cell'>$cell</div>";
                }
            }
            ?>
        </div>
        <div id="message" class="status" style="display: none;">
            <p>Congratulations! You found all the words!</p>
            <button class="btn" onclick="window.location.reload()">Start a New Game</button>
        </div>
        <div id="error" class="error" style="display: none;">
            <p>Something went wrong. Please try again.</p>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const helpButton = document.getElementById('helpButton');
            const cells = document.querySelectorAll('.cell');
            const foundCount = document.getElementById('foundCount');
            const remainingCount = document.getElementById('remainingCount');
            const message = document.getElementById('message');
            const error = document.getElementById('error');
            let foundWords = 0;
            let selectedCells = [];

            cells.forEach(cell => {
                cell.addEventListener('click', () => {
                    if (cell.classList.contains('selected')) {
                        cell.classList.remove('selected');
                        selectedCells = selectedCells.filter(c => c !== cell);
                    } else {
                        cell.classList.add('selected');
                        selectedCells.push(cell);
                    }

                    const word = selectedCells.map(cell => cell.textContent).join('');
                    if (checkWord(word)) {
                        selectedCells.forEach(c => {
                            c.classList.add('correct');
                            c.classList.remove('selected');
                            c.dataset.foundWords = c.dataset.foundWords ? Number(c.dataset.foundWords) + 1 : 1;
                        });
                        foundWords++;
                        foundCount.textContent = foundWords;
                        remainingCount.textContent = 10 - foundWords;
                        selectedCells = [];
                    }
                    if (foundWords === 10) {
                        message.style.display = 'block';
                    }
                });
            });

            helpButton.addEventListener('click', () => {
                const remainingWords = document.querySelectorAll('.cell:not(.correct)');
                if (remainingWords.length > 0) {
                    let randomCell;
                    do {
                        randomCell = remainingWords[Math.floor(Math.random() * remainingWords.length)];
                    } while (randomCell.classList.contains('help'));
                    
                    randomCell.classList.add('help');
                    setTimeout(() => {
                        randomCell.classList.remove('help');
                    }, 3000);
                } else {
                    alert('All words are found! No more help available.');
                }
            });

            function checkWord(word) {
                return <?php echo json_encode($words); ?>.includes(word);
            }

            window.addEventListener('error', () => {
                error.style.display = 'block';
            });
        });
    </script>
</body>
</html>
