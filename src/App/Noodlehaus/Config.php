<?php

namespace App\Noodlehaus;

class Config extends \Noodlehaus\Config
{
    public function get($key, $default = null)
    {
        $val = parent::get($key, $default);
        if (preg_match_all('#%(?<key>.+?)%#', $val, $match)) {
            foreach ($match['key'] as $key) {
                $val = str_replace("%{$key}%", $this->get($key), $val);
            }
        }
        return $val;
    }
}