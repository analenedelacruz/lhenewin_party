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
        </div><br><br><br><br>
        <div style="display: flex; flex-wrap: wrap;">
            <div style="width: 321px; height: 370px; margin-left: 15px; background: aliceblue; box-shadow: 0px 0px 5px black;">
                <h1 style="font-family: 'Impact';text-align:center;">Company Profile</h1>
                <p style="margin-top: 20px;text-align: center;">Lhenewin Party Shop as a small business 
                because the size of their shop was fit for new business.<br><br>
                Lhenewin Party Shop aims to serve and give high-quality of services for their clients.<br><br>
                Lhenewin Party Shop has a branch and main office is located in 
                Blk16 lot 13 Langaray St., Dagat-dagatan Caloocan City.<br><br>It is owned by Ms. Charlene GAdi and 
                Mr. Sherwin Adie. It was establish on July 7, 2019 and the main office they were start with a minimal items.</p><br>
            </div><br><br>
            <div style="width: 321px; height: 370px; margin-left: 15px; background: aliceblue; box-shadow: 0px 0px 5px black;">
                <h1 style="font-family: 'Impact';text-align:center;">Mission</h1>
                <p style="margin-top: 20px;text-align: center;"> - Provide quality, affordable prices for ocassion.<br><br> 
                - Create and cultivate long-term relationship with clients.<br><br>
                - Respond immediately to the changing needs of our clients.<br><br> 
                - Achieve complete clients satifaction. Improve our service contionously</p><br>
            </div><br><br>
            <div style="width: 321px; height: 370px; margin-left: 15px; background: aliceblue; box-shadow: 0px 0px 5px black;">
                <h1 style="font-family: 'Impact';text-align:center;">Vision</h1>
                <p style="margin-top: 20px;text-align: center;">- The vision of Lhenewin Party Shop is to be recognize as one of the best party services.</p><br>
            </div>
        </div>
        <br>
        <h1 style="text-align:center; font-style:25px;"></h1>
    </body>
</html>