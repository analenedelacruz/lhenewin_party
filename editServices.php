<?php
session_start();
 // Create connection
 $conn = mysqli_connect("localhost","root","","website");
 // Check connection
 if (!$conn) {
 die("Connection failed: " . mysqli_connect_error());
 }

 $editID = $_GET['edit'];

$query = "select * from tbl_services where packageCode = '$editID'";
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_assoc($result))
{
    $packageCode = $row['packageCode'];
    $poster = $row['poster'];
    $price = $row['price'];
    $clown = $row['clown'];
    $facepainter = $row['facepainter']; 
    $details = $row['details'];
}

if (isset($_POST['submit'])) {
    $packageCode = $_POST['packageCode'];
    $price = $_POST['price'];
    $clown = $_POST['clown'];
    $facepainter = $_POST['facepainter'];
    $details = $_POST['details'];
    $poster = $_FILES['poster']['name'];
    $poster_tmp_name = $_FILES['poster']['tmp_name'];
    $poster_folder = 'services/' . $poster;

    $stmt = mysqli_prepare($conn, "UPDATE tbl_services SET poster=?, price=?, clown=?, facepainter=?, details=? WHERE packageCode=?");
    mysqli_stmt_bind_param($stmt, "ssssss", $poster, $price, $clown, $facepainter, $details, $packageCode);
    $upload = mysqli_stmt_execute($stmt);

    if ($upload) {
        move_uploaded_file($poster_tmp_name, $poster_folder);
        header("Location: adminServices.php");
        exit();
    } else {
        echo '<script>alert("Oops! Something went wrong.");</script>';
    }

    mysqli_close($conn);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Services</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 style="font-family: 'Impact';text-align:center;">Edit Services</h1>
    
            <br><br><br><br><br>
        <div style="display: flex; justify-content: center;">
            <div style="border: 1px solid black; border-radius: 10px; padding: 30px 30px; background: aliceblue; box-shadow: 5px 10px 5px black;">
                <form action="" method="POST"  enctype="multipart/form-data">
                    <label style="font-size: 17px;">Package Code:</label>
                    <input type="text" value="<?php echo $packageCode ?>" name="packageCode" id="packageCode" required readonly style="border: 2px solid black; height: 20px; width: 320px; border-radius: 5px; padding:3px; text-transform: uppercase;"><br><br>

                    <label style="font-size: 17px;">Poster Image:</label>
                    <input type="file" name="poster" id="poster" value="<?php echo $poster ?>"  required accept="image/png, image/jpeg, image/jpg" style="border: 2px solid black; height: 20px; padding:3px; width: 320px; border-radius: 5px;margin-left: 10px;"><br><br>

                    <label style="font-size: 17px;">Price:</label>
                    <input type="text" name="price" id="price" value="<?php echo $price ?>" style="border: 2px solid black; height: 20px; width: 320px; border-radius: 5px; margin-left: 70px; padding:3px;"><br><br>
                    
                    <label style="font-size: 17px;">Clown:</label>
                    <input type="text" id="clown" name="clown" value="<?php echo $clown ?>"  required style="border: 2px solid black; height: 20px; width: 320px; border-radius: 5px; margin-left: 60px; padding:3px;"><br><br>

                    <label style="font-size: 17px;">Face Painter:</label>
                    <input type="text" name="facepainter" id="facepainter" required value="<?php echo $facepainter ?>" style="border: 2px solid black; height: 20px; width: 320px; border-radius: 5px; margin-left: 15px; padding:3px;"><br><br>

                    <label style="font-size: 17px;">Package Details:</label>
                    <textarea type="text" name="details" id="details" required value="<?php echo nl2br(htmlspecialchars($row['details'], ENT_QUOTES, 'UTF-8')) ?>" rows="4" style="border: 2px solid black; width: 320px; border-radius: 5px; margin-left: 15px; padding:3px;"></textarea><br><br>
                    
                    <input type="submit" value="Update Services" name="submit" class="submit">
                    <a href="adminServices.php" class="submit" style="text-decoration:none;">Back to Services</a>

                </form>
            </div>
        </div>
        <br><br><br><br><br>
        <br><br>

</body>
</html>