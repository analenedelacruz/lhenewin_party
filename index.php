
<html>
    <head>
        <title>Lherwin Party</title>
        <link href="./sign-in.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script>
        function togglePasswordVisibility(fieldId, eyeId) {
            var field = document.getElementById(fieldId);
            var eye = document.getElementById(eyeId);

            if (field.type === "password") {
                field.type = "text";
                eye.className = "fas fa-eye-slash eye-icon";
            } else {
                field.type = "password";
                eye.className = "fas fa-eye eye-icon";
            }
        }
    </script>
    </head>
    <body>
        <a href="index.php">
            <img src="logo.png" style="width: 150px;margin:0 auto;display:block;margin-bottom: 20px;">
        </a>
        
        <div class="content">
            <form action="log_sign_in.php" method="POST">
                <input type="text" placeholder="E-mail Address" name="email">
                <input type="password" placeholder="Password" name="pass">
                <input type="submit" value="Login" class="blue" name="log">
            </form>
            <a href="sign-up.php"><button class="blue">Create a New Account</button></a>
            <hr>
            <a href="forgot.php"><button class="red">Forgot Password</button></a>
        </div>
    </body>
</html>