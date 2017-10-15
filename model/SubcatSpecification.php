<?php


namespace model;


class SubcatSpecification
{
    private $id;
    private $name;
    private $subcategory_id;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSubcategoryId()
    {
        return $this->subcategory_id;
    }

    /**
     * @param mixed $subcategory_id
     */
    public function setSubcategoryId($subcategory_id)
    {
        $this->subcategory_id = $subcategory_id;
    }


}