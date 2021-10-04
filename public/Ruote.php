<?php

class Ruote
{

    public static array $routes = [];



    public static function add( $key, $demo = []){
        self::$routes [$key] = $demo;
    }

    public static function demo(){
        $summ = ['1' => self::$routes, '2' => $demo = ['a' => 'a', 'b' => 'b' , 'c' => 'c'], '3' => $ops = ['a' => 'a', 'b' => 'b' , 'c' => 'c']];
        return $summ;
    }

}