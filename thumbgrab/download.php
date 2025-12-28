<?php
// thumbgrab/download.php

// 1. Optimize Server Settings for Speed
set_time_limit(0);
ini_set('memory_limit', '256M'); // Ensure enough memory for high-res PNG conversion

// Disable output buffering for immediate streaming
if (function_exists('apache_setenv')) {
    @apache_setenv('no-gzip', 1);
}
@ini_set('zlib.output_compression', 0);
@ini_set('implicit_flush', 1);
for ($i = 0; $i < ob_get_level(); $i++) { ob_end_flush(); }
ob_implicit_flush(1);

if (isset($_GET['url'])) {
    $url = $_GET['url'];
    
    // Sanitize filename
    $name = isset($_GET['name']) ? preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET['name']) : 'thumbnail';
    $format = isset($_GET['format']) && $_GET['format'] === 'png' ? 'png' : 'jpg';
    $filename = "Lexora_" . $name . "." . $format;

    // SECURITY: Strictly Validate Domain
    $allowed_domains = ['img.youtube.com', 'i.ytimg.com', 'i1.ytimg.com', 'i2.ytimg.com', 'i3.ytimg.com', 'i4.ytimg.com'];
    $parsed_url = parse_url($url);
    
    if (isset($parsed_url['host']) && in_array($parsed_url['host'], $allowed_domains)) {
        
        // Define Context (Fake Browser to avoid throttle)
        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n" .
                            "Accept: image/webp,image/apng,image/*,*/*;q=0.8\r\n" . 
                            "Connection: close\r\n"
            ]
        ]);

        // --- PATH A: FAST STREAMING (JPG) ---
        // If the user wants the original JPG, we stream it directly. Fast & Low Memory.
        if ($format === 'jpg') {
            $fp = @fopen($url, 'rb', false, $context);
            
            if ($fp) {
                // Get headers from remote
                $meta = stream_get_meta_data($fp);
                $size = -1;
                foreach ($meta['wrapper_data'] as $header) {
                    if (stripos($header, 'Content-Length:') === 0) {
                        $size = (int)substr($header, 16);
                    }
                }

                // Send Headers
                header('Content-Description: File Transfer');
                header('Content-Type: image/jpeg');
                header('Content-Disposition: attachment; filename="' . $filename . '"');
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                
                if ($size > 0) {
                    header('Content-Length: ' . $size);
                }

                // STREAM IT (The Speed Fix)
                fpassthru($fp);
                fclose($fp);
                exit;
            }
        }

        // --- PATH B: CONVERSION (PNG) ---
        // Requires loading image, so slightly slower but optimized settings used.
        if ($format === 'png') {
            $image_content = @file_get_contents($url, false, $context);
            
            if ($image_content) {
                $source = @imagecreatefromstring($image_content);
                
                if ($source) {
                    header('Content-Description: File Transfer');
                    header('Content-Type: image/png');
                    header('Content-Disposition: attachment; filename="' . $filename . '"');
                    header('Cache-Control: max-age=0');

                    // Output PNG (Compression 6 is a good balance of speed/size)
                    imagepng($source, null, 6);
                    imagedestroy($source);
                    exit;
                }
            }
        }
    }
}

// Fallback Error
http_response_code(404);
echo "Error: Invalid URL or Resource Unavailable.";
?>
