<?php

use Illuminate\Support\Facades\Route;

function set_active($uri, $output = 'active')
{
    if (is_array($uri)) {
        foreach ($uri as $val) {
            if (Route::is($val)) {
                return $output;
            }
        }
    } else {
        if (Route::is($uri)) {
            return $output;
        }
    }
}

if (!function_exists('app_lang')) {
    function app_lang($en, $km)
    {
        $lang = request()->language;
        return $lang == 'en' ? $en ?? '' : $km ?? '';
    }
}

if (!function_exists('app_date')) {
    function app_date($date)
    {
        $date = new DateTime($date);
        return $date->format('Y-m-d');
    }
}