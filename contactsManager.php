

<?php

function append($filename,$stringToWrite)
{
	$handle = fopen($filename, "a");
	fwrite($handle,$stringToWrite);
	fclose($handle);
}

function nukeThenWrite($filename,$stringToWrite)
{
	$handle = fopen($filename, "w");
	fwrite($handle,$stringToWrite);
	fclose($handle);
}



function userInput()
{

	fwrite(STDOUT,"Enter 1 to VIEW ALL contacts" . PHP_EOL .
		"Enter 2 to ADD a new contact" . PHP_EOL . 
		"Enter 3 to SEARCH contacts by name" . PHP_EOL . 
		"Enter 4 to DELETE a contact" . PHP_EOL . 
		"Enter 5 to EXIT Contacts-Manager" . PHP_EOL);

	$userInput = trim(fgets(STDIN));

	switch($userInput) {
	    case 1:
		    showContacts();
		    break;
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
		    echo "DID IT!!";
		    break;
		case 3:
			fwrite(STDOUT,"Enter a name or part of a name to search: ");
			$search = trim(fgets(STDIN));
		    searchContacts($search);
		    break;
		case 4:
			fwrite(STDOUT,"Enter the first name of the contact to delete: ");
			$delFirst = trim(fgets(STDIN));
			fwrite(STDOUT,"Enter the last name of the contact to delete: ");
			$delLast = trim(fgets(STDIN));
		    deleteContact($delFirst,$delLast);
		    break;
		case 5:
			echo "Bye Felecia!!!!! " . PHP_EOL;
		    break;
		default: 
			echo "thats not a correct input\n";
			break;

	}
}



function showContacts()
{
	$filename = 'contacts.txt';
	$handle = fopen($filename, 'r');
	$contents = fread($handle, filesize($filename));
	fclose($handle);
	echo $contents . PHP_EOL;
	userInput();
	return $contents;
}


function addContact($first,$last,$number,$email)
{
	$message = "$first $last, $number, $email" . PHP_EOL;
	append("contacts.txt",$message);

}

function searchContacts($search)
{
	$filename = "contacts.txt";
	$handle = fopen($filename, 'r');
	$contents = trim(fread($handle, filesize($filename)));
	$contentsArray = explode("\n", $contents);
	fclose($handle);
	// print_r($contentsArray);
	foreach($contentsArray as $key => $contact){
		if(strstr($contact,$search) !== false){
			echo $contact. PHP_EOL;
		} else {
			echo "$contact did not meet the search criteria : $search !" . PHP_EOL;
		}
	}
	return $contact;
}

function deleteContact($delFirst,$delLast){
	$newContent = [];
	$filename = "contacts.txt";
	$handle = fopen($filename, 'r');
	$contents = trim(fread($handle, filesize($filename)));
	$contentsArray = explode("\n", $contents);
	fclose($handle);
	// print_r($contentsArray);


	foreach($contentsArray as $key => $contact){
		if((strstr($contact,$delFirst) === false) && (strstr($contact,$delLast) === false)){
			array_push($newContent,$contact);
			$newString = implode("\n",$newContent);
		}
	}
	$thisDude = strstr($contact,$delFirst);

	echo "$thisDude is being deleted" . PHP_EOL;

	nukeThenWrite('contacts.txt',$newString);

}






userInput();













