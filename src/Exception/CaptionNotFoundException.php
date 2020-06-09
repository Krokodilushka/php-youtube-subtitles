<?php

namespace YoutubeSubtitles\Exception;

use Throwable;

class CaptionNotFoundException extends Exception
{
    public function __construct(string $langCode)
    {
        parent::__construct('Caption by languageCode ' . $langCode . ' not found');
    }
}