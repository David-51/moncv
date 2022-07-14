<?php

namespace Assets;

/**
 * this class is made to clean array from injection XSS. remove php and html balise by using strip_tags and trim.
 */
class CleanArray {
    /**
     * @param array $array array to clean with strip_tags and trim
     * @return array the array clean
     */
    public static function Clean(array $array) :array {
        return array_map(function ($value){
            if(is_array($value)){
                return self::Clean($value);
            }else{
                $newvalue = strip_tags($value);
                return trim($newvalue);
            }
            }, $array);
    }
}
