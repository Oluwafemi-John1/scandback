<?php
require "config.php";
require "Product.php";
class Book extends Product
{
    protected $weight;

    public function getWeight() {
        return $this->weight;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }


    public function save()
    {
        $query = $query = "INSERT INTO products (sku, name, price, productType, weight) VALUES (?, ?, ?, ?, ?)";
        $binder=array("ssisi", $this->getSku(), $this->getName(), $this->getPrice(),$this->getProductType(), $this->getWeight());

        // Execute the query
        return $this->create($query,$binder);
    }
}


?>