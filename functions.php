<?php

function translate($str_ru, $str_ua, $str_en)
{
    $lang=SiteFunction::getLang();
    if($lang==1) {return $str_ru;}
    else if($lang==2) {return $str_en;}
    else if($lang==3) {return $str_ua;}
}