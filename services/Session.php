<?php

namespace Services;

class Session
{
    protected $session;

    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->session = &$_SESSION;
    }

    /**
     * @param $name
     * @param $key
     * @param $value
     */
    public function set($name, $key, $value)
    {
        $this->session[$name][$key] = $value;
    }

    /**
     * @param $name
     * @param $key
     * @return |null
     */
    public function get($name, $key)
    {
        if (isset($this->session[$name][$key])) {
            return $this->session[$name][$key];
        }
        return null;
    }

    /**
     * @param $name
     * @param $key
     * @return |null
     */
    public function show($name, $key)
    {
        if (isset($this->session[$name][$key])) {
            $value = $this->get($name, $key);
            $this->remove($name, $key);
            return $value;
        }
        return null;
    }

    /**
     * @param $name
     * @param $key
     */
    public function remove($name, $key)
    {
        unset($this->session[$name][$key]);
    }

    /**
     *
     */
    public function stop()
    {
        session_destroy();
    }
}
