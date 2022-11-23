<?php

namespace Core\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

/**
 * Class DateService
 * @package Core\Services
 */
class DateService
{
    /**
     * @var mixed|\Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application
     */
    protected mixed $calendarData;

    /**
     * @var int
     */
    private int $bsYear;
    /**
     * @var int
     */
    private int $bsMonth;
    /**
     * @var int|mixed|null
     */
    private mixed $bsDate;
    /**
     * @var array|mixed
     */
    private mixed $events = [];

    private array $colors = [];

    /**
     *
     */
    public function __construct()
    {
        $this->calendarData = config('core.nepali-date');
    }

    /**
     * @param int $bsYear
     * @return bool
     */
    public function validateBsYear(int $bsYear): bool
    {
        if(!$bsYear){
            throw new \TypeError("Invalid parameter bsYear value");
        }
        if($bsYear < $this->calendarData['minBsYear'] || $bsYear > $this->calendarData['maxBsYear']){
            throw new \RangeException("Parameter BsYear value range error");
        }
        return true;
    }

    /**
     * @param int $adYear
     * @return bool
     */
    public function validateAdYear(int $adYear): bool
    {
        if(!$adYear){
            throw new \TypeError("Invalid parameter adYear value");
        }
        if($adYear < ($this->calendarData['minBsYear'] - 57) || $adYear > $this->calendarData['maxBsYear'] - 57){
            throw new \RangeException("Parameter BsYear value range error");
        }
        return true;
    }

    /**
     * @param int $bsMonth
     * @return bool
     */
    public function validateBsMonth(int $bsMonth): bool
    {
        if(!$bsMonth){
            throw new \TypeError("Invalid parameter bsMonth value");
        }
        if($bsMonth < 1 || $bsMonth > 12){
            throw new \RangeException("Parameter bsMonth value should be in range 1 to 12");
        }
        return true;
    }

    /**
     * @param int $bsDate
     * @return bool
     */
    public function validateBsDate(int $bsDate): bool
    {
        if(!$bsDate){
            throw new \TypeError("Invalid parameter bsMonth value");
        }
        if($bsDate < 1 || $bsDate > 32){
            throw new \RangeException("Parameter bsMonth value should be in range 1 to 32");
        }
        return true;
    }

    /**
     * @param int $adMonth
     * @return bool
     */
    public function validateAdMonth(int $adMonth): bool
    {
        if(!$adMonth){
            throw new \TypeError("Invalid parameter bsMonth value");
        }
        if($adMonth < 1 || $adMonth > 12){
            throw new \RangeException("Parameter bsMonth value should be in range 1 to 12");
        }
        return true;
    }

    /**
     * @param int $adDate
     * @return bool
     */
    public function validateAdDate(int $adDate): bool
    {
        if(!$adDate){
            throw new \TypeError("Invalid parameter bsMonth value");
        }
        if($adDate < 1 || $adDate > 32){
            throw new \RangeException("Parameter bsMonth value should be in range 1 to 32");
        }
        return true;
    }

    /**
     * @param int $number
     * @return string
     */
    public function getNepaliNumber(int $number): string
    {
        if($number < 0){
            throw new \Error("Number must be positive number");
        }

        $characters = str_split($number);
        foreach($characters as $key => $character){
            if(isset($this->calendarData['nepaliNumbers'][$character])){
                $characters[$key] = $this->calendarData['nepaliNumbers'][$character];
            }
        }
        return implode('',$characters);
    }

    /**
     * @param $bsMonth
     * @param $yearDiff
     * @return float|int
     */
    public function getMonthDaysNumFormMinBsYear($bsMonth, $yearDiff): float|int
    {
        $yearCount = 0;
        $monthDaysFromMinBsYear = 0;
        if($yearDiff === 0){
            return 0;
        }
        $bsMonthData = $this->calendarData['extractedBsMonthData'][$bsMonth - 1];
        for($i=0;$i< count($bsMonthData); $i++){
            if($bsMonthData[$i] === 0){
                continue;
            }
            $bsMonthUpperDaysIndex = $i % 2;
            if($yearDiff > ($yearCount + $bsMonthData[$i])){
                $yearCount += $bsMonthData[$i];
                $monthDaysFromMinBsYear += $this->calendarData['bsMonthUpperDays'][$bsMonth - 1][$bsMonthUpperDaysIndex] * $bsMonthData[$i];
            }else{
                $monthDaysFromMinBsYear += $this->calendarData['bsMonthUpperDays'][$bsMonth - 1][$bsMonthUpperDaysIndex] * ($yearDiff - $yearCount);
                $yearCount = $yearDiff - $yearCount;
                break;
            }
        }
        return $monthDaysFromMinBsYear;
    }

    /**
     * @param $bsYear
     * @param $bsMonth
     * @param $bsDate
     * @return float|int|mixed|null
     */
    public function getTotalDaysNumFromMinBsYear($bsYear, $bsMonth, $bsDate)
    {
        if($bsYear < $this->calendarData['minBsYear'] || $bsYear > $this->calendarData['maxBsYear']){
            return null;
        }
        $daysNumFromMinBsYear = 0;
        $diffYears = $bsYear - $this->calendarData['minBsYear'];
        for($month=1;$month <= 12; $month++){
            if($month < $bsMonth){
                $daysNumFromMinBsYear += $this->getMonthDaysNumFormMinBsYear($month,$diffYears + 1);
            }else{
                $daysNumFromMinBsYear += $this->getMonthDaysNumFormMinBsYear($month,$diffYears);
            }
        }
        if($bsYear > 2085 && $bsYear < 2088){
            $daysNumFromMinBsYear += $bsDate -2;
        }elseif($bsYear === 2085 && $bsMonth > 5){
            $daysNumFromMinBsYear += $bsDate -2;
        }elseif($bsYear > 2088){
            $daysNumFromMinBsYear += $bsDate - 4;
        }elseif($bsDate === 2088 && $bsMonth > 5){
            $daysNumFromMinBsYear += $bsDate -4;
        }else{
            $daysNumFromMinBsYear += $bsDate;
        }
        return $daysNumFromMinBsYear;
    }

    /**
     * @param $bsYear
     * @param $bsMonth
     * @return int|mixed|null
     */
    public function getBsMonthDays($bsYear, $bsMonth)
    {
        $yearCount = 0;
        $totalYears = $bsYear + 1 - $this->calendarData['minBsYear'];
        $bsMonthData = $this->calendarData['extractedBsMonthData'][$bsMonth - 1];
        for($i=0;$i< count($bsMonthData); $i++){
            if($bsMonthData[$i] === 0){
                continue;
            }
            $bsMonthUpperDaysIndex = $i % 2;
            $yearCount += $bsMonthData[$i];
            if($totalYears <= $yearCount){
                if(($bsYear === 2085 && $bsMonth === 5) || ($bsYear === 2088 && $bsMonth ===5)){
                    return $this->calendarData['bsMonthUpperDays'][$bsMonth-1][$bsMonthUpperDaysIndex] - 2;
                }else{
                    return $this->calendarData['bsMonthUpperDays'][$bsMonth-1][$bsMonthUpperDaysIndex];
                }
            }
        }
        return null;
    }

    /**
     * @param $bsYear
     * @param $bsMonth
     * @param $bsDay
     * @return array
     */
    public function getAdDateByBsDate($bsYear, $bsMonth, $bsDay)
    {
        $this->validateBsYear($bsYear);
        $this->validateBsMonth($bsMonth);
        $this->validateBsDate($bsDay);
        $daysNumFromMinBsYear = $this->getTotalDaysNumFromMinBsYear($bsYear,$bsMonth,$bsDay);
        $adDate = [
            $this->calendarData['minAdDateEqBsDate']['ad']['year'],
            $this->calendarData['minAdDateEqBsDate']['ad']['month'],
            $this->calendarData['minAdDateEqBsDate']['ad']['date'] - 1,
        ];
        $adDate = implode('-',$adDate);
        $adDate = Carbon::parse($adDate)->addDays($daysNumFromMinBsYear);
        return [
            'year' => $adDate->year,
            'month' => $adDate->month,
            'date' => $adDate->day
        ];
    }

    /**
     * @param $adYear
     * @param $adMonth
     * @param $adDate
     * @return array
     */
    public function getBsDateByAdDate($adYear, $adMonth, $adDate) : array
    {
       $this->validateAdYear($adYear);
       $this->validateAdMonth($adMonth);
       $this->validateAdDate($adDate);
       $bsYear = $adYear + 57;
       $bsMonth = ($adMonth + 9) % 12;
       $bsMonth = $bsMonth === 0 ? 12 : $bsMonth;
       $bsDate = 1;
       if($adMonth < 4){
           $bsYear--;
       }elseif($adMonth === 4){
           $bsYearFirstAdDate = $this->getAdDateByBsDate($bsYear,1,1);
           if($adDate < $bsYearFirstAdDate['date']){
               $bsYear--;
           }
       }
       $bsMonthFirstAdDate = $this->getAdDateByBsDate($bsYear,$bsMonth,1);
       if ($adDate >= 1 && $adDate < $bsMonthFirstAdDate['date']){
           $bsMonth = $bsMonth !== 1 ? $bsMonth -1 : 12;
           $bsMonthDays = $this->getBsMonthDays($bsYear,$bsMonth);
           $bsDate = $bsMonthDays - ($bsMonthFirstAdDate['date'] - $adDate) + 1;
       }else{
           $bsDate = $adDate - $bsMonthFirstAdDate['date'] + 1;
       }


       return [
           'bsYear' => $bsYear,
           'bsMonth' => $bsMonth,
           'bsDate' => $bsDate
       ];
    }

    /**
     * @param $bsYear
     * @param $bsMonth
     * @param $bsDate
     * @return array
     */
    public function bsDateFormat($bsYear, $bsMonth, $bsDate)
    {
        $this->validateBsYear($bsYear);
        $this->validateBsMonth($bsMonth);
        $this->validateBsDate($bsDate);

        $eqAdDate = Carbon::parse(implode('-',$this->getAdDateByBsDate($bsYear,$bsMonth,$bsDate)));
        $weekDay = $eqAdDate->dayOfWeek + 1;
        return [
            'd' => nepali_number($bsDate),
            'y' => nepali_number($bsYear),
            'm' => nepali_number($bsMonth),
            'M' => $this->calendarData['bsMonths'][$bsMonth-1],
            'D' => $this->calendarData['bsDays'][$weekDay-1]
        ];
    }

    /**
     * @param $bsYear
     * @param $bsMonth
     * @param $bsDate
     * @return array
     */
    public function getBsMonthInfoByBsDate($bsYear, $bsMonth, $bsDate)
    {
        $this->validateBsYear($bsYear);
        $this->validateBsMonth($bsMonth);
        $this->validateBsDate($bsDate);
        $daysNumFromMinBsYear = $this->getTotalDaysNumFromMinBsYear($bsYear,$bsMonth,$bsDate);
        $adDate = [
            $this->calendarData['minAdDateEqBsDate']['ad']['year'],
            $this->calendarData['minAdDateEqBsDate']['ad']['month'],
            $this->calendarData['minAdDateEqBsDate']['ad']['date'] - 1,
        ];
        $adDate = implode('-',$adDate);
        $adDate = Carbon::parse($adDate)->addDays($daysNumFromMinBsYear);
        $bsMonthFirstAdDate =  Carbon::parse(implode('-',$this->getAdDateByBsDate($bsYear,$bsMonth,1)));
        $bsMonthDays = $this->getBsMonthDays($bsYear,$bsMonth);
        $bsDate = $bsDate > $bsMonthDays ? $bsMonthDays : $bsDate;
        $eqAdDate = Carbon::parse(implode('-',$this->getAdDateByBsDate($bsYear,$bsMonth,$bsDate)));
        $weekDay = $eqAdDate->dayOfWeek + 1;
        $formattedDate = $this->bsDateFormat($bsYear,$bsMonth,$bsDate);
        return [
            'bsYear' => $bsYear,
            'bsMonth' => $bsMonth,
            'bsDate' => $bsDate,
            'weekDay' => $weekDay,
            'formattedDate' => $formattedDate,
            'adDate' => $eqAdDate,
            'bsMonthFirstAdDate' => $bsMonthFirstAdDate,
            'bsMonthDays' => $bsMonthDays
        ];
    }

    /**
     * @param string $title
     * @param $start_date
     * @param $end_date
     * @param string|null $url
     * @return $this
     */
    public function event(string $title, $start_date, $end_date, string $url=null,string $color=null): static
    {
        if(!$start_date instanceof  Carbon){
            $start_date = Carbon::parse($start_date);
        }
        if(!$end_date instanceof  Carbon){
            $end_date = Carbon::parse($end_date);
        }
        $this->events[] = [
            'title' => $title,
            'start_date' => $start_date->startOfDay(),
            'end_date' => $end_date->startOfDay(),
            'days'  => $start_date->diffInDays($end_date) + 1,
            'bs_start_date' => implode('-',$this->getBsDateByAdDate($start_date->year,$start_date->month,$start_date->day)),
            'bs_end_date' => implode('-',$this->getBsDateByAdDate($end_date->year,$end_date->month,$end_date->day)),
            'url' => $url,
            'color' => $color
        ];
        return $this;
    }

    public function addColors($colors): static
    {
        $this->colors = $colors;
        return $this;
    }

    /**
     * @param array $params
     * @return array
     */
    public function getNepaliCalendar(array $params = [])
    {
        $currentDate = now();
        $currentBsDate = $this->getBsDateByAdDate($currentDate->year,$currentDate->month,$currentDate->day);
        if(isset($params['year'])){
            $currentBsDate['bsYear'] = (int) $params['year'];
        }
        if(isset($params['month'])){
            $currentBsDate['bsMonth'] = (int) $params['month'];
        }

        $data = $this->getBsMonthInfoByBsDate($currentBsDate['bsYear'],$currentBsDate['bsMonth'],$currentBsDate['bsDate']);
        $weekCoverInMonth = ceil(($data['bsMonthFirstAdDate']->dayOfWeek + $data['bsMonthDays']) / 7);
        $preMonth = $data['bsMonth'] -1 !== 0 ? $data['bsMonth'] -1 : 12;
        $preYear = $preMonth === 12 ? $data['bsYear'] - 1 : $data['bsYear'];
        $preMonthDays = $preYear>= $this->calendarData['minBsYear'] ? $this->getBsMonthDays($preYear,$preMonth) : 30;
        $results = [];
        $adMonths = [];
        $adYears = [];
        for($i=0;$i < $weekCoverInMonth ; $i++){
            for($k=1;$k<=7;$k++){
                $month = $data['bsMonth'];
                $year = $data['bsYear'];
                $currentMonth = true;
                $calendarDate = $i * 7 + $k - $data['bsMonthFirstAdDate']->dayOfWeek;
                if($calendarDate <= 0){
                    $calendarDate = $preMonthDays + $calendarDate;
                    $currentMonth = false;
                    $month = $month === 1 ? 12 : $month - 1;
                    $year = $month === 1 ? $year - 1 : $year;

                }elseif ($calendarDate > $data['bsMonthDays']){
                    $calendarDate = $calendarDate - $data['bsMonthDays'];
                    $currentMonth = false;
                    $month = $month === 12 ? 1 : $month + 1;
                    $year = $month === 12 ? $year + 1 : $year;
                }
                $adDate =  $this->getAdDateByBsDate($year,$month,$calendarDate);
                $adFormattedDate = Carbon::parse($adDate['year'] . '-' . $adDate['month'] . '-'. $adDate['date']);
                $daysEvents = collect($this->events)->filter(function($event) use ($adFormattedDate){
                    if($adFormattedDate->eq($event['start_date'])){
                        return true;
                    }
                    if($adFormattedDate->between($event['start_date'],$event['end_date'])){
                        return true;
                    }
                    return  false;
                });
                $results[$i][] = [
                    'bsDate' => $calendarDate,
                    'currentMonth' => $currentMonth,
                    'month' => $month,
                    'adDate' => $adFormattedDate,
                    'events' => $daysEvents
                ];
                if(!in_array($adDate['month'],$adMonths)){
                    $adMonths[]=$adDate['month'];
                }
                if(!in_array($adDate['year'],$adYears)){
                    $adYears[]=$adDate['year'];
                }
            }
        }
        foreach($adMonths as $key =>  $adMonth){
            $adMonths[$key] = config('core.nepali-date.adMonths.' . $adMonth - 1);
        }
        $years = range(config('core.nepali-date.minBsYear'),config('core.nepali-date.maxBsYear'));
        $years = array_combine($years,$years);
        $view =  view('core::admin.calendar.index',[
            'weekCoverInMonth' => $weekCoverInMonth,
            'data' => $data,
            'preMonthDays' => $preMonthDays,
            'adMonths' => $adMonths,
            'years' => $years,
            'results' => $results,
            'adYears' => $adYears,
            'colors' => $this->colors
        ])->render();
        return [
            'view' => $view,
            'year' => $data['bsYear'],
            'month' => $data['bsMonth'],
        ];
    }
}
