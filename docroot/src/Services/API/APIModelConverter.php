<?php
namespace App\Services\API;

use App\Model\APIModelInterface;

class APIModelConverter {
    public static function convertSingle(APIModelInterface $model):array {
        return $model->toArray();
    }

    public static function convertMultiple(array $models) {
        $converted = [];
        foreach ($models as $model) {
            $converted[] = self::convertSingle($model);
        }

        return $converted;
    }
}