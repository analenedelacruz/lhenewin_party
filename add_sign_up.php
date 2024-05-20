<?php

if(isset($_POST["submit"]))
{
    $first = $_POST["first"];
    $last = $_POST["last"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $pass = $_POST["pass"];
    $address = $_POST["address"];
    
    // Connection to database
    $conn = mysqli_connect("localhost","root","","website");
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "INSERT INTO user (First_Name, Last_Name, Email, Phone, Password, Address) VALUES ('$first','$last','$email','$phone','$pass','$address')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location:sign-in.php");
        exit;
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      
      mysqli_close($conn);
}
?>