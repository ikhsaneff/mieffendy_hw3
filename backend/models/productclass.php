<?php

class Product {
    private $id;
    private $name;
    private $description;
    private $average_rating;
    private $price;
    private $num_reviews;

    function __construct(int $id, string $name, string $description, float $average_rating, float $price, int $num_reviews) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->average_rating = $average_rating;
        $this->price = $price;
        $this->num_reviews = $num_reviews;
    }

    function getProductProperty(string $key) {
        return $this->$key;
    }

    function setProductProperty(string $key, $value) {
        $this->$key = $value;
    }

    function getRatingStars() {
        $rating = $this->average_rating;
        $stars = "";

        for ($i = 5; $i > 0; $i--) {
            if ($rating >= 1) {
                $stars .= "<i class='fas fa-star'></i>";
            } else if ($rating >= 0.5) {
                $stars .= "<i class='fas fa-star-half-alt'></i>";
            } else {
                $stars .= "<i class='far fa-star'></i>";
            }

            $rating--;
        }

        return $stars;
    }
}
