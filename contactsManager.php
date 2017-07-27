

<?php

function append($filename,$stringToWrite)
	{
		$handle = fopen($filename, "a");
		fwrite($handle,$stringToWrite);
		fclose($handle);
	}

function userInput(){

	fwrite(STDOUT,"Enter 1 to VIEW ALL contacts" . PHP_EOL .
		"Enter 2 to ADD a new contact" . PHP_EOL . 
		"Enter 3 to SEARCH contacts by name" . PHP_EOL . 
		"Enter 4 to DELETE a contact" . PHP_EOL . 
		"Enter 5 to EXIT Contacts-Manager" . PHP_EOL);

	$userInput = trim(fgets(STDIN));

	switch($userInput) {
	    case 1:
		    showContacts();
		case 2:
			fwrite(STDOUT,"Enter first name: ");
			$first = trim(fgets(STDIN));
			fwrite(STDOUT,"Enter last name: ");
			$last = trim(fgets(STDIN));
			fwrite(STDOUT,"Enter phone number: ");
			$number = trim(fgets(STDIN));
			fwrite(STDOUT,"Enter email: ");
			$email = trim(fgets(STDIN));
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

function addContact($first,$last,$number,$email){
	$message = "$first $last, $number, $email" . PHP_EOL;

	append("contacts.txt",$message);

}












