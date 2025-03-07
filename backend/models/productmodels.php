<?php

require_once 'productclass.php';
require_once 'visualclass.php';

class ProductModels {
    private $products = [];
    private $visuals = [];
    private $current_dir = __DIR__;

    function __construct() {
        $this->instantiateProducts();
        $this->instantiateVisuals();
    }

    function instantiateProducts() {
        $file = fopen($this->current_dir.'\..\..\data\product.csv', 'r');

        fgetcsv($file, escape: "\\");

        while (! feof($file)) {
            $product = fgetcsv($file, escape: "\\");

            if ($product) {
                $this->products[] = new Product(
                    $product[0],
                    $product[1],
                    $product[2],
                    $product[3],
                    $product[4],
                    $product[5]
                );
            }
        }

        fclose($file);
    }

    function instantiateVisuals() {
        $file = fopen($this->current_dir.'\..\..\data\visualcontent.csv', 'r');

        fgetcsv($file, escape: "\\");

        while (! feof($file)) {
            $visual = fgetcsv($file, escape: "\\");

            if ($visual) {
                $this->visuals[] = new Visual(
                    $visual[0],
                    $visual[1],
                    $visual[2],
                    $visual[3],
                    $visual[4],
                    $visual[5],
                    $visual[6]
                );
            }
        }

        fclose($file);
    }

    function getProductObjects(?int $id = null) {
        if ($id) {
            foreach ($this->products as $product) {
                if ($product->getProductProperty('id') == $id) {
                    return $product;
                }
            }
        } else if ($id == null) {
            return $this->products;
        }

        return false;
    }

    function getVisualObject(int $id, string $class) {
        foreach ($this->visuals as $visual) {
            $product_id = $visual->getVisualProperty('product_id');
            $image_class = $visual->getVisualProperty('css_class');
            if ($product_id == $id && $image_class == $class) {
                return $visual;
            }
        }
    }

}