<?php

include_once 'functions.php';

// Function that returns the words from the database that match the search
function getWords($len, $originalLetterArray){
    $words = [];
    // Iterate through all the letters
    foreach($originalLetterArray as $letter => $num){
        // Select all the words that start with each letter and have lenght <= $len (length of the base word)
        $query = "SELECT word FROM dictENG WHERE word LIKE '$letter%' AND LENGTH(word) > 1 AND LENGTH(word) <= $len ORDER BY word ASC" ;
        $result = mysqli_query($GLOBALS['con'], $query);
        // If it got results then add them to the array
        if($result && mysqli_num_rows($result) > 0){
            $words[] = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        else {
            echo 'Error fetching words';
        }
    }
    // Put all the results in a single array
    $wordsFound = [];
    foreach($words as $array){
        foreach($array as $arr){
            $wordsFound[] = $arr['word'];
        }
    }
    return $wordsFound;
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
    $baseWordArray[] = $baseWord;
    // Get it's array of letters and sort it
    $originalLetterArray = getLetterArray($baseWord);
    ksort($originalLetterArray);
    // Get all the words that start with those letters
    $wordsFound = getWords(strlen($baseWord), $originalLetterArray);
    // Check the valid words
    $validWords = getValidWords($originalLetterArray, $wordsFound);
    // Close the connection
    mysqli_close($con);
}