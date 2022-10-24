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
            <h3 style = "float:right; position: relative; top:40px; color:rgb(207, 105, 33)">Base Word</h2>
            <h1 class = "center" style="color:rgb(244, 105, 54); font-family:fantasy; font-size:70px;">Dictionary Game</h1>
            <h3 class = "center;" style="color:steelblue">Lives: 3</h3> 
            <h3 style="float: left;" class="gameOver">GAME OVER</h3>
            <h3 style="float: right;" class="gameOver">GAME OVER</h3>
            <p style="float: right;" id="count"></p>
            <input type= "text" id = "guess" style ="float:center; position: relative; left:-20px" placeholder = "Guess">
            <button class=check id = "check">Check</button>
            <br><br><br>
            <a class= playAgain href = "index.html">Play Again</a>
            <br><br>
        </header> 
        <br>
        <fieldset style="margin-left: 1%;">
            <legend style="color: rgb(7, 242, 7);">Correct Guesses</legend>
            <ul>
                <li></li>
            </ul>
        </fieldset>

        <fieldset style="margin-right: -1.5%;" >
            <legend style="color: red;">Wrong Guesses</legend>
            <ul>
                <li></li>
            </ul>
        </fieldset>
        
        <center>
            <button id="showAll" class="showAll">Show All Words</button>
        </center>
       
    </body>
</html>
