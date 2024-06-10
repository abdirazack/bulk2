<?php

use Carbon\Carbon;

if (!function_exists('formatDate')) {
    function formatDate($format, $date)
    {
        return Carbon::parse($date)->format($format);
    }
}
