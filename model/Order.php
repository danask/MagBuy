<?php


namespace model;


class Order
{
    private $id;
    private $user_id;
    private $created_at;
    // STATUS CODES - 1 PROCESSING, 2 ERROR, 3 SENT, 4 FINISHED
    private $status;
    private $products;

    /**
     * Order constructor.
     * @param $user_id
     * @param $products
     */
    public function __construct($user_id, $products)
    {
        $this->id = microtime();
        $this->user_id = $user_id;
        $this->created_at = date("Y-m-d H:i:s");
        $this->status = 1;
        $this->products = $products;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

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
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param mixed $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

}