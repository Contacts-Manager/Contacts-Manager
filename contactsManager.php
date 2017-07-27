<?php
	fwrite(STDOUT,"What is your name?");
	$userName = trim(fgets(STDIN));

//appending to file
function append($filename,$stringToWrite)
{
	$handle = fopen($filename, "a");
	fwrite($handle,$stringToWrite);
	fclose($handle);
}
//nuking file content then rewriting
function nukeThenWrite($filename,$stringToWrite)
{
	$handle = fopen($filename, "w");
	fwrite($handle,$stringToWrite);
	fclose($handle);
}
//main function
function mainMenu($userName)
{	
	fwrite(STDOUT,PHP_EOL . "Enter 1 to VIEW ALL contacts" . PHP_EOL .
		"Enter 2 to ADD a new contact" . PHP_EOL . 
		"Enter 3 to SEARCH contacts by name" . PHP_EOL . 
		"Enter 4 to DELETE a contact" . PHP_EOL . 
		"Enter 5 to EXIT Contacts-Manager" . PHP_EOL . PHP_EOL);

	$userInput = trim(fgets(STDIN));

	switch($userInput) {
	    case 1:
		    showContacts($userName);
		    break;
		case 2:
			fwrite(STDOUT,"Enter first name: ");
			$first = trim(fgets(STDIN));
			fwrite(STDOUT,"Enter last name: ");
			$last = trim(fgets(STDIN));


			fwrite(STDOUT,"Enter phone number: ");
			$number = trim(fgets(STDIN));
			while (strlen($number) !== 10) {
				echo "Please enter a 10 digit phone number" . PHP_EOL;
				$number = trim(fgets(STDIN));
			}


			fwrite(STDOUT,"Enter email: ");
			$email = trim(fgets(STDIN));
			while (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo "Please enter a valid Email brosif" . PHP_EOL;
				$email = trim(fgets(STDIN));
			}



		    addContact($first,$last,$number,$email,$userName);
		    echo "DID IT!!";
		    break;
		case 3:
			fwrite(STDOUT,"Enter a name or part of a name to search: ");
			$search = trim(fgets(STDIN));
		    searchContacts($search,$userName);
		    break;
		case 4:
			fwrite(STDOUT,"Enter the first name of the contact to delete: ");
			$delFirst = trim(fgets(STDIN));
			fwrite(STDOUT,"Enter the last name of the contact to delete: ");
			$delLast = trim(fgets(STDIN));
		    deleteContact($delFirst,$delLast,$userName);
		    break;
		case 5:
			closeProgram($userName);
		    break;
		default: 
			echo "thats not a correct input\n";
			break;
	}
	
}
//display all content of contacts.txt
function showContacts($userName)
{
	$filename = 'contacts.txt';
	$handle = fopen($filename, 'r');
	$contents = fread($handle, filesize($filename));
	fclose($handle);
	echo $contents . PHP_EOL;
	mainMenu($userName);
	return $contents;
}
//adding single contact
function addContact($first,$last,$number,$email,$userName)
{
	$message = "$first $last, $number, $email" . PHP_EOL;
	append("contacts.txt",$message);
	mainMenu($userName);

}
//parsing through content for specific contact
function searchContacts($search,$userName)
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
	mainMenu($userName);
	return $contact;
}
//deleting one or more contacts that contain search criteria
function deleteContact($delFirst,$delLast,$userName)
{
	$newContent = [];
	$filename = "contacts.txt";
	$handle = fopen($filename, 'r');
	$contents = fread($handle, filesize($filename));
	$contentsArray = explode("\n", $contents);
	fclose($handle);
	foreach($contentsArray as $key => $contact){
		$contactArray = explode(", ",$contact);
		if((strpos($contactArray[0],$delFirst) == false) && (strpos($contactArray[0],$delLast) == false)){
			array_push($newContent,$contact);
			$newString = implode("\n",$newContent);
		} else {
			echo "$contact is being deleted" . PHP_EOL;
		}
	}
	nukeThenWrite('contacts.txt',$newString);
	mainMenu($userName);
}

function closeProgram($userName){
	echo "Bye $userName!!!!! " . PHP_EOL;
}
//calling main function to begin
mainMenu($userName);













