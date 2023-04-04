<?php
require "Product.php";
class DVD extends Product {
    protected $size;

    public function getSize() {
        return $this->size;
    }

    public function setSize($size) {
        $this->size = $size;
    }

    public function save() {
        $query = "INSERT INTO products (sku, name, price, productType, size) VALUES (?, ?, ?, ?, ?)";

        // Set the parameters using getters
        $binder=array("ssisi", $this->getSku(), $this->getName(), $this->getPrice(),$this->getProductType(), $this->getSize());

        // Execute the query
        return $this->create($query,$binder);
    }
}
?>