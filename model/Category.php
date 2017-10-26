<?php


namespace model;


class Category
{
    private $id;
    private $name;
    private $supercategory_id;

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getSupercategoryId()
    {
        return $this->supercategory_id;
    }

    /**
     * @param mixed $supercategory_id
     */
    public function setSupercategoryId($supercategory_id)
    {
        $this->supercategory_id = $supercategory_id;
    }


}