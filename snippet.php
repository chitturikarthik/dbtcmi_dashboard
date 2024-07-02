<?php 
include 'conn.php';

$pages = ["index.php", "collections.php", "pipelines.php", "services.php", "research.php", "events.php", "team.php", "contact.php"];

$visitor_ip = $_SERVER["REMOTE_ADDR"];
$PageName = basename($_SERVER["PHP_SELF"]);  
$today = date("Y-m-d");

// Check if there's a visit entry for today
$check_query = "SELECT * FROM `page_visits` WHERE `visitor_ip` = '$visitor_ip' AND DATE(`visited_on`) = '$today'";
$check_result = mysqli_query($conn, $check_query);

if ($check_result === false) {
    echo "Error in SELECT query: " . mysqli_error($conn);
    exit;
}

if (mysqli_num_rows($check_result) > 0) {
    // If a record exists for today, update the visit count for the current page
    $row = mysqli_fetch_assoc($check_result);
    $visit_count = $row[$PageName];
    if ($visit_count == 0) {
        $update_query = "UPDATE `page_visits` SET `$PageName` = 1 WHERE `visitor_ip` = '$visitor_ip'";
        if (mysqli_query($conn, $update_query)) {
            // echo "Page visit count updated for: $PageName";
        } else {
            echo "Error updating page visit count: " . mysqli_error($conn);
        }
    } else {
        // echo "Page already visited today: $PageName";
    }
} else {
    // If no record exists for today, insert a new record with visit count for the current page
    $ip_info = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $visitor_ip));
    $country = $ip_info->geoplugin_countryName;
    $city = $ip_info->geoplugin_city;
    $region = $ip_info->geoplugin_region;
    $latitude = $ip_info->geoplugin_latitude;
    $longitude = $ip_info->geoplugin_longitude;
    $timezone = $ip_info->geoplugin_timezone;
    $continent = $ip_info->geoplugin_continentName;

    $insert_query = "INSERT INTO `page_visits` (`visited_on`, `visitor_ip`, `$PageName`, `city`, `region`, `country`, `continent`, `longitude`, `latitude`, `timezone`) VALUES ('$today', '$visitor_ip', 1, '$city', '$region', '$country', '$continent', '$longitude', '$latitude', '$timezone')";

    if (mysqli_query($conn, $insert_query)) {
        // echo "New record inserted for: $PageName";
    } else {
        echo "Error inserting new record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
