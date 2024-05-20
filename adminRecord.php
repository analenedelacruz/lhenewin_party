<?php

$conn = mysqli_connect("localhost","root","","website");
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$query = "select * from reserve WHERE status != 'cancelled' ORDER BY reservation_date DESC";
$result = mysqli_query($conn,$query);

    if (isset($_POST['update_status'])) {
        $reservationId = $_POST['reservation_id'];
        $newStatus = $_POST['status'];

        $updateQuery = "UPDATE reserve SET status = '$newStatus' WHERE id = $reservationId";
        mysqli_query($conn, $updateQuery);

        if ($updateQuery){
            header("Location:adminRecord.php");
            
        }
    }

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
                <li><a href="admin.php">Dashboard</a></li>
                <li><a href="adminRecord.php">Records</a></li>
                <li><a href="adminServices.php">Services</a></li>
                <li><div class="dropdown">
                    <span><i class="fas fa-user-circle"></i> <b>ADMIN</b></span>
                    <div class="dropdown-content">
                    <a href="logout.php">Logout</a>
                    </div>
                </div></li>
            </ul>
        </div>
        <br><br><h1 style="font-size: 25px; text-align: center;">Record of Reservation</h1><br><br>
        <div style="display: flex; justify-content: center;">
            <div>
            <table style="height: auto; width: 1000px; border-collapse: collapse; border: 1px solid black;">
                    <tr style="background: lightblue;">
                        <th style="color: black; border-right: 1px solid aliceblue;padding:10px;">Events</th>
                        <th style="color: black; border-right: 1px solid aliceblue;padding:10px;">Contact</th>
                        <th style="color: black; border-right: 1px solid aliceblue;padding:10px;">Package</th>
                        <th style="color: black; border-right: 1px solid aliceblue;padding:10px;">Price</th>
                        <th style="color: black; border-right: 1px solid aliceblue;padding:10px;">Reservation Date</th>
                        <th style="color: black; border-right: 1px solid aliceblue;padding:10px;">Time</th>
                        <th style="color: black; border-right: 1px solid aliceblue;padding:10px;">Reservation Status</th>
                    </tr>

                    <tr>
                    <?php
                        while($row = mysqli_fetch_assoc($result))
                        {
                         ?>
                        <td style="background: aliceblue;padding:5px; text-align:center; border-right: 1px solid gray; border-bottom: 1px solid gray;"><?php echo $row['BirthdayCelebrant']; ?></td>
                        <td style="background: aliceblue;padding:5px; text-align:center; border-right: 1px solid gray; border-bottom: 1px solid gray;"><?php echo $row['contact']; ?></td>
                        <td style="background: aliceblue;padding:5px; text-align:center; border-right: 1px solid gray; border-bottom: 1px solid gray;"><?php echo $row['Package']; ?></td>
                        <td style="background: aliceblue;padding:5px; text-align:center; border-right: 1px solid gray; border-bottom: 1px solid gray;"><?php echo $row['Price']; ?></td>
                        <td style="background: aliceblue;padding:5px; text-align:center; border-right: 1px solid gray; border-bottom: 1px solid gray;"><?php echo date('F j, Y', strtotime($row['reservation_date'])); ?></td>
                        
                        <td style="background: aliceblue;padding:5px; text-align:center; border-right: 1px solid gray; border-bottom: 1px solid gray;"><?php echo $row['Time']; ?></td>
                        <td style="background: aliceblue;padding:5px; text-align:center; border-right: 1px solid gray; border-bottom: 1px solid gray;">
                        <?php
                    if ($row['status'] == 'settled') {
                        echo "<div style='color:green; text-transform:uppercase;'><b>" . $row['status'] . "</b></div>";
                    }
                    else if ($row['status'] == 'reserved') {
                        echo "<form method='post'>
                        <select name='status' style='width: 50%; text-align:center;padding:5px;background-color:yellow;'>
                            <option value='' hidden>".$row['status']."</option>
                            <option value='settled' style='width: 10%;'>SETTLED</option>
                            <option value='cancelled' style='width: 10%;'>CANCEL</option>
                        </select>
                        <input type='hidden' name='reservation_id' value='". $row['id'] ."'>
                        <input type='submit' name='update_status' value='Update' style='background-color: green; color: white; padding:5px;'>
                    </form>";
                    }
                     else {
                    ?>
                        <form method="post">
                            <select name="status" style="width: 50%; text-align:center;padding:5px;">
                                <option value="" hidden><?php echo $row['status']; ?></option>
                                <option value="reserved" style="width: 10%;">RESERVE</option>
                                <option value="cancelled" style="width: 10%;">CANCEL</option>
                            </select>
                            <input type="hidden" name="reservation_id" value="<?php echo $row['id']; ?>">
                            <input type="submit" name="update_status" value="Update" style="background-color: green; color: white; padding:5px;">
                        </form>
                    <?php
                    }
                    ?>
                        </td>
                    </tr>
                    <?php
                        }

                        ?>
                </table>
            </div>
        </div>
    </body>
</html>