<?php

namespace YoutubeSubtitles\Exception;

use Throwable;

class CaptionsNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Captions not found');
    }
}