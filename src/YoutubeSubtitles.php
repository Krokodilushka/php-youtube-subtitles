<?php

namespace YoutubeSubtitles;

use YoutubeSubtitles\Exception\CaptionNotFoundException;

class YoutubeSubtitles
{
    /** @var \stdClass */
    private $captions;

    public function __construct(string $html)
    {
        preg_match('/ytplayer\.config\s*=\s*(\{.*\})\;\s*ytplayer/', $html, $m);
        $config = json_decode($m[1]);
        $player_response = json_decode($config->args->player_response);
        if (!isset($player_response->captions)) {
            throw new Exception\CaptionsNotFoundException();
        }
        $this->captions = $player_response->captions->playerCaptionsTracklistRenderer->captionTracks;
    }

    public function listAvailableLanguages(): array
    {
        $res = [];
        if (!empty($this->captions)) {
            foreach ($this->captions as $caption) {
                $res[] = [
                    'code' => $caption->languageCode,
                    'name' => $caption->name->simpleText
                ];
            }
        }
        return $res;
    }

    public function getUrl(string $languageCode): string
    {
        if (!empty($this->captions)) {
            foreach ($this->captions as $caption) {
                if ($languageCode != $caption->languageCode) {
                    continue;
                }
                return $caption->baseUrl;
            }
        }
        throw new Exception\CaptionNotFoundException($languageCode);
    }
}