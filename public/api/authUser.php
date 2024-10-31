<?php


include'Dbh.php';

class authUser extends Dbh{


	public function auth($get){

		
       	  $authToken = $get;
		  $sql       = "SELECT * FROM users WHERE token = :authToken";
	      $stmt      = $this->connect()->prepare($sql); 
	      
	      $stmt->execute(array(
	        ":authToken" => $authToken
	      ));
	      $user_details = $stmt->fetchAll();

	      #var_dump($user_details);

		   // Válasz küldése
	      $response = [
	    	"auth_token_fetch" => $user_details,
	        "message" => "Sikeres adatfeldolgozás"
	        // Egyéb válaszadatok
	        // ...
	    ];
	       echo json_encode($response);

	}

}

$get = filter_input(INPUT_GET, 'auth');
$auth = new authUser;
$auth->auth($get);