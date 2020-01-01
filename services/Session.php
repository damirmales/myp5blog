<?php
namespace Services;

class Session
{
    protected $session;

    public function __construct($session)
    {
        $this->session = $session;
    }

    public function set($name,$key, $value)
    {
        $this->session[$name][$key] = $value;
    }

    public function show($name,$key)
    {print_r($this->session[$name]) ;
        if(isset($this->session[$name][$key])) {
            $value = $this->get($name,$key);
            $this->remove($name,$key);
            return $value;
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
