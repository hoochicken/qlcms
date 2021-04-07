<?php


class View
{
    /**
     * @param $strFile
     * @param $arrParams
     * @return false|string
     */
    public function render(string $strFile, array $arrParams = []): string
    {
        if (!file_exists($strFile)) {
            return '';
        }
        extract($arrParams);
        ob_start();
        require $strFile;
        return ob_get_clean();
    }
}