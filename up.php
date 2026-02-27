<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('max_execution_time', 600);
ini_set('memory_limit', '512M');

$servername = "localhost";
$username = "root";
$password = "";
/*$dbname = "edmsdb";*/

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

$file = "cities2.csv";
$handle = fopen($file, "r");

$conn->query("SET autocommit=0;");
$conn->query("START TRANSACTION;");

fgetcsv($handle); // Skip header row

$batch_size = 500;
$data_array = [];

while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $city = $conn->real_escape_string(trim($data[0]));
    $country = $conn->real_escape_string(trim($data[1]));

    $data_array[] = "('$city', '$country')";

    if (count($data_array) >= $batch_size) {
        $sql = "INSERT INTO cities (city, country) VALUES " . implode(",", $data_array);
        $conn->query($sql);
        $data_array = [];
    }
}

// Insert remaining rows
if (!empty($data_array)) {
    $sql = "INSERT INTO cities (city, country) VALUES " . implode(",", $data_array);
    $conn->query($sql);
}

$conn->query("COMMIT;");
fclose($handle);
$conn->close();

echo "✅ Data successfully imported!";
?>
