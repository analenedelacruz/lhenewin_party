<?php 
$conn = mysqli_connect("localhost","root","","website");
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $confirmpass = $_POST["confirmpassword"];

    if ($pass == $confirmpass)
    {
        $sql = "UPDATE user SET password = '$pass' WHERE email = '$email'";
        $result = $conn->query($sql);
        echo
        "
        <script>
        alert('You can now login!');
        document.location.href = 'sign-in.php';
        </script>
        ";
        
    }
    else {
        echo
        "
        <script>
        alert('Password not same in re-entering password!');
        document.location.href = 'reset.php';
        </script>
        ";
    }
}

?>