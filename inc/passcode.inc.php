<?php

/**
 * Student Name:            Paramjot Kaur
 * Student ID:              300316956
 * Assignment/File Name:    Lab02/passcode.inc.php
 **/

// This function print the game's header, prompt for the passcode length input
// and calculate/return the number of tries
function initiateGame(&$length)
{
    for ($i = 0; $i <= 55; $i++) {
        echo "=";
    }
    echo "\nTwo players passcode guessing game by Paramjot Kaur\n";
    for ($j = 0; $j <= 55; $j++) {
        echo "=";
    }
    echo "\nEnter the length of the passcode for the game session: ";
    $length = readline();
    if ($length <= 3) {
        $tries = $length * 3;
    } else {
        $tries = 10;
    }
    return $tries;
}
//This function generate the two passcodes.
//Remember the rule that any digit in the passcode cannot be repeated more than twice
function generatePasscodes($length)
{
    $passcodesUser = array();
    $passcodesComp = array();
    $i = 0;
    $j = 0;
    while ($i < $length || $j < $length) {
        if ($i < $length) {
            $randomNumUser = rand(0, 9);
            $countRandNumUser = 0;
            foreach ($passcodesUser as $value) {
                if ($randomNumUser == $value) {
                    $countRandNumUser++;
                }
            }
            if ($countRandNumUser != 2) {
                array_push($passcodesUser, $randomNumUser);
                $i++;
            }
        }
        if ($j < $length) {
            $randomNumComp = rand(0, 9);
            $countRandNumComp = 0;
            foreach ($passcodesComp as $value) {
                if ($randomNumComp == $value) {
                    $countRandNumComp++;
                }
            }
            if ($countRandNumComp != 2) {
                array_push($passcodesComp, $randomNumComp);
                $j++;
            }
        }
    }
    $passcodes = array($passcodesUser, $passcodesComp);
    return $passcodes;
}

//This function create the datastructure (arrays) to track the user progress in the game
function createArrays($passcodes)
{
    $arrayLength = count($passcodes[0]);
    $maskedUserArray = array();
    $maskedCompArray = array();
    for ($i = 0; $i < $arrayLength; $i++) {
        array_push($maskedUserArray, '*');
        array_push($maskedCompArray, '*');
    }
    $passcode1 = array("original" => $passcodes[0], "masked" => $maskedUserArray);
    $passcode2 = array("original" => $passcodes[1], "masked" => $maskedCompArray);
    $passcodeArrays = array($passcode1, $passcode2);
    return $passcodeArrays;
}

// //This function prints out the passcodes in its masked form.
function printMasked(&$passcodeArray)
{
    $maskedArray = $passcodeArray["masked"];
    foreach ($maskedArray as $val) {
        echo $val;
    }
}

// //This function handles the user and computer guesses and print the masked version of the passcodes
function handleGuess(&$passcodeArray1, &$passcodeArray2)
{
    echo "\nPlease enter a guess: ";
    $userGuess = readline();
    $userOriginalArray = $passcodeArray1["original"];
    $userMaskedArray = $passcodeArray1["masked"];
    for ($i = 0; $i < count($userOriginalArray); $i++) {
        if ($userGuess == $userOriginalArray[$i]) {
            $passcodeArray1["masked"][$i] = $userGuess;
        }
    }
    echo "Your Challenge Passcode: ";
    printMasked($passcodeArray1);
    $compGuess = rand(0, 9);
    $compOriginalArray = $passcodeArray2["original"];
    $compMaskedArray = $passcodeArray2["masked"];
    for ($i = 0; $i < count($compOriginalArray); $i++) {
        if ($compGuess == $compOriginalArray[$i]) {
            $passcodeArray2["masked"][$i] = $compGuess;
        }
    }
    echo "\n\nComputer Guess: $compGuess";
    echo "\nComputer's Challenge Passcode: ";
    printMasked($passcodeArray2);
}

//This function checks to see if both the user and computer has entered all the correct characters or not
//and print a corresponding message
function checkStatus(&$passcodeArray1, &$passcodeArray2)
{
    $hasUserWon = true;
    foreach ($passcodeArray1["masked"] as $val) {
        if ($val == '*') {
            $hasUserWon = false;
        }
    }
    $hasCompWon = true;
    foreach ($passcodeArray2["masked"] as $val) {
        if ($val == '*') {
            $hasCompWon = false;
        }
    }
    if ($hasUserWon && $hasCompWon) {
        echo "\nYou draw with the computer. Cool!";
        return true;
    } else if ($hasCompWon) {
        echo "\nSorry you lost!";
        return true;
    } else if ($hasUserWon) {
        echo "\nYou won against the computer. You're a wizzard!";
        return true;
    }
    return false;
}
?>
