<?php

$passcheck = "";
$first = "";
$last = "";
$email = "";
$phone = "";
$pass = "";
$address = "";

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
    
    if (!preg_match("/^(?=.*[A-Z])(?=.*\d).{8,}$/", $pass)){
        $first = $_POST["first"];
        $last = $_POST["last"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $passcheck = "Password must contain: a minimum of 8 characters a lowercase and uppercase letter a number.";
    }

    else {
        $sql = "INSERT INTO user (First_Name, Last_Name, Email, Phone, Password, Address) VALUES ('$first','$last','$email','$phone','$pass','$address')";
    
        if (mysqli_query($conn, $sql)) {
            header("Location:index.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
        mysqli_close($conn);
    }
}

if (isset($_POST['']))
{
    header("Location:index.php");
    exit;
}
?>

<html>
    <head>
        <title>Lherwin Party</title>
        <link href="./sign-up.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <a href="index.php">
            <img src="logo.png" style="width: 150px;margin:0 auto;display:block;margin-bottom: 20px;">
        </a>
        <div class="content">
            <h1 style="text-align:center;">Create New Account</h1>
            <form action="" method="POST">
                <div class="row">
                    <div class="half">
                        <input type="text" placeholder="First Name" name="first" value="<?php echo $first;?>">
                    </div>
                    <div class="half right">
                        <input type="text" placeholder="Last Name" name="last" value="<?php echo $last;?>">
                    </div>
                </div>
                <input type="email" placeholder="E-mail Address" name="email" value="<?php echo $email;?>">
                <input type="text" placeholder="Mobile Number" name="phone" value="<?php echo $phone;?>">
                <input type="password" placeholder="Password" name="pass"><p style="background: red; color: white; padding: 10px 10px;"><?php echo $passcheck; ?></p>
                <input type="text" placeholder="Address" name="address" value="<?php echo $address;?>">
                <input type="submit" value="Create a New Account" class="blue" name="submit">
                <hr>
            </form>
            <a href="index.php"><button class="red">Already have an account?</button></a>
        </div>
    </body>
</html>