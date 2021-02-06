<?php

/** autoload files */
spl_autoload_register(function($class){
    if(file_exists('lib/core/'.$class.'.php')){
        require_once('lib/core/'.$class.'.php');
    }
    if(file_exists('lib/database/'.$class.'.php')){
        require_once('lib/database/'.$class.'.php');
    }
});