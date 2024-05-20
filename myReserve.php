<?php
session_start();
$conn = mysqli_connect("localhost","root","","website");
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$email = $_SESSION['email'];
$query = "SELECT * FROM reserve WHERE Email = '$email' ORDER BY CASE WHEN status = 'settled' THEN 1 ELSE 0 END, reservation_date";

$result = mysqli_query($conn,$query);



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
        <br><br><h1 style="font-size: 25px; text-align: center;">My Reservation</h1><br><br>
        <div style="display: flex; justify-content: center;">
            <div>
                <table style="height: auto; width: 900px; border-collapse: collapse; ">
                    <tr style="background: lightblue;">
                        <th style="color: black; border-right: 1px solid aliceblue;padding:10px;">Events</th>
                        <th style="color: black; border-right: 1px solid aliceblue;padding:10px;">Contact</th>
                        <th style="color: black; border-right: 1px solid aliceblue;padding:10px;">Package</th>
                        <th style="color: black; border-right: 1px solid aliceblue;padding:10px;">Price</th>
                        <th style="color: black; border-right: 1px solid aliceblue;padding:10px;">Reservation Date</th>
                        <th style="color: black; border-right: 1px solid aliceblue;padding:10px;">Time</th>
                        <th style="color: black; border-right: 1px solid aliceblue;padding:10px;">Place</th>
                        <th style="color: black; border-right: 1px solid aliceblue;padding:10px;">Reservation Status</th>
                    </tr>

                    <?php

                while ($row = mysqli_fetch_assoc($result)) {

                    if ($row['status']!='settled'){
                    ?>
                    

                    <tr style="width:100%;">
                        <td style="background: aliceblue; text-align: center; padding:10px; width:10%;"><?php echo $row['BirthdayCelebrant']; ?></td>
                        <td style="background: aliceblue;padding:5px; text-align:center;width:10%"><?php echo $row['contact']; ?></td>
                        <td style="background: aliceblue; text-align: center; padding:10px; width:10%; text-transform:uppercase;"><?php echo $row['Package']; ?></td>
                        <td style="background: aliceblue; text-align: center; padding:10px; width:10%;"><?php echo $row['Price']; ?></td>
                        <td style="background: aliceblue; text-align: center; padding:10px; width:20%;"><?php echo date('F j, Y', strtotime($row['reservation_date'])); ?></td>
                        <td style="background: aliceblue; text-align: center; padding:10px; width:10%;"><?php echo $row['Time']; ?></td>
                        <td style="background: aliceblue; text-align: center; padding:10px; width:10%;"><?php echo $row['Place']; ?></td>
                        <td style="background: aliceblue; text-align: center; padding:10px; width:20%;">
                            <?php
                            if ($row['status'] == 'pending') {
                                ?>
                                <div style='color:blue; text-transform:uppercase; margin-bottom:5px;'><b><?php echo $row['status']; ?>ㅤ</b><span>
                                <a href="cancel.php?id=<?php echo $row['id']; ?>"><button style="background-color: red; color:white; padding:5px;">Cancel</button></a></span></div>
                                <?php
                            } else {
                                echo "<div style='color:#FFBF00; text-transform:uppercase;'><b>".$row['status']."</b></div>";
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                    }else{ ?>
                    <tr style="width:100%;">
                        <td style="background: aliceblue; text-align: center; padding:10px; width:20%;"><?php echo $row['BirthdayCelebrant']; ?></td>
                        <td style="background: aliceblue;padding:5px; text-align:center;width:10%"><?php echo $row['contact']; ?></td>
                        <td style="background: aliceblue; text-align: center; padding:10px; width:10%; text-transform:uppercase;"><?php echo $row['Package']; ?></td>
                        <td style="background: aliceblue; text-align: center; padding:10px; width:10%;"><?php echo $row['Price']; ?></td>
                        <td style="background: aliceblue; text-align: center; padding:10px; width:20%;"><?php echo date('F j, Y', strtotime($row['reservation_date'])); ?></td>
                        <td style="background: aliceblue; text-align: center; padding:10px; width:10%;"><?php echo $row['Time']; ?></td>
                        <td style="background: aliceblue; text-align: center; padding:10px; width:10%;"><?php echo $row['Place']; ?></td>
                        <td style="background: aliceblue; text-align: center; padding:10px; width:20%;">
                            <b style="color:green; text-transform:uppercase;"><?php echo $row['status']; ?></b>
                        </td>
                    </tr>
                    <?php
                        }
                        }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>