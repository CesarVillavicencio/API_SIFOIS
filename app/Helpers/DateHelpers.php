<?php

namespace App\Helpers;

// use Carbon\Carbon;

class DateHelpers {

    public static $dias = array(
        0  => "Domingo",
        1  => "Lunes",
        2  => "Martes",
        3  => "Miércoles",
        4  => "Jueves",
        5  => "Viernes",
        6  => "Sábado"
    );

    public static $meses = array(
        1  => "Enero",
        2  => "Febrero",
        3  => "Marzo",
        4  => "Abril",
        5  => "Mayo",
        6  => "Junio",
        7  => "Julio",
        8  => "Agosto",
        9  => "Septiembre",
        10 => "Octubre",
        11 => "Noviembre",
        12 => "Diciembre"
    );

    public static function dateStringToReadable($date)
    {
        if ($date == null) { return ""; }
        $datestr = strtotime($date);
        $numdia  = date("d", $datestr);
        $month   = date("n", $datestr);
        $year    = date("Y", $datestr);
        $strdate = $numdia." de ".self::$meses[$month]." de ".$year;
        return $strdate;
    }
}