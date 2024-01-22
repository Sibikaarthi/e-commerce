<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname1 = $_POST['uname1'];
    $upswd1 = $_POST['upswd1'];


    if (!empty($uname1) && !empty($upswd1)) {
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "projectsignin";

    $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

    if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') '
        . mysqli_connect_error());
    }
    else{
        $SELECT = "SELECT uname1, upswd1 FROM signin WHERE uname1=? AND upswd1=?";
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("ss", $uname1, $upswd1);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "Login successful!";
        } else {
            echo "Invalid username or password. Please try again.";
        }

        $stmt->close();
        $conn->close();
    }
} else {
    echo "Both username and password are required";
}
}
?>
