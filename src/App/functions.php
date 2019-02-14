<?php

if (!function_exists('app')) {
    /**
     * @param $name
     *
     * @return mixed
     */
    function app($name)
    {
        return \App\Context::getContainer()->get($name);
    }
}