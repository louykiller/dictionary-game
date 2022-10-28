<?php
    include 'connection.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Dictionary Game English version</title>
        <link rel="stylesheet" href="gameStyle.css">
    </head>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <body>
        <header>
            <a href="index.html" style="float: left; position: relative; top:6px; outline:white;"> <- <u>Go Back</u></a>
            <h3 style = "float:right; position: relative; top:40px; color:rgb(207, 105, 33)">Base Word: <?= $baseWord; ?></h2>
            <h1 class = "center" style="color:rgb(244, 105, 54); font-family:fantasy; font-size:70px;">Dictionary Game</h1>
            <h3 id="lives" class = "center;" style="color:steelblue">Lives: 3</h3> 
            <h3 style="float: left;" class="gameOver">GAME OVER</h3>
            <h3 style="float: right;" class="gameOver">GAME OVER</h3>
            <p style="float: right;" id="count"></p>

            <input id="guess" type="text" style ="float:center; position: relative; left:-20px" placeholder = "Guess">
            <button id="check" onclick="checkWord()">Check</button>

            <br><br><br>
            <a class="gameOver" href = "index.html">Play Again</a>
            <br><br>
        </header> 
        <br>
        <fieldset style="margin-left: 1%;">
            <legend style="color: rgb(7, 242, 7);">Correct Guesses</legend>
            <ul id="correct">

            </ul>
        </fieldset>

        <fieldset style="margin-right: -1.5%;" >
            <legend style="color: red;">Wrong Guesses</legend>
            <ul id="wrong">

            </ul>
        </fieldset>
        
        <center>
            <button id="showAll" class="gameOver">Show All Words</button>
        </center>
       
    </body>
    <script>

    const baseWord = <?= json_encode($baseWordArray); ?>[0];
    const wordsFound = <?= json_encode($wordsFound); ?>;
    const baseMap = getOcurrMap(baseWord);
    const ulCorrect = document.getElementById('correct');
    const ulWrong = document.getElementById('wrong');
    let correctGuesses = [];
    let wrongGuesses = [];

    function getOcurrMap(word){
        let wordMap = {};
        // Iterate the word letter by letter
        for(let letter of word){
            // If the letter isn't in the wordMap add it
            if(wordMap[letter] == undefined){
                wordMap[letter] = 1;
            }
            // Else increment it's number of ocurrences
            else{
                wordMap[letter] += 1;
            }
        }
        return wordMap;
    }

    function checkIfValid(word){
        const wordMap = getOcurrMap(word);
        for(let letter in wordMap){
            // If the letter doesn't exist in the baseMap or if the number of ocurrences is lower than in the word 
            if(baseMap[letter] == undefined || baseMap[letter] < wordMap[letter]){
                return false;
            }
        }
        return true;
    }

    // Cleans the guess
    function cleanGuess(){
        document.getElementById('guess').value = "";
    }

    function checkWord(){
        let word = document.getElementById('guess').value;
        // the word needs to be at least 2 letters long
        if (word.length < 2){
            alert("Your word needs to be at least 2 letters long");
            cleanGuess();
            return;
        } 
        // and it can only contain letters
        for(let i = 0; i < word.length; i++){
            if(!((word[i] >= "a" && word[i] <= "z") || (word[i] >= "A" && word[i] <= "Z"))){
                alert("Your word can only contain letters");
                cleanGuess();
                return;
            }
        }
        // If it passed check if it's a valid word and add the guess to the corresponding list
        addGuess(word, checkIfValid(word));
        cleanGuess();
    }

    function addGuess(word, valid){
        let li = document.createElement("li");
        li.appendChild(document.createTextNode(word));
        if(valid){
            ulCorrect.appendChild(li);
            correctGuesses.push(word);
        } else {
            ulWrong.appendChild(li);
            wrongGuesses.push(word);
            // Take a life
            decrementLife();
        }
    }

    function decrementLife(){
        let lives = document.getElementById('lives').innerText;
        let num = parseInt(lives[lives.length - 1]);
        // Update the lives
        document.getElementById('lives').innerText = lives.substr(0, lives.length - 1) + (num - 1);
        // If it was the last life
        if(num == 1){
            $(".gameOver").css("visibility", "visible");
        } 
    }


    </script>
</html>
