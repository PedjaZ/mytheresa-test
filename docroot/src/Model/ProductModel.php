<?php
namespace App\Model;

class ProductModel extends BaseModel implements APIModelInterface {
    protected int $id;
    protected $sku;
    protected $name;
    protected $category;
    protected $price;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
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
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param mixed $sku
     */
    public function setSku($sku): void
    {
        $this->sku = $sku;
    }

    public function toArray(): array
    {
        $return = [];

        foreach ($this as $key => $value) {
            if (is_object($value)) {
                if (isset(class_implements($value::class)[APIModelInterface::class])) {
                    $return[$key] = $value->toArray();
                }
                else {
                    $return[$key] = serialize($value);
                }
            }
            else {
                $return[$key] = $value;
            }
        }

        return $return;
    }

    public function toJson(): string
    {
        // TODO: Implement toJson() method.
    }
}