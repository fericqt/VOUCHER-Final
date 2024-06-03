<?php
// Include database connection
include_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $query = "SELECT tracking_no FROM details ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($db_connection, $query);
    $latestDate = null;

    //

    $currentYearMonth = date("Y-m");
    $newYearMonth = $currentYearMonth;
    $newCount = 1;

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $latestDate = $row["tracking_no"];

        if ($latestDate) {
            $currentCount = explode('-', $latestDate);
            $ccount = end($currentCount);

            $latestYearMonth = substr($latestDate, 0, 7);

            if ($latestYearMonth === $currentYearMonth) {
                $newCount = $ccount + 1;
            }
        }

        $newEntryDate = sprintf("%s-%02d", $newYearMonth, $newCount);

        echo json_encode($newEntryDate);
    } else {

        echo json_encode($currentYearMonth . "-1");
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
