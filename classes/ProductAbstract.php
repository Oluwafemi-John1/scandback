<?php
require "config.php";
abstract class ProductAbstract extends Config
{
    protected $sku;
    protected $name;
    protected $price;
    protected $productType;

    public function __construct($sku, $name, $price, $productType)
    {
        Parent::__construct();
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->productType = $productType;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getProductType()
    {
        return $this->productType;
    }

    public function setProductType($productType)
    {
        $this->productType = $productType;
    }

    abstract public function save();
    abstract public function getProductData();
    abstract public function deleteProduct();
}
