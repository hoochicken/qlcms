<?php
class Csv
{
    private $strCsv = '';
    private $arrRowAllRaw = [];
    private $arrRowAll = [];
    private $strDelimiter = '';
    private $strRowDelimiter = "\n";

    /**
     * Vocabulary constructor.
     * @param $strCsv
     * @param $strDelimiter
     */
    public function __construct($strCsv, $strDelimiter = ',')
    {
        $this->setDelimiter($strDelimiter);
        $this->setCsv($strCsv);
    }

    /**
     * @param $strDelimiter
     */
    public function setDelimiter(string $strDelimiter)
    {
        $this->strDelimiter = $strDelimiter;
    }

    /**
     * @param string $strRowDelimiter
     */
    public function setRowDelimiter(string $strRowDelimiter)
    {
        $this->strRowDelimiter = $strRowDelimiter;
    }

    /**
     * @param $strCsv
     */
    public function setCsv($strCsv)
    {
        $this->strCsv = $strCsv;
        $this->arrRowAllRaw = explode($this->strRowDelimiter, $strCsv);
        foreach($this->arrRowAllRaw as $strRow) {
            $this->arrRowAll[] = str_getcsv($strRow, $this->strDelimiter);
        }
    }

    /**
     *
     */
    public function getRowRandom(): array
    {
        $numKeyRandom = array_rand($this->arrRowAll);
        $arrRow = $this->getRowByKey($numKeyRandom);
        return $arrRow;
    }

    /**
     *
     */
    public function getAll(): array
    {
        return $this->arrRowAll;
    }

    /**
     * @param $numKey
     * @return mixed|string
     */
    public function getRowByKey($numKey): array
    {
        return $this->arrRowAll[$numKey] ?? [];
    }
}