<?php

namespace App\Assets;

Class BBCode {
    public static function Display($content){
        
        $content = stripslashes($content);
        $content = htmlspecialchars($content); 
        $content = nl2br($content);
    
        $content = preg_replace('#\[p\](.+)\[/p\]#iU', '<p>$1</p>', $content);
        $content = preg_replace('#\[b\](.+)\[/b\]#iU', '<b>$1</b>', $content);
        $content = preg_replace('#\[i\](.+)\[/i\]#iU', '<i>$1</i>', $content);
        $content = preg_replace('#\[center\](.+)\[/center\]#iU', '<center>$1</center>', $content);
        $content = preg_replace('#\[h\](.+)\[/h\]#iU', '<h2>$1</h2>', $content);
        $content = preg_replace('#\[color=(red|green|blue|yellow|purple|olive)\](.+)\[/color\]#isU', '<span style="color:$1">$2</span>', $content);
        $content = preg_replace('#\[info\](.+)\[/info\]#iU',
            '                  
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <h5 class="alert-heading">
                    $1                
                </div>                 
            ', $content);
        $content = preg_replace('#\[warning\](.+)\[/warning\]#iU', '
            <div class="bg-red">                  
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h5 class="alert-heading">
                    $1                
                </div>                 
            </div>', $content); // pavé Warning
            $content = preg_replace('#\[success\](.+)\[/success\]#iU', '
        <div class="bg-red">                  
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h5 class="alert-heading">
                $1                
            </div>                 
        </div>', $content); // pavé Succès
        $content = preg_replace('#\[link\](.+)\[/link\]#iU', '<a href="$1">$1</a>', $content);
        $content = preg_replace('#\[image\](.+)\[/image\]#iU', '<img src="$1">', $content);
        $content = preg_replace('#\[video\](.+)\[/video\]#iU', 
        '<iframe width="560" height="315" 
            src="$1" 
            title="YouTube video player" 
            frameborder="0" 
            ></iframe>', $content);
        
        return $content;
    }

}