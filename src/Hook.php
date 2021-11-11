<?php

/**
 * Hook Api
 *
 * This is light and fast Php hook class
 *
 *
 * @link www.omerfd,com
 * @since 1.0.0
 *
 * @version 1.0.0
 *
 * @package Omerfdmrl\hook
 * 
 * @licence: The MIT License (MIT) - Copyright (c) - http://opensource.org/licenses/MIT
 */

namespace Omerfdmrl\Hook;

class Hook 
{

    public static $events = [];


    protected static function hook($name,$callback = null,$value = null,$priority = 10)
    {
        if($callback !== null){
            if($callback){
                self::$events[$name][$callback] = $priority;
            }else {
                unset(self::$events[$name]);
            }
        }elseif(isset(self::$events[$name])){
            // print_r(self::$events);
            arsort(self::$events[$name]);
            foreach(self::$events[$name] as $callback => $priority){
                $value = call_user_func($callback,$value);   
            }
        }
        return $value;
    }

    public static function add($name,$callback,$priority = 10)
    {
        return self::hook($name,$callback,null,$priority);
    }

    public static function do($name,$value)
    {
        return self::hook($name,null,$value);
    }

    public static function remove($name)
    {
        self::hook($name,False);
    }

}