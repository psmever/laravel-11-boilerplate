<?php

namespace App\Helpers;

use Carbon\Carbon;

class ServiceGenerate
{
    /**
     * mysql 시간 공통 처리.
     * @param Carbon $date
     * @return array
     */
    public static function GenerateResponseMysqlDate(Carbon $date): array
    {
        return [
            'detail' => [
                'year' => $date->format('Y'),
                'month' => $date->format('m'),
                'day' => $date->format('d'),
                'hour' => $date->format('H'),
                'minute' => $date->format('i'),
                'second' => $date->format('s'),
            ],
            'step1' => $date->format('Y-m-d H:i:s'),
            'step2' => $date->format('Y-m-d H:i'),
            'step3' => $date->format('Y-m-d'),
        ];
    }
}
