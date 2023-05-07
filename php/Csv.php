<?php
class Csv
{
    private string $csv = '';
    private array $rowAllRaw = [];
    private array $rowAll = [];
    private string $delimiter = '';
    private string $rowDelimiter = "\n";

    /**
     * Vocabulary constructor.
     * @param $csv
     * @param $delimiter
     */
    public function __construct($csv, $delimiter = ',')
    {
        $this->setDelimiter($delimiter);
        $this->setCsv($csv);
    }

    /**
     * @param $delimiter
     */
    public function setDelimiter(string $delimiter)
    {
        $this->delimiter = $delimiter;
    }

    /**
     * @param string $rowDelimiter
     */
    public function setRowDelimiter(string $rowDelimiter)
    {
        $this->rowDelimiter = $rowDelimiter;
    }

    /**
     * @param $csv
     */
    public function setCsv($csv)
    {
        $this->csv = $csv;
        $this->rowAllRaw = explode($this->rowDelimiter, $csv);
        foreach($this->rowAllRaw as $strRow) {
            $this->rowAll[] = str_getcsv($strRow, $this->delimiter);
        }
    }

    /**
     *
     */
    public function getRowRandom(): array
    {
        $numKeyRandom = array_rand($this->rowAll);
        $row = $this->getRowByKey($numKeyRandom);
        return $row;
    }

    /**
     *
     */
    public function getAll(): array
    {
        return $this->rowAll;
    }

    /**
     * @param $numKey
     * @return mixed|string
     */
    public function getRowByKey($numKey): array
    {
        return $this->rowAll[$numKey] ?? [];
    }
}