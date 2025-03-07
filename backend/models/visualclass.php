<?php

class Visual {
    private $id;
    private $name;
    private $description;
    private $short_name;
    private $file_type;
    private $css_class;
    private $product_id;

    function __construct(int $id, string $name, string $description, string $short_name, string $file_type, string $css_class, int $product_id) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->short_name = $short_name;
        $this->file_type = $file_type;
        $this->css_class = $css_class;
        $this->product_id = $product_id;
    }

    function getVisualProperty(string $key) {
        return $this->$key;
    }

    function setVisualProperty(string $key, $value) {
        $this->$key = $value;
    }

    function getHTML() {
        $html = "<img src='images/" .$this->short_name .$this->file_type ."' alt='" .$this->name ."' class='" .$this->css_class ."'>";

        return $html;
    }
}