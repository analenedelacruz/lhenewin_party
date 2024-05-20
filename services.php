<?php
session_start(); 

$conn = mysqli_connect("localhost","root","","website");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



$query = "select * from tbl_services";
$result = mysqli_query($conn,$query);



$email = $_SESSION['email'];
$selUser = "select * FROM user WHERE Email = '$email'";
$result2 = mysqli_query($conn,$selUser);
?>

<html>
    <head>
        <title>Lherwin Party</title>
        <link href="./style.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>
            .row{
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }
        </style>

    </head>
    <body>
        <div class="header">
            <a href="index.html">
                <div class="logo"></div>
            </a>
            <ul>
                <li><a href="main.php">Home</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="myReserve.php">My Reserve</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="about.php">About</a></li>
                <?php
                    while($row = mysqli_fetch_assoc($result2))
                    {
                ?>
                <li><div class="dropdown">
                    <span style="text-transform: capitalize;"><i class="fas fa-user-circle"></i> <b><?php echo $row['First_Name']; ?></b></span>
                    <div class="dropdown-content">
                    <a href="logout.php">Logout</a>
                    </div>
                </div></li>
                <?php
                    }
                ?>
            </ul>
        </div>
        <br><br><br>
        <h1 style="font-size:25px; margin-left:150px;">Services Offered </h1>
        <div class="row">
        <?php while($row = mysqli_fetch_assoc($result))
            { 
        ?>
             <div class="div_0">
                <a href="reservation.php?id=<?php echo $row['packageCode']; ?>" style="text-decoration: none;"><div class="div_1"><img src="services/<?php echo $row['poster']; ?>" class="img"><p style="background-color: lightblue; text-align: center; margin: 0px 10px; border-radius: 5px; color: black;">Price: <?php echo number_format($row['price'], 2); ?></p></div></a>
                
            </div>
        <?php };?>
        </div>

        <br><br><br><br><br>
        </div>
    </body>
</html>