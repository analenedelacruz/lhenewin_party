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


$query = "SELECT * FROM reserve WHERE Email = '$email' and status = 'reserved' ORDER BY reservation_date";
$result = mysqli_query($conn,$query);

$currentMonth = date('n');
?>

<html>
    <head>
        <title>Lherwin Party</title>
        <link href="./style.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


        <style>
        .container {
            max-width: 800px;
            margin: 50px auto;
            text-align: center;
        }

        #calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }

        .day {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .reserved {
            background-color: #5cd656; 
        }

        #monthName {
            font-size: 20px;
            margin-top: 10px;
        }
        .tooltip {
            position: absolute;
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 5px;
            z-index: 1000;
        }
        </style>
    </head>
    <body>
        <div class="header">
            <a href="main.php">
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

        <br><br><h1 style="font-size: 25px; text-align: center;">UPCOMING EVENTS</h1><br><br>

        <div style="display: flex; justify-content: center;">
            <div>
                <table style="height: auto; width: 900px; border-collapse: collapse; ">
                    <?php

                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    

                    <tr style="width:100%; border:solid 1px black;">
                        <td style="background: lightblue; text-align: start; padding: 10px 50px; width:30%;" ><b> Package: <span style="text-transform: uppercase;"><?php echo $row['Package']; ?></span> </b><br> <b>Package Inclusion: </b><br><p style="margin-left:50px;"><?php
                        
                        $query3 = "SELECT * FROM tbl_services where packageCode = '" . $row['Package'] . "'";
                        $result3 = mysqli_query($conn,$query3);
                        while ($row2 = mysqli_fetch_assoc($result3)) {
                        
                        echo nl2br(htmlspecialchars($row2['details'], ENT_QUOTES, 'UTF-8')); } ?></p></td>

                        <td style="background: aliceblue; text-align: center; padding:10px; width:50%;vertical-align: text-top;"><?php echo $row['Place']; ?><br><?php echo date('F j, Y', strtotime($row['reservation_date'])); ?> <br> <?php echo date('h:i A', strtotime($row['Time'])); ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
        </div>

        <br><br>
        <div class="container">
        <center><h1 style="font-size: 25px; text-align: center;">Lhenewin Event Calendar</h1>
        <h3>Check our Date Availability</h3>
        <p><span style="color:black; font-size:20px;">▭</span> Available      <span style="color:#5cd656;">▉</span> Not Fully Reserved       <span style="color:red;">▉</span> Fully Reserved/Not Available</p></center>
        <div>
            <button id="prevMonth" class="submit">Previous Month</button>
            <b><span id="monthName"></span></b>
            <button id="nextMonth" class="submit">Next Month</button>
        </div><br>
        <div id="calendar"></div>
    </div>
        <br><br><br><br>
        



         
    <script>
   document.addEventListener('DOMContentLoaded', function() {
    const currentDate = new Date();
    let currentYear = currentDate.getFullYear();
    let currentMonth = currentDate.getMonth() + 1; 

    displayCalendar(currentYear, currentMonth);

    document.getElementById('prevMonth').addEventListener('click', function() {
        if (currentMonth === 1) {
            currentYear--;
            currentMonth = 12;
        } else {
            currentMonth--;
        }
        displayCalendar(currentYear, currentMonth);
    });

    document.getElementById('nextMonth').addEventListener('click', function() {
        if (currentMonth === 12) {
            currentYear++;
            currentMonth = 1;
        } else {
            currentMonth++;
        }
        displayCalendar(currentYear, currentMonth);
    });

    // Check if it's the initial month, and show/hide the "Previous Month" button accordingly
    <?php
        $initialMonth = date('n');
        echo "if (currentMonth === $initialMonth) { document.getElementById('prevMonth').style.display = 'none'; } else { document.getElementById('prevMonth').style.display = 'block'; }";
    ?>
});

function displayCalendar(year, month) {
    fetch(`try2.php?year=${year}&month=${month}`)
        .then(response => response.json())
        .then(reservedDates => {
            initializeCalendar(year, month, reservedDates);
            updateMonthName(year, month);
        })
        .catch(error => console.error('Error fetching reserved dates:', error));
}

function initializeCalendar(year, month, reservedDetails) {
    const calendar = document.getElementById('calendar');
    calendar.innerHTML = '';  

    const daysInMonth = new Date(year, month, 0).getDate();

    for (let i = 1; i <= daysInMonth; i++) {
        const day = document.createElement('div');
        day.classList.add('day');
        day.textContent = i;

        const dateString = `${year}-${month.toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`;
        if (reservedDetails[dateString]) {
            const reservationInfo = reservedDetails[dateString];
            day.classList.add('reserved');
            day.setAttribute('data-tooltip', `Reservations: ${reservationInfo.total_reservations}\nClowns: ${reservationInfo.total_clowns}\nFace Painters: ${reservationInfo.total_facepainters}`);
            
            if (reservationInfo.total_clowns == 5 || reservationInfo.total_facepainters == 5) {
                day.style.backgroundColor = 'red'; 
                day.style.color = 'white'; 
            }
        }

        calendar.appendChild(day);
    }
}

function updateMonthName(year, month) {
    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    const monthNameElement = document.getElementById('monthName');
    monthNameElement.textContent = `${monthNames[month - 1]} ${year}`;
}


    </script>

    </body>
</html>