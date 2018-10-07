<?php

namespace App\Helpers;

class PackageHelper
{
    public static function getConfig($path)
    {
        $pathParts = explode('.',$path);
        $config = include base_path('packages/mwteam/'. $pathParts[0].'/src/config.php');

        for ($i=1; $i < count($pathParts); $i++){
            if (isset($config[$pathParts[$i]])){
                $config = $config[$pathParts[$i]];
            }else{
                return null;
            }
        }

        return $config;
    }
}