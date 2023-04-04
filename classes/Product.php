<?php

require "ProductAbstract.php";
class Product extends ProductAbstract
{
    protected $size;
    protected $length;
    protected $weight;
    protected $height;
    protected $width;
    public function __construct($sku, $name, $price, $productType, $size = null,  $weight = null, $height = null, $width = null,$length = null)
    {
        parent::__construct($sku, $name, $price, $productType);

        $this->size = $size;
        $this->length = $length;
        $this->weight = $weight;
        $this->height = $height;
        $this->width = $width;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function setLength($length)
    {
        $this->length = $length;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function save()
    {
        // Prepare the query
        $query = "INSERT INTO Products (sku, name, price, productType, size, weight, height, width, length) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Set the parameters
        $binder = array("ssisiiiii", $this->getSku(), $this->getName(), $this->getPrice(), $this->getProductType(), $this->getSize(), $this->getWeight(), $this->getHeight(), $this->getWidth(), $this->getLength());

        return $this->create($query, $binder);
    }

    public function getProductData()
    {
        // Prepare the query
        $query = "SELECT * FROM Products ORDER By ProductID DESC";
        $binder = null;

        // $product = new self();
        return $this->read($query, $binder);
    }
    public function deleteProduct(){
        $query = "DELETE FROM Products WHERE sku = ?";
        $binder = array("s",$this->getSku());
        return $this->delete($query,$binder);
    }

}
