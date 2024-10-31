<?php

include'Dbh.php';


class userLogin extends Dbh{


		public function login(){
				
			$data = json_decode(file_get_contents('php://input'), true);
	      $email = $data['data']["email"];
	      $password = $data['data']["password"];
		   $sql = "SELECT * FROM users WHERE email = :email ";
	      $stmt = $this->connect()->prepare($sql);
	      $stmt->execute(array(
	        ":email" => $email
	      ));
	      $user_fetch = $stmt->fetchAll();

	      $pass_Hash_DB = $user_fetch[0]['password'];


	     if (password_verify($password, $pass_Hash_DB)) {
	     	
	     	// Válasz küldése
	      $response = [
	    	"user_fetch" => $user_fetch,
	        "message" => "Sikeres bejelentkezés"
	        // Egyéb válaszadatok
	        // ...
	      ];	       
	       echo json_encode($response);
	       
	     }else{

	      $response = [
	    	"user_fetch" => 'Sikertelen',
	        "message" => "Helytelen jelszó"
	        // Egyéb válaszadatok
	        // ...
	      ];
	       echo json_encode($response);
	     }

	}
}

			$adat = new userLogin();
			$adat->Login();