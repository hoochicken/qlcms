<?php

class RiddleModel
{
    private $numColumnRiddle = 0;
    private $numColumnTranslation = 1;
    private $numColumnInfo1 = 2;
    private $numColumnInfo2 = 3;

    private $numKey = '';
    private $strRiddle = '';
    private $strTranslation = '';
    private $strInfo1 = '';
    private $strInfo2 = '';

    /**
     * Vocabulary constructor.
     * @param $arrData
     * @param int $numKey
     */
    public function __construct($arrData, $numKey = 0)
    {
        $this->setData(
            $arrData[$this->numColumnRiddle] ?? '',
            $arrData[$this->numColumnTranslation] ?? '',
            $arrData[$this->numColumnInfo1] ?? '',
            $arrData[$this->numColumnInfo2] ?? '', $numKey
        );
    }

    /**
     * Vocabulary constructor.
     * @param $strRiddle
     * @param $strTranslation
     * @param $strInfo1
     * @param $strInfo2
     * @param int $numKey
     */
    public function setData($strRiddle, $strTranslation, $strInfo1, $strInfo2, $numKey = 0)
    {
        $this->setRiddle($strRiddle);
        $this->setTranslation($strTranslation);
        $this->setInfo1($strInfo1);
        $this->setInfo2($strInfo2);
        $this->setKey($numKey);
    }

    /**
     * @param string $value
     */
    public function setKey(string $value)
    {
        $this->numKey = $value;
    }

    /**
     * @param string $value
     */
    public function setRiddle(string $value)
    {
        $this->strRiddle = $value;
    }

    /**
     * @param string $value
     */
    public function setTranslation(string $value)
    {
        $this->strTranslation = $value;
    }

    /**
     * @param string $value
     */
    public function setInfo1(string $value)
    {
        $this->strInfo1 = $value;
    }

    /**
     * @param string $value
     */
    public function setInfo2(string $value)
    {
        $this->strInfo2 = $value;
    }

    /**
     * @return integer
     */
    public function getKey(): int
    {
        return $this->numKey;
    }

    /**
     * @return string
     */
    public function getRiddle(): string
    {
        return $this->strRiddle;
    }

    /**
     * @return string
     */
    public function getTranslation(): string
    {
        return $this->strTranslation;
    }

    /**
     * @return string
     */
    public function getInfo1(): string
    {
        return $this->strInfo1;
    }

    /**
     * @return string
     */
    public function getInfo2(): string
    {
        return $this->strInfo2;
    }

    /**
     * @return array
     */
    public function getSolutionAsArray(): array
    {
        return explode(' ', $this->getSolution());
    }

    /**
     * @return string
     */
    public function getSolution(): string
    {
        return $this->getTranslation() . ' ' . $this->getInfo1();
    }
}