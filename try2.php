<?php
$conn = mysqli_connect("localhost", "root", "", "website");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT reservation_date, COUNT(*) as total_reservations, SUM(clown) as total_clowns, SUM(facepainter) as total_facepainters 
          FROM tbl_services s
          JOIN reserve r ON s.packageCode = r.Package
          WHERE r.status IN ('reserved', 'settled')
          GROUP BY reservation_date";

$result = mysqli_query($conn, $query);

$reservedDetails = [];

while ($row = mysqli_fetch_assoc($result)) {
    $reservedDetails[$row['reservation_date']] = [
        'total_reservations' => $row['total_reservations'],
        'total_clowns' => $row['total_clowns'],
        'total_facepainters' => $row['total_facepainters']
    ];
}

echo json_encode($reservedDetails);
mysqli_close($conn);
?>
