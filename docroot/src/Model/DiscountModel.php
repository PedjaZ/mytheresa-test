<?php
namespace App\Model;

class DiscountModel extends BaseModel {
    public const DEFAULT_CURRENCY = 'EUR';
    protected $percent;
    protected int $id;

    /**
     * @return mixed
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * @param mixed $percent
     */
    public function setPercent($percent): void
    {
        $this->percent = $percent;
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

}