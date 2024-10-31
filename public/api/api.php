<?php
ob_start();


class API extends Dbh{

	#public $api_key = "EWRFGFHFH-2345452342356-GHJDFSAGJJ21334545346";
	#public $token = "3466743_HJGHJDGSFV_RTET6983";
	

	public function __construct(){

		#$this->Request();
		#$this->checkKey($get);
	
		
		$this->registerUser();


	}


	public function Request (){

		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			
			die("Nem támogatott Request");
		}
	}


    public function checkKey($get){
    	
	
	    $token = $get["token"];
		if ($token !== $this->token) {


		header('HTTP/1.0 403 Forbidden');

		http_response_code(403);
        echo "HTTP/1.0 403 Forbidden";

		echo "<br>";
		throw new Exception("Invalid Token");
        die();
	}

	if ($get["api_key"] !== "EWRFGFHFH-2345452342356-GHJDFSAGJJ21334545346") {

		throw new Exception("Invalid API kulcs");

		header('HTTP/1.0 403 Forbidden');

		http_response_code(403);
		
        echo "HTTP/1.0 403 Forbidden";
        die();
	}
	
}







    public function getUserData($email){

	      $data  = json_decode(file_get_contents('php://input'), true);
	      $email = $data['data']["email"];
		  $sql   = "SELECT token FROM users WHERE email = :email ";
	      $stmt  = $this->connect()->prepare($sql); 
	      
	      $stmt->execute(array(
	        ":email" => $email
	      ));
	      $token_fetch = $stmt->fetchAll();
		      // Válasz küldése
	      $response = [
	    	"token_fetch" => $token_fetch,
	        "message" => "Sikeres adatfeldolgozás"
	        // Egyéb válaszadatok
	        // ...
	    ];
	       echo json_encode($response);

      }


	public function registerUser(){


	      $data = json_decode(file_get_contents('php://input'), true);

		 if(empty($data['data']["fullName"]) || empty($data['data']["email"]) || empty($data['data']["password"])){

		 	throw new Exception('Nem lehetnek üres adatok!');
		 	$response = [	    	
	        "message" => "Nem lehetnek üres adatok!"
	        
	    ];
	       echo json_encode($response);
		 	die();
		 }			


	      $email = $data['data']["email"];
	      $sql = "SELECT * FROM users WHERE email = :email";
	      $stmt = $this->connect()->prepare($sql);
	      $stmt->execute(array(
	          ":email" => $email
	        ));
	       
	        $count = $stmt->rowCount();
	        #echo $count;
	        if ($count > 0) {

	        $response = [
		        "message" => "Ez az email már létezik" ];
		        echo json_encode($response);
		        exit();


	       }else{

		    $data     = json_decode(file_get_contents('php://input'), true);
		    $name     = $data['data']["fullName"];
		    $email    = $data['data']["email"];
		    $password =  password_hash($data['data']["password"], PASSWORD_BCRYPT);
		  
 
		    // Adatok feldolgozása és egyéb műveletek
		    $token      = str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
		    $created_at = date("Y-m-d H:i:s");    
		    $sql        = "INSERT INTO users (name, email, password, token, created_at) VALUES (:name, :email, :password, :token, :created_at)";

		    $stmt = $this->connect()->prepare($sql);    	
		    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
		    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
		    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
		    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
		    $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);
		    $stmt->execute();

		    $this->getUserData($email);

	}

}
}