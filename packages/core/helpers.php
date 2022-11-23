<?php



if (!function_exists('setting_helper')) {
    /**
     * @param $vars
     * @return string
     */
    function setting_helper($name, $field)
    {
        $setting = \Core\Models\Setting::where('name', $name)->first();
        if ($setting && isset($setting->values[$field])) {
            return $setting->values[$field];
        }
        return "";
    }
}

if (!function_exists('media_helper')) {
    /**
     * @param $vars
     * @return string
     */
    function media_helper($id)
    {
        $media = \Core\Models\Media::withOutGlobalScopes()->find($id);
        if($media){
            return $media->path;
        }
        return '';

    }
}

if (!function_exists('file_size_helper')) {
    function file_size_helper($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }
        return $bytes;
    }
}

if(!function_exists('get_server_memory_usage')){
    function get_server_memory_usage()
    {
        $usage = memory_get_usage();
        return file_size_helper($usage);
    }
}

if(!function_exists('get_server_cpu_usage')){
    function get_server_cpu_usage()
    {
        $os = PHP_OS;
        if($os === "WINNT"){
            return 0;
        }
        $exec_loads = sys_getloadavg();
        if(isset($exec_loads[0])){
            return round($exec_loads[0],2);
        }
        return 'N/A';
    }
}

if(!function_exists('get_disk_free_space')){
    function get_disk_free_space()
    {
        $df = diskfreespace('/');
        return file_size_helper($df);
    }
}

if (!function_exists('language_helper')) {
    function language_helper()
    {
        return ['नेपाली' => 'np','English' => 'en'];
    }
}

if (!function_exists('language_name_helper')) {
    function language_name_helper($key)
    {
        $langs =  [
            'en' => 'English',
            'np' => 'नेपाली'
        ];
        return $langs[$key];
    }
}

if(!function_exists('nepali_number')){
    function nepali_number($string)
    {
        $numbers = [
            '1' => '१',
            '2' => '२',
            '3' => '३',
            '4' => '४',
            '5' => '५',
            '6' => '६',
            '7' => '७',
            '8' => '८',
            '9' => '९',
            '0' => '०',
        ];

        $characters = str_split($string);
        foreach($characters as $key => $character){
            if(isset($numbers[$character])){
                $characters[$key] = $numbers[$character];
            }
        }
        return implode('',$characters);
    }
}

if(!function_exists('nepali_number_span')){
    function nepali_number_span($string)
    {
        return "<span style='font-family: sans-serif'>" . nepali_number($string) . "</span>";
    }
}

if (! function_exists('__')) {
    /**
     * Translate the given message.
     *
     * @param string|null $key
     * @param array $replace
     * @param string|null $locale
     * @return string|array|null
     */
    function __(string $key = null, array $replace = [], string $locale = null)
    {
        if (is_null($key)) {
            return $key;
        }
        return trans($key, $replace, $locale);
    }
}

if (!function_exists('randomPassword')) {
    function randomPassword($length = 8)
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}

if (!function_exists('getCurrentNepaliYear')) {
    function getCurrentNepaliYear()
    {
        $eng_date = explode('-',now()->format('Y-m-d'));
        $helper = new \Core\Helpers\DateHelper();
        $nepali_date = $helper->get_nepali_date($eng_date);
        return $nepali_date['y'];
    }
}

if(!function_exists('getLocaleChangerName')){
    function getLocaleChangerName()
    {
        $locale = app('translator')->getLocale();
        if($locale === 'en'){
            return 'np';
        }
        return 'en';
    }
}

if (!function_exists('nepNow')) {
    function nepNow()
    {
        $eng_date = explode('-',now()->format('Y-m-d'));
        $helper = new \Core\Helpers\DateHelper();
        $nepali_date = $helper->get_nepali_date($eng_date);
        return nepali_number("{$nepali_date['y']}-{$nepali_date['m']}-{$nepali_date['d']}");
    }
}

if(!function_exists('numberToWords')){
    function numberToWords(float $number)
    {
        $lang = app('translator')->getLocale();
        return \NumberToWords::get($number,[
           'lang' => $lang
        ]);
    }
}
