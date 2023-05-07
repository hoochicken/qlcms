<?php


class ParameterBag
{
    /** @var array  */
    private $params = [];
    /** @var null  */
    private static $parameterBag = null;

    public function __construct(array $params = [])
    {
        $this->setMultiple($params);
    }

    public function setMultiple($params)
    {
        if (!$params) return;
        foreach ($params as $k => $v) {
            $this->params[$k] = $v;
        }
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        return $this->params[$key] ?? $default;
    }

        public function getBool($key, ?bool $default = null): ? bool
    {
        $return = $this->params[$key] ?? $default;
        return (bool) $return;
    }

    public function getString($key, ?string $default = null): ? string
    {
        $return = $this->params[$key] ?? $default;
        return (string) $return;
    }

    /**
     * @param $key
     * @param bool $default
     * @return mixed|null
     */
    public function getInt($key, ?int $default = null): ? int
    {
        $return = $this->params[$key] ?? $default;
        return (int) $return;
    }

    /**
     * @param $key
     * @param bool $default
     * @return mixed|null
     */
    public function getArray($key, ?array$default = null): ? array
    {
        $return = $this->params[$key] ?? $default;
        return (array) $return;
    }

    /**
     * @param $key
     * @param bool $default
     * @return mixed|null
     */
    public function getIntVal($key, ?int$default = null): ? int
    {
        $return = intval($this->params[$key] ?? $default);
        return (int) $return;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed|null
     */
    public function set($key, $value)
    {
        $this->params[$key] = $value;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed|null
     */
    public function setBool($key, $value)
    {
        $this->params[$key] = (bool) $value;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed|null
     */
    public function setString($key, $value)
    {
        $this->params[$key] = (string) $value;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed|null
     */
    public function setInt($key, $value)
    {
        $this->params[$key] = (int) $value;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed|null
     */
    public function setArray($key, $value)
    {
        $this->params[$key] = (array) $value;
    }

    /**
     * @param array $params
     * @return ParameterBag|null
     */
    private static function getInstance($params = [])
    {
        if (null === self::$parameterBag) {
            self::$parameterBag = new ParameterBag($params);
        }
        return self::$parameterBag;
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
