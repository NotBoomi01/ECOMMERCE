<?php 

$fullname = $_POST["fullName"];

$username = $_POST["username"];

$password = $_POST["password"];

$confirmPassword = $_POST["confirmPassword"];

if($_SERVER["REQUEST_METHOD"]== "POST"){

 if(trim($password) == trim($confirmPassword)){
    $host = "localhost";
    $database = "ecommbatch1";
    $username = "root";
    $password = "";

    $dsn = "mysql: host=$host;dbname=$database;";
    try {
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::FETCH_ASSOC);
        $stmt = $conn->prepare('INSERT INTO users (fullname,username,password,created_at, updated_at) Values (:p_fullname, :p_username, :p_password,NOW(),NOW())');
        $stmt->bindParam(':p_fullname',$fullname);
        $stmt->bindParam(':username',$username);
        $stmt->bindParam(':password',$password);
        $stmt->execute();

            

        echo "Connection Successful: ";
    } catch (Exception $e){
        echo "Connection Failed: " . $e->getMessage();

    }

} else {
    header("location: /registration.php?error=Password not the same");
    exit;
}

}


?>