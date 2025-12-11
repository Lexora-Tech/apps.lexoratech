<?php
// Disable time limit for long operations
set_time_limit(0);

// Standard CORS and Request Checks
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit("Method Not Allowed");
}

$input = json_decode(file_get_contents('php://input'), true);
$text = isset($input['text']) ? trim($input['text']) : '';

if (empty($text)) {
    http_response_code(400);
    exit("No text provided");
}

$lang = 'en';
$chunkSize = 100; // Keep chunks small for Google API stability

// --- HELPER: SPLIT TEXT ---
function splitTextIntoChunks($text, $maxLength)
{
    $chunks = [];
    $sentences = preg_split('/([.?!]+)/', $text, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    $currentChunk = "";

    foreach ($sentences as $part) {
        if (strlen($currentChunk . $part) > $maxLength) {
            if (!empty($currentChunk)) $chunks[] = trim($currentChunk);
            if (strlen($part) > $maxLength) {
                // Force split long words/sentences
                $words = explode(' ', $part);
                $temp = "";
                foreach ($words as $word) {
                    if (strlen($temp . " " . $word) > $maxLength) {
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
    if (!empty($currentChunk)) $chunks[] = trim($currentChunk);
    return $chunks;
}

// 1. Prepare Chunks
$chunks = splitTextIntoChunks($text, $chunkSize);

// 2. PARALLEL DOWNLOAD (The Speed Fix)
// We use cURL Multi to fetch all audio segments at the same time
$mh = curl_multi_init();
$curl_handles = [];

// User Agent to look like a real browser
$userAgent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36";

foreach ($chunks as $i => $chunk) {
    if (empty($chunk)) continue;

    $encoded = urlencode($chunk);
    $url = "https://translate.google.com/translate_tts?ie=UTF-8&client=tw-ob&tl={$lang}&q={$encoded}";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    // Add to multi-handler
    curl_multi_add_handle($mh, $ch);

    // Store handle with index to maintain order later
    $curl_handles[$i] = $ch;
}

// 3. Execute all requests simultaneously
$running = null;
do {
    curl_multi_exec($mh, $running);
    curl_multi_select($mh); // Wait for activity
} while ($running > 0);

// 4. Collect and Assemble Audio in correct order
$combinedAudioData = "";

foreach ($curl_handles as $i => $ch) {
    // Get the content
    $content = curl_multi_getcontent($ch);

    if ($content) {
        $combinedAudioData .= $content;
    }

    // Clean up
    curl_multi_remove_handle($mh, $ch);
    curl_close($ch);
}

curl_multi_close($mh);

// 5. Output Final File
if (strlen($combinedAudioData) > 0) {
    header('Content-Type: audio/mpeg');
    header('Content-Disposition: attachment; filename="lexora-voicegen.mp3"');
    header('Content-Length: ' . strlen($combinedAudioData));
    echo $combinedAudioData;
} else {
    http_response_code(500);
    echo "Failed to generate audio.";
}
