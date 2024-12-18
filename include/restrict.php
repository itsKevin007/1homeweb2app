<?php
$current_url = $_SERVER['REQUEST_URI'];
$current_url_path = parse_url($current_url, PHP_URL_PATH);
$url_parts = explode('/', trim($current_url_path, '/'));
$dirname = isset($url_parts[1]) ? $url_parts[1] : ''; // Adjust the index based on your URL structure

$web_root = WEB_ROOT; // Ensure WEB_ROOT is defined


function redirectToWebRoot($current_url_path, $web_root) {
    if ($current_url_path != $web_root) {
        header("Location: $web_root");
        exit; // Ensure script stops executing after redirection
    }
}

switch ($dirname) {
    case 'service-provider':
        if ($accesslevel == 0) {
            redirectToWebRoot($current_url_path, $web_root);
        }
        break;
    case 'client':
        if ($accesslevel == 1) {
            redirectToWebRoot($current_url_path, $web_root);
        }
        break;
    default:
        // The URL is not under a specific folder
        // Add your code here if needed
        break;
}

?>