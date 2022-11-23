<?php

namespace Core\Services;


class PackageService
{
    public static function register()
    {
        $results = [];
        $names = self::packages();

        foreach($names as $package => $name)
        {
            $providers  = array_map('basename', glob(base_path() . "/packages/$package/app/Providers/*.{php}", GLOB_BRACE));
            foreach($providers as $provider)
            {
                $provider = str_replace(".php","",$provider);
                $results[] = "$name\\Providers\\$provider";
            }
        }
        return $results;
    }

    public static function packages()
    {
        $names = [];
        $directories = glob(base_path() . "/packages/*");
        foreach ($directories as $directory) {
            $package = basename($directory);
            $name = self::clean($package);
            $names[$package] = $name;
        }
        return $names;
    }

    public static function clean($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }
}