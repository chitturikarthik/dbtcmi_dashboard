<?php
// log_visitor.php

// Get the visitor's IP address
$visitor_ip = $_SERVER['REMOTE_ADDR'];

// Get the current page URL
$current_page = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Define the log file path
$log_file = 'visitor_log.txt';

// Prepare the log entry
$log_entry = date("Y-m-d H:i:s") . " - IP: " . $visitor_ip . " - Page: " . $current_page . PHP_EOL;

// Append the log entry to the file
file_put_contents($log_file, $log_entry, FILE_APPEND);
?>
