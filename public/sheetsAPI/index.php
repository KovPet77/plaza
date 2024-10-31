<?php
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

echo"Metódus:";
echo $method;
echo"<br>";
// Olvasd be a nyers adatokat
$input = file_get_contents('php://input', true);
//var_dump(file_get_contents('php://input'));



// Loggoljuk a beérkező adatokat
file_put_contents('php://stderr', "Input: $input\n"); // Ez megjeleníti a hiba naplóban

// Ellenőrizd a JSON formátumot
if (empty($input)) {
    echo json_encode(array("error" => "No input received"));
    exit;
}

$data = json_decode($input, true);

echo"DATA:";
var_dump($data);
// Ellenőrizd, hogy a JSON dekódolás sikeres volt-e
if (json_last_error() === JSON_ERROR_NONE) {
    // Végrehajthatod az adatfeldolgozást
    $processedData = array_map(function($row) {
        $row[] = "Processed";
        return $row;
    }, $data['sheetData']);
    
    // Válasz küldése
    //echo json_encode(array("processedData" => $processedData));
} else {
    echo json_encode(array("error" => "Invalid JSON format"));
}
?>
