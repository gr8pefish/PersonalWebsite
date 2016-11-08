<?php
include 'db_connection.php';
$query = "SELECT * FROM useractivity";
$result = mysql_query($query, $conn);

if (!$result) die("Couldn't get records");
$headers = $result->fetch_fields();
foreach($headers as $header) {
    $head[] = $header->name;
}
$fp = fopen('php://output', 'w');

if ($fp && $result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="export.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($fp, array_values($head));
    while ($row = $result->fetch_array(MYSQL_NUM)) {
        fputcsv($fp, array_values($row));
    }
    die;
}
?>