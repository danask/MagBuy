<?php


namespace model;

// can also be named as Subcategory Specification Value per Product
class ProductSpecification
{
    private $id;
    private $value;
    private $subcatSpecId;
    private $productId;

    /**
     * ProductSpecification constructor.
     * @param $value
     * @param $subcatSpecId
     */
    public function __construct($value, $subcatSpecId)
    {
        $this->value = $value;
        $this->subcatSpecId = $subcatSpecId;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getSubcatSpecId()
    {
        return $this->subcatSpecId;
    }

    /**
     * @param mixed $subcatSpecId
     */
    public function setSubcatSpecId($subcatSpecId)
    {
        $this->subcatSpecId = $subcatSpecId;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param mixed $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }
}