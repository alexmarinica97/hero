<?php


namespace App\provider;

class View
{
    private $data = array();

    private $render = FALSE;

    public function __construct($template)
    {
        try {
            $file = __DIR__ . '/../../resources/views/' . strtolower($template) . '.php';

            if (file_exists($file)) {
                $this->render = $file;
            } else {
                throw new \Exception('Template ' . $template . ' not found!');
            }
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function assign($variables)
    {
        foreach ($variables as $key => $value) {
            $this->data[$key] = $value;
        }
    }

    public function __destruct()
    {
        extract($this->data);
        include($this->render);

    }
}