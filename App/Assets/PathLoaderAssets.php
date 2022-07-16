<?php

namespace App\Assets;

class PathLoader
{
    CONST PATH = [
        './',
        'App',
        'Front',
        'Front/Controller',
        'Front/public/views',
        'Assets/',
        'Controller/',
        'App/Controller/',
        'App/Controller/Articles',  
        'App/Model/Entities',
        'App/Model/Manager',     
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