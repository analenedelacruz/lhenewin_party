<html>
    <head>
        <title>Make Reservation</title>
        <link href="./style.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <h1 style="font-family: 'Impact';text-align:center;">Payment</h1>
        <div class="content">
            <form id="register" method="post">
                <label>Name:</label>
                <input type="text" name="name" id="name"><br><br>
                <label>Email:</label>
                <input type="text" name="email" id="email"><br><br>
                <label>Mobile Number:</label>
                <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"><br><br>
                <label>Mode of Payment:</label>
                <input type="text" id="gender"><br><br>
            </form>
                 <a href="payment details.php">    
                    <input type="submit" value="Proceed" name="submit" id="submit">
                </a>
                <a href="reservation.php">    
                    <input type="submit" value="Back" name="submit" id="submit">
                </a>
    </body>

</html>