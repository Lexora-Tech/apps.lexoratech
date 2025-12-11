<?php
// voicegen/download.php

// 1. Setup & Configuration
set_time_limit(0);
header('Content-Type: application/json');

// Handle CORS (if hosting on different domains)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    exit(0);
}
header("Access-Control-Allow-Origin: *");

// 2. Validate Request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$text = isset($input['text']) ? trim($input['text']) : '';
$lang = isset($input['lang']) ? trim($input['lang']) : 'en';

if (empty($text)) {
    http_response_code(400);
    echo json_encode(['error' => 'No text provided']);
    exit;
}

// 3. Smart Splitting (Unicode Safe)
// Prevents breaking Sinhala/Tamil characters in half
function safeSplitText($text, $maxLength) {
    $chunks = [];
    // Split by sentence endings (., ?, !, newline) and Indian/Sinhala danda (।)
    $sentences = preg_split('/([.?!।\n]+)/u', $text, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    
    $currentChunk = "";
    
    foreach ($sentences as $part) {
        // Use mb_strlen for multibyte support
        if (mb_strlen($currentChunk . $part, 'UTF-8') > $maxLength) {
            if (!empty($currentChunk)) {
                $chunks[] = trim($currentChunk);
            }
            // Handle extremely long sentences
            if (mb_strlen($part, 'UTF-8') > $maxLength) {
                $words = explode(' ', $part);
                $temp = "";
                foreach ($words as $word) {
                    if (mb_strlen($temp . " " . $word, 'UTF-8') > $maxLength) {
                        $chunks[] = trim($temp);
                        $temp = $word;
                    } else {
                        $temp .= " " . $word;
                    }
                }
                $currentChunk = $temp;
            } else {
                $currentChunk = $part;
            }
        } else {
            $currentChunk .= $part;
        }
    }
    
    if (!empty($currentChunk)) {
        $chunks[] = trim($currentChunk);
    }
    
    return $chunks;
}

$chunks = safeSplitText($text, 150); // 150 chars is safe for Google TTS

// 4. Parallel Download (cURL Multi)
$mh = curl_multi_init();
$curl_handles = [];
// Fake a real browser agent to avoid 403 errors
$userAgent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36";

foreach ($chunks as $i => $chunk) {
    if (empty($chunk)) continue;

    $encoded = urlencode($chunk);
    // ie=UTF-8 is crucial for non-English languages
    $url = "https://translate.google.com/translate_tts?ie=UTF-8&client=tw-ob&tl={$lang}&q={$encoded}";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    curl_multi_add_handle($mh, $ch);
    $curl_handles[$i] = $ch;
}

// Execute all requests simultaneously
$running = null;
do {
    curl_multi_exec($mh, $running);
    curl_multi_select($mh);
} while ($running > 0);

// 5. Assemble Audio
ksort($curl_handles); // Ensure correct order
$combinedAudioData = "";

foreach ($curl_handles as $ch) {
    $content = curl_multi_getcontent($ch);
    if ($content) {
        $combinedAudioData .= $content;
    }
    curl_multi_remove_handle($mh, $ch);
    curl_close($ch);
}
curl_multi_close($mh);

// 6. Return File
if (strlen($combinedAudioData) > 50) {
    header('Content-Type: audio/mpeg');
    header('Content-Disposition: attachment; filename="voicegen_export.mp3"');
    header('Content-Length: ' . strlen($combinedAudioData));
    echo $combinedAudioData;
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to generate audio']);
}
?>
