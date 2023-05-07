<?php


class View
{
    public function render(string $file, array $params = []): string
    {
        if (!file_exists($file)) {
            return '';
        }
        extract($params);
        ob_start();
        require $file;
        return ob_get_clean();
    }
}