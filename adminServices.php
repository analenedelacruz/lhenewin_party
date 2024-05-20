<?php

$conn = mysqli_connect("localhost","root","","website");
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM tbl_services ORDER BY packageCode ASC";
$result = mysqli_query($conn,$query);


if(isset($_GET['delete'])){
    $packageCode = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM tbl_services WHERE packageCode = '$packageCode'");
    header('location:adminServices.php');
    };

?>
<html>
    <head>
        <title>Lherwin Party</title>
        <link href="./style.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        
        <style>

        .dropdown {
            color: white;
            padding: 3% 0 10px 0;
            }

            .dropdown-content {
            display: none;
            position: absolute;
            top: 65%;
            background-color: #2EC5CD;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            text-decoration: none;
            }

            .dropdown-content a {
            display: block;
            text-decoration: none;
            }

            .dropdown:hover .dropdown-content {
            display: block;
            }
        </style>
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
        <br><br><h1 style="font-size: 25px; text-align: center;">Services</h1>
        <br><br>
        <center><b><a href="addServices.php" style="text-decoration:none; " class="submit">Add Services</a></b></center>        
        <br><br>
        <div style="display: flex; justify-content: center;">
            <div>
                <table style="height: auto; width: 100%; border-collapse: collapse; border: 1px solid black;">
                    <tr style="background: lightblue;">
                        <th style="padding:10px; color: black; border-left:1px solid black;">Package</th>
                        <th style="padding:10px; color: black; border-left:1px solid black;">Poster</th>
                        <th style="padding:10px; color: black; border-left:1px solid black;">Price</th>
                        <th style="padding:10px; color: black; border-left:1px solid black;">Package Details</th>
                        <th style="padding:10px; color: black; border-left:1px solid black;">Action</th>
                    </tr>

                    <tr>
                    <?php
                        while($row = mysqli_fetch_assoc($result))
                        {
                         ?>
                        <td style="background: aliceblue;text-align:center; text-transform:uppercase; border-right: 1px solid gray; border-bottom: 1px solid gray;"><b><?php echo $row['packageCode']; ?></b></td>
                        <td style="background: aliceblue;text-align:center; border-right: 1px solid gray; border-bottom: 1px solid gray;"><img src="services/<?php echo $row['poster']; ?>" height="200" width="150" alt=""></td>
                        <td style="background: aliceblue;text-align:center; border-right: 1px solid gray; border-bottom: 1px solid gray;"><?php echo $row['price']; ?></td>
                        <td style="background: aliceblue;text-align:center; padding:10px; border-right: 1px solid gray; border-bottom: 1px solid gray;"><?php echo nl2br(htmlspecialchars($row['details'], ENT_QUOTES, 'UTF-8')) ?></td>
                        <td style="background: aliceblue;text-align:center; border-right: 1px solid gray; border-bottom: 1px solid gray;">
                            <a href="editServices.php?edit=<?php echo $row['packageCode']; ?>" style="text-decoration:none; "><span class="material-symbols-outlined" style="background-color:green;border:1px solid green;color:white;padding:3px;">  edit  </span></a><br><br>
                            <a href="adminServices.php?delete=<?php echo $row['packageCode']; ?>" style="text-decoration:none; "><span class="material-symbols-outlined" style="background-color:red;border:1px solid red;color:white; padding:3px;">delete</span></a>
                        </td>

                    </tr>
                    <?php
                        }

                        ?>
                </table>
            </div>
        </div>

        <br>
        
    </body>
</html>