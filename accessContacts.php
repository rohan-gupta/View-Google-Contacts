<?php
	
	session_start();
	
	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

	$dbhost = $url["host"];
	$dbuser = $url["user"];
	$dbpassword = $url["pass"];
	$dbname = substr($url["path"], 1);
	

	$email = $_SESSION['email'];

	include('./google-api-php-client-2.1.1/vendor/autoload.php');

    $client = new Google_Client();
    $client->setAuthConfigFile('client_id.json');
    $client->addScope("https://www.googleapis.com/auth/contacts.readonly");
    $client->addScope("https://www.googleapis.com/auth/user.phonenumbers.read");

    
    if(isset($_GET['code'])){

    	$client->authenticate($_GET['code']);
    	$access_token = $client->getAccessToken();
    	$client->setAccessToken($access_token);

    	$optParams = array(
    		'pageSize' => 500,
  			'requestMask.includeField' => 'person.names,person.emailAddresses,person.phoneNumbers'
		);

    	$service = new Google_Service_People($client);
    	$results = $service->people_connections->listPeopleConnections('people/me', $optParams);

    	$sql = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);

    	$query = "TRUNCATE TABLE `Task`.`". $email. "`";
    	mysqli_query($sql,$query);

		foreach($results->getConnections() as $person) {

				$names = $person->getNames();
				$phones = $person->getPhoneNumbers();

				if(isset($names[0])){
					$name = $names[0];
					$fullname = $name->getDisplayName();
				} 

				if(isset($phones[0])){
					$phone = $phones[0];
					$phonenumber = $phone->getValue();	
				}

			$query = "INSERT INTO `Task`.`". $email. "` (fullName, phoneNumber) VALUES('$fullname','$phonenumber')";
			mysqli_query($sql,$query);

			$fullname = '';
			$phonenumber = '';
		}
		$client->revokeToken();
		header('Location: contacts.php');

    }