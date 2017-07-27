

<?php

function append($filename,$stringToWrite)
	{
		$handle = fopen($filename, "a");
		fwrite($handle,$stringToWrite);
		fclose($handle);
	}

function userInput(){

	fwrite(STDOUT,"Enter 1 to VIEW ALL contacts\nEnter 2 to ADD a new contact\nEnter 3 to SEARCH contacts by name\nEnter 4 to DELETE a contact\nEnter 5 to EXIT Contacts-Manager\n");

	$userInput = fgets(STDIN);

	switch($userInput) {
	    case 1:
		    showContacts();
		case 2:
			frwite(STDOUT,"Enter first name");
			$first = fgets(STDIN);
			frwite(STDOUT,"Enter last name");
			$last = fgets(STDIN);
			frwite(STDOUT,"Enter phone number");
			$number = fgets(STDIN);
			frwite(STDOUT,"Enter email");
			$email = fgets(STDIN);
		    addContact($first,$last,$number,$email);
		    echo "DIDI IT!!";
		    break;
		case 3:
		    searchContacts();
		    break;
		case 4:
		    deleteContact();
		    break;
		case 5:
		    exitManager();
		    break;
		default: 
			echo "thats not a correct input\n";
			break;

	}
}

userInput();

// function addContact($first,$last,$number,$email){

// }












