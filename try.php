<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Reservation Calendar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
            background-color: #ffcccc; 
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
    <div class="container">
        <h2>Reservation Calendar</h2>
        <div>
            <button id="prevMonth" class="submit">Previous Month</button>
            <span id="monthName"></span>
            <button id="nextMonth" class="submit">Next Month</button>
        </div>
        <div id="calendar"></div>
    </div>



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
