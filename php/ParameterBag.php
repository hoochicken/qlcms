<?php


class ParameterBag
{
    /** @var array  */
    private $arrParams = [];
    /** @var null  */
    private static $objParameterBag = null;

    /**
     * ParameterBag constructor.
     * @param $params
     */
    public function __construct($params = [])
    {
        $this->setMultiple($params);
    }

    /**
     * @param $params
     */
    public function setMultiple($params)
    {
        if (!$params) return;
        foreach ($params as $k => $v) {
            $this->arrParams[$k] = $v;
        }
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        return $this->arrParams[$key] ?? $default;
    }

    /**
     * @param $key
     * @param bool $default
     * @return mixed|null
     */
    public function getBool($key, $default = null): ? bool
    {
        $return = $this->arrParams[$key] ?? $default;
        return (bool) $return;
    }

    /**
     * @param $key
     * @param bool $default
     * @return mixed|null
     */
    public function getString($key, $default = null): ? string
    {
        $return = $this->arrParams[$key] ?? $default;
        return (string) $return;
    }

    /**
     * @param $key
     * @param bool $default
     * @return mixed|null
     */
    public function getInt($key, $default = null): ? int
    {
        $return = $this->arrParams[$key] ?? $default;
        return (int) $return;
    }

    /**
     * @param $key
     * @param bool $default
     * @return mixed|null
     */
    public function getArray($key, $default = null): ? array
    {
        $return = $this->arrParams[$key] ?? $default;
        return (array) $return;
    }

    /**
     * @param $key
     * @param bool $default
     * @return mixed|null
     */
    public function getIntVal($key, $default = null): ? int
    {
        $return = intval($this->arrParams[$key] ?? $default);
        return (int) $return;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed|null
     */
    public function set($key, $value)
    {
        $this->arrParams[$key] = $value;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed|null
     */
    public function setBool($key, $value)
    {
        $this->arrParams[$key] = (bool) $value;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed|null
     */
    public function setString($key, $value)
    {
        $this->arrParams[$key] = (string) $value;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed|null
     */
    public function setInt($key, $value)
    {
        $this->arrParams[$key] = (int) $value;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed|null
     */
    public function setArray($key, $value)
    {
        $this->arrParams[$key] = (array) $value;
    }

    /**
     * @param array $params
     * @return ParameterBag|null
     */
    private static function getInstance($params = [])
    {
        if (null === self::$objParameterBag) {
            self::$objParameterBag = new ParameterBag($params);
        }
        return self::$objParameterBag;
    }

    /**
     * @param $params
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public static function getElement($params, $key, $default)
    {
        return self::getInstance($params)->get($key, $default);
    }

    /**
     * @param $params
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public static function getElementBool($params, $key, $default)
    {
        return self::getInstance($params)->getBool($key, $default);
    }

    /**
     * @param $params
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public static function getElementString($params, $key, $default)
    {
        return self::getInstance($params)->getString($key, $default);
    }

    /**
     * @param $params
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public static function getElementInt($params, $key, $default)
    {
        return self::getInstance($params)->getInt($key, $default);
    }

    /**
     * @param $params
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public static function getElementArray($params, $key, $default)
    {
        return self::getInstance($params)->getArray($key, $default);
    }

    /**
     * @param $params
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public static function getElementIntVal($params, $key, $default)
    {
        return self::getInstance($params)->getIntVal($key, $default);
    }
}
