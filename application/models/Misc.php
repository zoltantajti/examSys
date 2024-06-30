<?php
class Misc extends CI_Model {
    public function __construct(){ parent::__construct(); }

    public function minutesToTime($minutes,$format="long")
    {
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;
        $formattedHours = str_pad($hours, 2, "0", STR_PAD_LEFT);
        $formattedMinutes = str_pad($remainingMinutes, 2, "0", STR_PAD_LEFT);
        if($format == "long"){
            return $formattedHours . " hour " . $formattedMinutes . " minutes";
        }else{
            return $formattedHours . ":" . $formattedMinutes;
        }
    }
}