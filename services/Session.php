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
        $this->session[$name][$key] = $value;
    }

    public function show($name)
    {
        if(isset($this->session[$name])) {
            $key = $this->get($name);
            $this->remove($name);
            return $key;
        }
    }

    public function get($name,$key)
    {
        if(isset($this->session[$name][$key])) {
            return $this->session[$name][$key];
        }
    }

    public function remove($name,$key)
    {
        unset($this->session[$name][$key]);
    }

    public function stop()
    {
        session_destroy();
    }
}
