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
    <body>
        <header>
            <a href="index.html" style="float: left; position: relative; top:6px; outline:white;"> <- <u>Go Back</u></a>
            <h3 style = "float:right; position: relative; top:40px; color:rgb(207, 105, 33)">Base Word: <?= $baseWord; ?></h2>
            <h1 class = "center" style="color:rgb(244, 105, 54); font-family:fantasy; font-size:70px;">Dictionary Game</h1>
            <h3 id="lives" class = "center;" style="color:steelblue">Lives: 3</h3> 
            <h3 id="gameOverLeft" style="float: left;" class="gameOver">GAME OVER</h3>
            <h3 id="gameOverRight" style="float: right;" class="gameOver">GAME OVER</h3>
            <p style="float: right;" id="count"></p>

            <input id="guess" type="text" style ="float:center; position: relative; left:-20px" placeholder = "Guess">
            <button id="check" onclick="checkWord()">Check</button>
            <h2 id="counter">0</h2>

            <br><br><br>
            <a id="playAgain" class="gameOver" href = "index.html">Play Again</a>
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
            <button id="showAll" class="gameOver" onclick="showAllWords()">Show All Words</button>
        </center>

        <div id="showAllDiv" style="visibility: hidden;">
            <ul id="showAllUl">

            </ul>
        </div>
       
    </body>
    <script>

    const baseWord = <?= json_encode($baseWordArray); ?>[0];
    const validWords = <?= json_encode($validWords); ?>;
    const ulCorrect = document.getElementById('correct');
    const ulWrong = document.getElementById('wrong');
    let guesses = [];

    const baseMap = getOcurrMap(baseWord);
    const counter = document.getElementById("counter");
    // Initiate
    counter.innerText = "0/" + validWords.length;
    
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
        // Put the word in lowercase
        word = word.toLowerCase();
        // Check if it was already said
        if(guesses.includes(word)){
            alert("You already said that word");
            cleanGuess();
            return;
        }
        // Add the word to the guesses
        guesses.push(word);
        // If it passed add the guess to the corresponding list
        addGuess(word);
        cleanGuess();
    }

    // Cleans the guess
    function cleanGuess(){
        document.getElementById('guess').value = "";
    }

    function updateCounter(){
        // Get the actual num from the counter
        let num = parseInt(counter.innerText.substr(0, counter.innerText.indexOf('/')));
        counter.innerText = num + 1 + "/" + validWords.length;
        // If they guess all the words they win
        if(num == validWords.length - 1){
            endGame(true);
        }
    }

    function addGuess(word){
        // Create a new <li> with the word as text
        let li = document.createElement("li");
        // If it's in the list of valid words
        if(validWords.includes(word)){
            // Add the new <li> to the Correct Guesses <ul>
            li.appendChild(document.createTextNode(word));
            ulCorrect.appendChild(li);
            // Update the counter
            updateCounter();
        } else {
            // Check the reason it's not valid
            switch(checkIfValid(word)){
                case 0:
                    li.appendChild(document.createTextNode(word + " - This word contains letters that are not in the base word"));
                    break;
                case 1:
                    li.appendChild(document.createTextNode(word + " - This word might have more ocurrences of letters than in the base word"));
                break;
                case 2: 
                    li.appendChild(document.createTextNode(word + " - This word is valid but it isn't in the database"));
                break;
            } 
            // Add the new <li> to the Wrong Guesses <ul>
            ulWrong.appendChild(li);
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
            endGame(false);
        } 
    }

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
                // If the letter doesn't exist in the baseMap return 0;
                if(baseMap[letter] == undefined){
                    return 0;
                }
                // else return 1
                return 1;
            }
        }
        // If it exists return 2
        return 2;
    }

    function showAllWords(){
        document.getElementById("showAllDiv").style.visibility = "visible";
        const showAllUl = document.getElementById("showAllUl");
        for(let word of validWords){
            let li = document.createElement("li");
            li.appendChild(document.createTextNode(word));
            showAllUl.appendChild(li);
        }
    }

    function endGame(win){
        // Show elements
        document.getElementById("gameOverLeft").style.visibility = "visible";
        document.getElementById("gameOverRight").style.visibility = "visible";
        document.getElementById("playAgain").style.visibility = "visible";
        // Hide elements
        document.getElementById("guess").style.visibility = "hidden";
        document.getElementById("check").style.visibility = "hidden";
        if(win){
            document.getElementById("gameOverRight").innerText = "YOU WON";
        }
        else {
            document.getElementById("gameOverRight").innerText = "YOU LOST";
            document.getElementById("showAll").style.visibility = "visible";
        }
    }

    </script>
</html>
