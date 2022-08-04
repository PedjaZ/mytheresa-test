<?php
namespace App\Model;

class BaseModel implements ModelInterface {

    /**
     * @throws \Exception
     */
    public function __construct(array $values = []) {
        $this->fillOutValues($values);
    }

    public function fillOutValues(array $values)
    {
        foreach ($values as $property => $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
            else {
                throw new \Exception(sprintf('Property: %s does not exist on the model: %s', $property, get_class($this)));
            }
        }
    }


}