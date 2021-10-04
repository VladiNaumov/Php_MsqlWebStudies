<?php

class ArrayDemo
{

    public static array $routes = [];


    public static function add( $key, $demo = []){
        self::$routes [$key] = $demo;
    }


    public static function add__(){


        $A = [];
        $A['4A'] = '4A';
        $A['5A'] = '5A';
        $A['6A'] = '6A';
        $A['7A'] = '4A';


        $B = [];

        $B['1A'] = ['1a' =>'1A', '1b' => '1B', '1c'=>'1C'];
        $B['2A'] = ['2a' =>'2A', '2b' => '2B', '2c'=>'2C'];


        $C ['/'] = $D = ['controller' => 'Posts','action' => 'add'];




        return $A;

    }

}