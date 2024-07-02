<?php 
// Database configuration    
define('DB_HOST', 'localhost'); 
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', ''); 
define('DB_NAME', 'dbt_cmi'); 
 
// Google API configuration 
define('GOOGLE_CLIENT_ID', '71353600102-qettsod5a239mi6i49vovibpgrhq58pc.apps.googleusercontent.com'); 
define('GOOGLE_CLIENT_SECRET', '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'); 
define('GOOGLE_OAUTH_SCOPE', 'https://www.googleapis.com/auth/drive'); 
define('REDIRECT_URI', 'http://localhost/dbt_cmi/drive_upload/google_drive_sync.php'); 
 
// Start session 
if(!session_id()) session_start(); 
 
// Google OAuth URL 
$googleOauthURL = 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode(GOOGLE_OAUTH_SCOPE) . '&redirect_uri=' . REDIRECT_URI . '&response_type=code&client_id=' . GOOGLE_CLIENT_ID . '&access_type=online'; 
 
?>