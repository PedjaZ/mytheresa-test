<?php
namespace App\Services\Discount;

class DiscountCalculator {
    public static function calculateDiscount($price, $discountPercent) {
        if (!is_numeric($discountPercent)) {
            throw new \Exception("The discount percent must be a number!");
        }

        if ($discountPercent >= 100) {
            throw new \Exception("The discount percent can't be 100 or bigger! Please use a smaller percent.");
        }

        if ($discountPercent <= 0) {
            throw new \Exception("The discount percent can't be 0 or smaller! Please use a bigger percent.");
        }

        if (!is_numeric($price)) {
            throw new \Exception("The price must be a number!");
        }

        return round(($price / 100) * $discountPercent, 2);
    }
}