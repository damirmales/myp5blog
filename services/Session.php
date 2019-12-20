<?php
namespace Services;

class Session
{
    public $session;

    public function __construct($session)
    {
        $this->session = $session;
    }

    public function set($name,$key, $value)
    {
        $session[$name][$key] = $value;
    }

    public function get($name,$key)
    {
        if(isset($session[$name][$key])) {
            return $session[$name][$key];
        }
    }

    public function show($name)
    {
        if(isset($session[$name]))
        {
            $key = $this->get($name);
            $this->remove($name);
            return $key;
        }
    }

    public function remove($name,$key)
    {
        unset($session[$name][$key]);
    }

    public function stop()
    {
        session_destroy();
    }

}