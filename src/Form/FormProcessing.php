<?php

namespace App\Form;


use App\API\LPLib_Feiertage_Connector;


class FormProcessing
{
    public function getDifference(\DateTime $yourDate)
    {
        $currentDateTime = new \DateTime('now');
        return $yourDate->diff($currentDateTime)->format('%Y Jahre, %m Monate, %d Tage, %H Stunden, %i Minuten, %s Sekunden');
    }

    public function getWeekday(\DateTime $yourDate): String
    {
        $wochentage = array("Sonntag","Montag","Dienstag", "Mittwoch","Donnerstag","Freitag","Samstag");
        $pos = $yourDate->format('w');
        return $wochentage[$pos];
    }

    public function getTimezoneTokyo(\DateTime $yourDate): \DateTime
    {
        $tokyodate = clone $yourDate;
        $tokyodate = $tokyodate->setTimezone(new \DateTimeZone('Asia/Tokyo'));
        return $tokyodate;
    }

    public function getTimezoneNewYork(\DateTime $yourDate): \DateTime
    {   
        $newyorkdate = clone $yourDate;
        $newyorkdate = $newyorkdate->setTimezone(new \DateTimeZone('America/New_York'));
        return $newyorkdate;
    }
    
    public function getMonat(\DateTime $yourDate)
    {
        $monate = array("Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember");
        $pos = $yourDate->format('n');
        return $monate[$pos-1];
    }

    public function getFeiertag(\DateTime $yourDate)
    {   
        $yourDateFormat = $yourDate->format('d-m');

        $connector = new LPLib_Feiertage_Connector();
        $feiertage = $connector->getFeiertageVonLand('YourDateFormat', LPLib_Feiertage_Connector::LAND_SAARLAND);

        foreach($feiertage as $feiertagsName => $feiertagsInfo)
            {   
                foreach($feiertagsInfo as $info => $value)
                    {
                        if($info == 'datum')
                        {
                            $value = \datetime::createfromformat('Y-m-d',$value);
                            $value = $value->format('d-m');
                        }
                        if($value == $yourDateFormat)
                        {
                            return $feiertagsName;
                        }
                    }
            }
    }
}

