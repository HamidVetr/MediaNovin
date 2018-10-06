<?php

namespace App\Helpers;

class PackageHelper
{
    public static function getConfig($package)
    {
        $config = include base_path('packages/mwteam/'. $package.'/src/config.php');
        return $config;
    }
}