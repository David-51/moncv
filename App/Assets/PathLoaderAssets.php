<?php

namespace App\Assets;

class PathLoader
{
    CONST PATH = [
        './',
        'Front',
        'Front/Assets',
        'Front/Controller',
        'Front/public/views',
        'vendor'
    ];

    static function registerPath(){
        foreach(self::PATH as $value) {        
            set_include_path(
                get_include_path().PATH_SEPARATOR.$value
            );
        }        
    }    
}