<?php
if (isset($_GET['url'])) {
    $url = $_GET['url'];
    // Validate that it is a YouTube image URL
    if (strpos($url, 'youtube.com') !== false || strpos($url, 'ytimg.com') !== false) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="thumbnail.jpg"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        readfile($url);
        exit;
    }
}
echo "Invalid Request";
?>
