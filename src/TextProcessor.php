<?php
class TextProcessor {

    public $text;
    function __construct($data)
    {

        $this->text = $data['job']['text'];

        if(isset($data['job']['methods']) && $data['job']['methods'] != '') {
            $methods = $data['job']['methods'];

            array_map(function ($method) {
                if (method_exists($this, $method)) {
                    $this->text = $this->$method();
                }
            }, $methods);
            return $this->text;
        }

    }

    private function htmlspecialchars() {
        return htmlspecialchars($this->text);
    }

    private function stripTags() {
        return strip_tags($this->text);
    }

    private function replaceSpacesToEol() {
        return str_replace(' ',PHP_EOL, $this->text);
    }

    private function removeSpaces() {
         return str_replace(' ', '', $this->text);
    }

    public function removeSymbols() {
        return preg_replace('/[.,\/!@#$%^&*()]/', '', $this->text);
    }

    private function toNumber() {

        preg_match('!\d+!', $this->text,$matches);
        return isset($matches[0]) ? $matches[0] : '';
    }
}