
<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    $id = $_GET["id"];

    $conn = mysqli_connect("localhost","root","","website");
    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }

    $que = "INSERT INTO tbl_cancel (numberOfCancel) VALUES('$id')";
    $result = mysqli_query($conn, $que);

    $sql = "delete from reserve where id = '$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location:myReserve.php");
        exit;
        } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    
        mysqli_close($conn);
}
?>
<html>
    <head>
        <title>Lherwin Party</title>
        <link href="./sign-in.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
<html>