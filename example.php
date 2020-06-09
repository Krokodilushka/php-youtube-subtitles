<?php

use YoutubeSubtitles\YoutubeSubtitles;

require_once 'vendor/autoload.php';

$html = file_get_contents('https://www.youtube.com/watch?v=IlU-zDU6aQ0');
//$html = file_get_contents('video_page.html');
$youtubeSubtitles = new YoutubeSubtitles($html);
$availableLanguages = $youtubeSubtitles->listAvailableLanguages();
print_r($availableLanguages);

// en
$subsUrl = $youtubeSubtitles->getUrl($availableLanguages[0]['code']);
echo '$subsUrl1: ' . $subsUrl . "\n";