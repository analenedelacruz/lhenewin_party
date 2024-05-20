<?php
session_start(); 
$conn = mysqli_connect("localhost","root","","website");
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


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
        <div class="content">
            <div class="left">
                <div style="padding: 50px 0;">
                    <h1 style="font-family: 'Impact';">Lhenewin Party Shop And Services</h1>
                    <p style="margin-top: 20px;text-align:right;">Affordable and has a good service</p>
                    <div class="info" style="margin-top: 40px;">
                        <ul>
                            <li><i class="fa-solid fa-location-arrow"></i>Blk16 lot13 Langaray St.,Dagat dagatan Caloocan City, Philippines</li>
                            <li><i class="fa-solid fa-mobile"></i> 0981 047 6144</li>
                            <li><i class="fa-solid fa-envelope"></i> lhenewinpartyss@gmail.com</li>
                        </ul>
                    </div>
                </div>
                
            </div>
            <div class="right">
                <img src="picture.jpg" style="width:100%;">
            </div>
        </div>
    
    </body>
</html>