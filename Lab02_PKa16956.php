<?php

/**
 * Student Name:            Paramjot Kaur
 * Student ID:              300316956
 * Assignment/File Name:    Lab02/Lab02_PKa16956.php
 **/

require('inc/passcode.inc.php');

// provide the initial value of passcode length. The value will be 
// modified in the initiateGame() 
$passcodeLength = 0;  

//Initiate the game and calculate the number of tries for the user
$tries = initiateGame($passcodeLength);

//Return the generated passcodes to be guessed!
$passcodes = generatePasscodes($passcodeLength);


//Construct the array we are going to use for the rest of the program based on the passcodes.
//Use list construct to get the arrays. $a, $b are example array variables
list($a,$b) = createArrays($passcodes);
$exit=false;
$isFirst = true;
 
// while the users still has tries
while($tries>0 && !$exit)
{
    //Display the masked version of the passcode on first instance.  
    if($isFirst) 
    {
        echo "\n\nGuess the following passcode : ";
        printMasked($a);   
        echo "\nComputer will guess the following passcode: ";
        printMasked($b);
        echo "\n";
        $isFirst=false;
    }        
       
    // handle the guess of both players 
    handleGuess($a,$b);   

    // check the status of both players' guesses  
    $exit = checkStatus($a,$b);     

    //Tell the user how many tries they have left. 
    $tries--;
    
    if(!$exit && $tries!=0)
    {
        echo "\n\nYou have $tries chances left !";    
    }   
}

//If there's no more tries, print a message to the user and exit the game
if($tries==0 && !$exit)
echo "\nSorry, out of tries.";
?>