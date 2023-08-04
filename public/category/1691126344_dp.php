<?php
$servername = "localhost";
$username = "root";
$password = "";
$database ="dbhaider1";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if (!$conn) {
  die("Connection failed: " .  mysqli_connect_error());
}
else 
{
    echo " Connection successfully";
}
 $sql = " CREATE TABLE products ( id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY, Product_name VARCHAR(30) NOT NULL, Price INT(5) NOT NULL )";
$sql = "INSERT INTO products (Product_name, Price)
VALUES ('P1', 100);";
$sql .= "INSERT INTO products (Product_name, Price)
VALUES ('P2', 10);";
$sql .= "INSERT INTO products (Product_name, Price)
VALUES ('P3', 20);";
$sql = "INSERT INTO products (Product_name, Price)
VALUES ('P4', 70);";
$sql .= "INSERT INTO products (Product_name, Price)
VALUES ('P5', 50);";
$sql .= "INSERT INTO products (Product_name, Price)
VALUES ('P6', 60);";
if ($conn->multi_query($sql) === TRUE) {
  echo "New records created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>



<!-- 
// echo "Connected successfully";

// $sql = "CREATE TABLE MyGuests (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// firstname VARCHAR(30) NOT NULL,
// lastname VARCHAR(30) NOT NULL,
// email VARCHAR(50),
// reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
// )";
// $sql = "INSERT INTO MyGuests (firstname, lastname, email)
// VALUES ('John', 'Doe', 'john@example.com')";
// $firstname= "John";
// $lastname = "Khan";
// $emial= "haider505@gmail.com";

// $stmt = $conn->prepare("INSERT INTO MyGuest( firstname ,lastname, email) VALUES (?, ? ,?)");
// print_r($firstname);
// $stmt->bind_param("sss", $firstname, $lastname, $email);

// $stmt = $conn->prepare("INSERT INTO  myguests(firstname, lastname, email) VALUES(?,?,?)");
// $stmt->bind_param("sss", $firstname, $lastname, $emial);

// $stmt->execute();
// echo " New record create sussessfully";
// if($conn->query($sql) === TRUE)
// {
//       $last_id = $conn->insert_id;
//     echo " Table is created successfully" . $last_id ;

// }
// else 
// {
//      echo " table is not created successfully";
// } -->