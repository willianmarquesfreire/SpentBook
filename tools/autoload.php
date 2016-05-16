<?php

spl_autoload_register(

    function( $classname ) {

        require_once str_replace( '\\', DIRECTORY_SEPARATOR, $classname ) . '.php';
    }

);