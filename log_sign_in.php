<?php
session_start();
if (isset($_POST["log"]))
{
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    // Connection to database
    $conn = mysqli_connect("localhost","root","","website");
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare a select statement
    if ($email == "admin" && $pass == "password")
    {
        header("Location:admin.php");
        exit();
    }

    else 
    {
        $sql = "SELECT * FROM user WHERE Email='$email' AND Password= '$pass'";
        
        $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) === 1) 
            {
                $row = mysqli_fetch_assoc($result);
                //Check the row of the email and password and identify if it right
                if ($row['Email'] === $email && $row['Password'] === $pass)
                {
                    $_SESSION['email'] = $row['Email'];
                    header("Location:main.php");
                    exit();
                }
            } 
            else {
                //Pop up when password or email are wrong
                echo
                "
                <script>
                alert('Invalid Password or Email!');
                document.location.href = 'index.php';
                </script>
                ";
            }
    }
}
?>