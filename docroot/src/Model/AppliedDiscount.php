<?php
namespace App\Model;

use App\Services\API\APIModelConverter;

class AppliedDiscount extends BaseModel implements APIModelInterface {
    protected $original;
    protected $final;
    protected $discountPercentage;
    protected $currency = DiscountModel::DEFAULT_CURRENCY;

    /**
     * @return mixed
     */
    public function getOriginal()
    {
        return $this->original;
    }

    /**
     * @param mixed $original
     */
    public function setOriginal($original): void
    {
        $this->original = $original;
    }

    /**
     * @return mixed
     */
    public function getFinal()
    {
        return $this->final;
    }

    /**
     * @param mixed $final
     */
    public function setFinal($final): void
    {
        $this->final = $final;
    }

    /**
     * @return mixed
     */
    public function getDiscountPercentage()
    {
        return $this->discountPercentage;
    }

    /**
     * @param mixed $discountPercentage
     */
    public function setDiscountPercentage($discountPercentage): void
    {
        $this->discountPercentage = $discountPercentage;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency): void
    {
        $this->currency = $currency;
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