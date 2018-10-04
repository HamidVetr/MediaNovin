<?php

namespace App\Helpers;

use Carbon\Carbon;
use Morilog\Jalali\jDateTime;

class DatetimeHelper
{
    public static function toJalaliDate($date)
    {
        $dateParts = explode('-', (new Carbon($date))->toDateString());
        $persianDate = jDateTime::toJalali($dateParts[0], $dateParts[1], $dateParts[2]);
        return $persianDate[0] . '/' . $persianDate[1] . '/' . $persianDate[2];
    }

    public static function toGregorianDatetime($datetime)
    {
        try {
            $persianDatetime = explode(' ', $datetime);

            $persianYear = substr($persianDatetime[0], 0, 4);
            $persianMonth = substr($persianDatetime[0], 5, 2);
            $persianDay = substr($persianDatetime[0], 8, 2);

            $timeParts = explode(':', $persianDatetime[1]);
            $second = isset($timeParts[2]) ? $timeParts[2] : '00';
            $dateParts = jDateTime::toGregorian($persianYear, $persianMonth, $persianDay);

            return Carbon::createFromFormat('Y-m-d H:i:s', $dateParts[0] . '-' . $dateParts[1] . '-' . $dateParts[2] . ' '
                . $timeParts[0] . ':' . $timeParts[1] . ':' . $second);
        } catch (\Exception $e) {
            return null;
        }

    }

    public static function getJalaliYear()
    {
        $dateParts = explode('-', (Carbon::now())->toDateString());
        $persianDate = jDateTime::toJalali($dateParts[0], $dateParts[1], $dateParts[2]);
        return $persianDate[0];
    }

    public static function getJalaliMonth()
    {
        $dateParts = explode('-', (Carbon::now())->toDateString());
        $persianDate = jDateTime::toJalali($dateParts[0], $dateParts[1], $dateParts[2]);
        return in_array($persianDate[1], [10, 11, 12]) ? $persianDate[1] : '0' . $persianDate[1];
    }

    public static function getJalaliDay()
    {
        $dateParts = explode('-', (Carbon::now())->toDateString());
        $persianDate = jDateTime::toJalali($dateParts[0], $dateParts[1], $dateParts[2]);
        return $persianDate[2];
    }

    public static function toWithoutSecondsTime($datetime)
    {
        $time = (new Carbon($datetime))->toTimeString();
        return substr($time, 0, 5);
    }

    public static function checkJalaliDate($datetime)
    {
        $year = substr($datetime, 0, 4);
        $month = substr($datetime, 5, 2);
        $day = substr($datetime, 8, 2);
        $hour = substr($datetime, 11, 2);
        $minute = substr($datetime, 14, 2);
        $second = substr($datetime, 17, 2) != false ? substr($datetime, 17, 2) : '00';

        $isJalali = jDateTime::checkDate($year, $month, $day);
        $isTime = preg_match("/^([0-1][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/", $hour . ':' . $minute . ':' . $second);
        return $isJalali && $isTime ? true : false;
    }
}