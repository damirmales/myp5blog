<?php
namespace Services;

class Session
{
    protected static $session;

    public function __construct($session)
    {
        self::$session = $session;
    }

    public static function set($name,$key, $value)
    {
        self::$session[$name][$key] = $value;
    }

    public static function show($name,$key)
    {
        if(isset(self::$session[$name][$key])) {
            $value = $this->get($name,$key);
            self::remove($name,$key);
            return $value;
        }
    }

    public static function get($name,$key)
    {
        if(isset(self::$session[$name][$key])) {
            return self::$session[$name][$key];
        }
        return null;
    }

    public static function remove($name,$key)
    {
        unset(self::$session[$name][$key]);
    }

    public static function stop()
    {
        session_destroy();
    }
}
