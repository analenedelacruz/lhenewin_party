<?php
session_start();

$conn = mysqli_connect("localhost","root","","website");
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$packageID = $_GET['id'];



$query = "SELECT * FROM tbl_services where packageCode = '$packageID'";
$result = mysqli_query($conn,$query);



if (isset($_POST['submit']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];   
    $gender = $_POST['gender'];
    $place = $_POST['place'];
    $package = $_POST['package'];
    $price = $_POST['price'];
    $reservation_date = $_POST['reservation_date'];
    $time = $_POST['time'];
    $request = $_POST['request'];
    $pay = $_POST['pay'];
    $ref = $_POST['ref'];

    // Create connection
    $conn = mysqli_connect("localhost","root","","website");
    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO reserve (BirthdayCelebrant, Email, contact, Gender, Place, Package, Price, Time, Request, Payment, Reference, reservation_date)
    VALUES ('$name', '$email','$contact', '$gender', '$place', '$package', '$price', '$time', '$request', '$pay', '$ref', '$reservation_date')";

    if (mysqli_query($conn, $sql)) {
    header("Location:main.php");
    exit;
    } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

if (isset($_POST['back']))
{
    header("Location:services.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 style="font-family: 'Impact';text-align:center;">Make Reservation</h1>
        <p style="margin-top: 20px;text-align:center;">Kindly fill up the reservation form.</p><br>
        <div style="display: flex; justify-content: center;">
        <?php while($row = mysqli_fetch_assoc($result))
            { 
        ?>
            <div style="border: 1px solid black; border-radius: 10px; padding: 30px 30px; background: aliceblue; box-shadow: 5px 10px 5px black;">
                <form action="" method="POST">
                    <label style="font-size: 17px;">Birthday Celebrant:</label>
                    <input type="text" name="name" id="name" style="border: 2px solid black; height: 20px; width: 300px; border-radius: 5px;"><br><br>
                    <label style="font-size: 17px;">Email:</label>
                    <input type="text" name="email" id="email" value="<?php echo $_SESSION['email']; ?>" style="border: 2px solid black; height: 20px; width: 300px; border-radius: 5px; margin-left: 97px;"><br><br>
                    <label style="font-size: 17px;">Contact:</label>
                    <input type="text" name="contact" id="contact"  style="border: 2px solid black; height: 20px; width: 300px; border-radius: 5px; margin-left: 97px;"><br><br>
                    <label style="font-size: 17px;">Gender:</label>
                    <select name="gender" id="gender" style="border: 2px solid black; height: 20px; width: 150px; border-radius: 5px; margin-left: 87px;">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select><br><br>
                    <label style="font-size: 17px;">Place of venue:</label>
                    <input type="text" id="venue" name="place" style="border: 2px solid black; height: 20px; width: 300px; border-radius: 5px; margin-left: 30px;"><br><br>
                    <label style="font-size: 17px;">Package:</label>
                    <input type="text" name="package" id="package" readonly value="<?php echo $packageID; ?>" style="border: 2px solid black; height: 20px; width: 30px; border-radius: 5px; margin-left: 75px; text-transform: uppercase;padding:3px;"><br><br>
                    <label style="font-size: 17px;">Package Inclusion:</label>
                    <p style="border: 2px solid black; border-radius: 5px;background-color:white; margin-left: 180px; width:40%; text-align:center;"><?php echo nl2br(htmlspecialchars($row['details'], ENT_QUOTES, 'UTF-8')) ?></p><br><br>

                    <label style="font-size: 17px;">Price:</label>
                    <input type="text" name="price" id="price" readonly  value="<?php echo number_format($row['price'], 2); ?>" style="border: 2px solid black; height: 20px; width: 70px; border-radius: 5px; margin-left: 101px;"><br><br>
                    <label style="font-size: 17px;">Date:</label>
                    <input type="date" name="reservation_date" id="reservation_date" style="border: 2px solid black; height: 20px; width: 100px; border-radius: 5px; margin-left: 101px;">
                    <br><br>
                    <label for="Time" class="label9">Time of the party:</label>
                    <input type="time" id="time" name="time" style="border: 2px solid black; height: 20px; width: 150px; border-radius: 5px; margin-left: 17px;"><br><br>
                    <label style="font-size: 17px;">Special Request <span style="color: red;">*</span></label>
                    <input type="text" name="request" id="request" style="border: 2px solid black; height: 20px; width: 300px; border-radius: 5px; margin-left: 10px;"><br><br>
                    <label style="font-size: 17px;">Payment Method <span style="color: red;">*</span></label>
                    <select name="pay" id="pay" style="border: 2px solid black; height: 20px; width: 150px; border-radius: 5px; margin-left: 87px;">
                        <option value="Walk in">Walk in</option>
                        <option value="Gcash">Gcash</option>
                    </select><br><br>
                    <label style="font-size: 17px;">Gcash Reference Number: </label>
                    <input type="text" name="ref" id="request" placeholder="If gcash has been choose GCASH: 09837217823" style="border: 2px solid black; height: 20px; width: 300px; border-radius: 5px; margin-left: 10px;"><br><br>
                    <input type="submit" value="Reserve" name="submit" class="submit">
                    <input type="submit" value="Back to Services" name="back" class="submit">
                </form>
            </div><?php };?>
        </div>
</body>
</html>