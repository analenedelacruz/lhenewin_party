<?php

$conn = mysqli_connect("localhost","root","","website");
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$sql3 = "SELECT COUNT(id) AS id FROM reserve";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$reserve = $row3['id'];

?>

<html>
    <head>
        <title>Lherwin Party</title>
        <link href="admin2.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://kit.fontawesome.com/480d0c770a.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <style>

        .dropdown {
            color: white;
            padding: 35% 10px;
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
        <br><br>
        
        <div class="container">
        <center><h1 style="font-size: 25px; text-align: center;">Event Calendar</h1><br>
        <p><span style="color:black; font-size:20px;">▭</span> No Reservation      <span style="color:#5cd656;">▉</span> Not Fully Reserved       <span style="color:red;">▉</span> Fully Reserved/Not Available</p></center>
        <div>
            <button id="prevMonth" class="submit">Previous Month</button>
            <span id="monthName"></span>
            <button id="nextMonth" class="submit">Next Month</button>
        </div><br>
        <div id="calendar"></div>
    </div>
        <br><br>

        <?php 
        $select = "select * from reserve WHERE status = 'reserved' ORDER BY reservation_date ASC";
        $selectresult = mysqli_query($conn,$select);
        
            
        ?>
        <center><h1 style="font-size: 25px; text-align: center;">Reserved Events</h1></center>
        <br>
        <div style="display: flex; justify-content: center;">
            <div>
            <table style="height: auto; width: 1000px; border-collapse: collapse; border: 1px solid black;">
                    <tr style="background: lightblue;">
                        <th style="color: black; border-right: 1px solid aliceblue;padding:10px;">Events</th>
                        <th style="color: black; border-right: 1px solid aliceblue;padding:10px;">Package</th>
                        <th style="color: black; border-right: 1px solid aliceblue;padding:10px;">Price</th>
                        <th style="color: black; border-right: 1px solid aliceblue;padding:10px;">Reservation Date</th>
                        <th style="color: black; border-right: 1px solid aliceblue;padding:10px;">Time</th>
                    </tr>

                    <tr>
                    <?php
                        while($row2 = mysqli_fetch_assoc($selectresult))
                        {
                         ?>
                        <td style="background: aliceblue;padding:5px; text-align:center; border-right: 1px solid gray; border-bottom: 1px solid gray;"><?php echo $row2['BirthdayCelebrant']; ?></td>
                        <td style="background: aliceblue;padding:5px; text-align:center; border-right: 1px solid gray; border-bottom: 1px solid gray;"><?php echo $row2['Package']; ?></td>
                        <td style="background: aliceblue;padding:5px; text-align:center; border-right: 1px solid gray; border-bottom: 1px solid gray;"><?php echo $row2['Price']; ?></td>
                        <td style="background: aliceblue;padding:5px; text-align:center; border-right: 1px solid gray; border-bottom: 1px solid gray;"><?php echo date('F j, Y', strtotime($row2['reservation_date'])); ?></td>
                        
                        <td style="background: aliceblue;padding:5px; text-align:center; border-right: 1px solid gray; border-bottom: 1px solid gray;"><?php echo $row2['Time']; ?></td>
                        
                    </tr>
                    <?php
                        }

                        ?>
                </table>
            </div>
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

            
            calendar.addEventListener('mouseover', function (event) {
                const target = event.target;
                if (target.classList.contains('reserved')) {
                    const tooltip = document.createElement('div');
                    tooltip.classList.add('tooltip');
                    const tooltipContent = target.getAttribute('data-tooltip');
                    tooltip.innerHTML = tooltipContent.replace(/\n/g, '<br>');
                    document.body.appendChild(tooltip);

                    const rect = target.getBoundingClientRect();
                    tooltip.style.top = rect.top + window.scrollY - tooltip.offsetHeight + 'px';
                    tooltip.style.left = rect.left + window.scrollX + 'px';
                }
            });

        
            calendar.addEventListener('mouseout', function (event) {
                const target = event.target;
                if (target.classList.contains('reserved')) {
                    const tooltip = document.querySelector('.tooltip');
                    if (tooltip) {
                        tooltip.remove();
                    }
                }
            });
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