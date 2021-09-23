<?php

class Service
{
    public function dateFr($date)
    {
        if($datetime = DateTime::createfromformat("Y-m-d H:i:s", $date)){
            return $date = $datetime->format("d/m/Y à H:i");
        }else if($datetime = DateTime::createfromformat("Y-m-d", $date)){
            return $date = $datetime->format("d/m/Y");
        }
    }
    public function gererGuillemets($string)
    {
        /* return str_replace('"', '\"', $string); */
        return trim(htmlspecialchars($string, ENT_QUOTES, 'UTF-8', false));
    }
}
