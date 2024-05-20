<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 style="text-align: center; font-size: 25px;">Forgot Password</h1>
    <br>
    <div style="display: flex; justify-content: center;">
        <div>
            <form action="update.php" method="POST">
                <label for="" style="font-size: 17px;">Email <span style="color: red;">*</span></label><br>
                <input type="text" placeholder="Enter your email address" name="email" class="input" required><br>
                <label for="" style="font-size: 17px;">Password <span style="color: red;">*</span></label><br>
                <input type="text" placeholder="Enter your password" name="pass" class="input" required><br>
                <label for="" style="font-size: 17px;">Confirm Password <span style="color: red;">*</span></label><br>
                <input type="text" placeholder="Re-enter your password" name="confirmpass" class="input" required><br>
                <center><input type="submit" value="Submit" name="submit" class="submit"></center>
            </form>
        </div>
    </div>
</body>
</html>