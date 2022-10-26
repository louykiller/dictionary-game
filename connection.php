<?php

include 'functions.php';

// Returns an array with all of the valid words that were passed as the argument
function getValidWords($originalLetterArray, $wordsToCheck){
    $validWords = [];
    // Iterates throuh all the words to check. If they are valid add them to the array
    foreach($wordsToCheck as $word){
        if(checkIfValid($word, $originalLetterArray)){
            $validWords[] = $word;
        }
    }
    return $validWords;
}

// Function that returns the words from the database that match the search
function getWords($len, $originalLetterArray){
    $words = [];
    // Iterate through all the letters
    foreach($originalLetterArray as $letter => $num){
        // Select all the words that start with each letter and have lenght <= $len (length of the base word)
        $query = "SELECT word FROM dictENG WHERE word LIKE '$letter%' AND LENGTH(word) <= $len";
        $result = mysqli_query($GLOBALS['con'], $query);
        // If it got results then add them to the array
        if($result && mysqli_num_rows($result) > 0){
            $words[] = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        else {
            echo 'Error fetching words';
        }
    }
    return $words;
}

// Credentials for the database
$dbhost = "lourencocarvalho.pt";
$dbuser = "lourenco_dictUser";
$dbpass = "cfIC0Z8gQ4bL";
$dbname = "lourenco_dicts";

// Check if the $_POST['submit'] is set. If it is get the baseWord and all the words 
if(isset($_POST['submit'])){
    // Start the connection
    $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if(!$con){
        echo "<h1>Failed to connect do database</h1>";
    }
    // Get base word
    $baseWord = lowerCase($_POST['baseWord']);
    // Get it's array of letters
    $originalLetterArray = getLetterArray($baseWord);
    // Get all the words that start with those letters
    $words = getWords(strlen($baseWord), $originalLetterArray);
    // Check the valid words
    $validWords = getValidWords($originalLetterArray, $words);
    // Close the connection
    mysqli_close($con);
}
