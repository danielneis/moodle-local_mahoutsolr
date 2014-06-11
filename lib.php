<?php

namespace local_mahoutsolr;

class MahoutClient {

    public function isSpam($text) {
        $config = get_config('local_mahoutsolr');
        $curl = new curl();
        $result = $curl->post($config->mahouthost.':'.$config->mahoutport, array('text' => $text));
        if ($result_decoded = json_decode($result))  {
            return $result_decoded['cat'] == 'spam';
        }
        return false; // if we cant differ, it is not spam
    }
}
