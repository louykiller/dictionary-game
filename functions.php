<?php

// Simple function to put the word to lower case
function lowerCase($word){
    return strtolower($word);
}

// Function that as a word as an argument and returns an array with it's letter's and number of ocorrences
function getLetterArray($word){
    $letterArray = [];
    // Iterate through the word
    for($i = 0, $len = strlen($word); $i < $len; $i++){
        // If there isn't the letter in the array yet, add it
        if(!isset($letterArray[$word[$i]])){
            $letterArray[$word[$i]] = 1;
        } 
        // If there is, increment the value
        else {    
            $letterArray[$word[$i]] += 1;
        }
    }
    return $letterArray;
}

// Returns true if the word is valid, false if not
function checkIfValid($wordToCheck, $originalLetterArray){
    // get the letter Array for the word to check
    $letterArrayToCheck = getLetterArray($wordToCheck);
    foreach($letterArrayToCheck as $letter => $num){
        // if the original letter array doesn't have the letter 
        // or if the num of ocorrences is greater that the original num of ocorrences it returns false
        if(!isset($originalLetterArray[$letter]) || $num > $originalLetterArray[$letter]){
            return false;
        }
    }
    return true;
}

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

