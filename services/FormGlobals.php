<?php


namespace Services;


class FormGlobals
{
    private $_post;
    private $_get;

    /**
     * FormPost constructor.
     */
    public function __construct()
    {
        $this->_post = $_POST;
        $this->_get = $_GET;
    }

    /**
     * @param null $key
     * @return mixed|null
     */
    public function post($key = null)
    {
        return $this->checkGlobal($this->_post, $key);
    }

    /**
     * @param $global
     * @param null $key
     * @return mixed|null
     */
    private function checkGlobal($global, $key = null)
    {
        if ($key) {
            if (isset($global[$key])) {
                return $global[$key];
            }
            return null;
        }
        return $global;
    }
}