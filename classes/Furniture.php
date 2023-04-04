<?php
class Furniture extends Product
{
    protected $height;
    protected $length;
    protected $width;

    public function getHeight() {
        return $this->height;
    }

    public function setHeight($height) {
        $this->height = $height;
    }

    public function getLength() {
        return $this->length;
    }

    public function setLength($length) {
        $this->length = $length;
    }

    public function getWidth() {
        return $this->width;
    }

    public function setWidth($width) {
        $this->width = $width;
    }

    public function save()
    {
        $query = $query = "INSERT INTO products (sku, name, price, productType, height, width, length) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $binder=array("ssisi", $this->getSku(), $this->getName(), $this->getPrice(),$this->getProductType(), $this->getHeight(), $this->getWidth(), $this->getLength());

        // Execute the query
        return $this->create($query,$binder);
    }
}
