<?php
namespace App\Services\Repository;

use App\Controller\BaseController;
use App\Model\AppliedDiscount;
use App\Model\ProductModel;
use App\Services\Discount\DiscountCalculator;

class ProductRepository extends BaseRepository {

    public function getAll(array $filters = [], $page = null, $limit = BaseController::DEFAULT_NUMBER_PER_PAGE): bool|array
    {
        $query = 'SELECT p.*, (SELECT MAX(d.percent) FROM discount AS d WHERE d.value = p.category OR d.value = p.sku) as percent FROM product AS p ';

        $params = [];
        
        if (!empty($filters)) {
            $where = [];
            if (isset($filters['category'])) {
                $where[] = "p.category = :cat";
                $params['cat'] = $filters['category'];
            }

            if (isset($filters['priceLessThan'])) {
                $where[] = "p.price > :p";
                $params['p'] = $filters['priceLessThan'];
            }

            if (!empty($where)) {
                $query .= " WHERE " . implode(' AND ', $where);
            }
        }

        if ($limit) {
            $query .= ' LIMIT ' . $limit . " ";
        }

        if ($page) {
            $query .= " OFFSET $page ";
        }

        $stm = $this->connection->prepare($query);
        $stm->execute($params);

        $result = [];

        foreach ($stm->fetchAll(\PDO::FETCH_ASSOC) as $product) {
            $product['price'] = $this->getDiscountPrice($product);

            unset($product['percent']);
            $result[] = new ProductModel($product);
        }

        return $result;
    }

    public function getSingle($id): ProductModel
    {
        $query = $this->connection->prepare("SELECT product.*, discount.percent FROM product LEFT JOIN discount ON product.category = discount.category WHERE product.id = :s LIMIT 1");
        $query->execute(['s' => $id]);
        $product = $query->fetchAll(\PDO::FETCH_ASSOC);
        $result = null;

        if ($product) {
            $product = $product[0];
            $product['price'] = $this->getDiscountPrice($product);
            unset($product['percent']);
            $result = new ProductModel($product);
        }

        return $result;
    }

    public function update($id, array $values)
    {
        // TODO: Implement update() method.
    }

    protected function getDiscountPrice($product): AppliedDiscount
    {
        if ($product['percent']) {
            $discountPrice = DiscountCalculator::calculateDiscount($product['price'], $product['percent']);
        }
        else {
            $discountPrice = $product['price'];
        }
        return new AppliedDiscount([
            'original' => $product['price'],
            'final' => $discountPrice,
            "discountPercentage" => $product['percent'],
        ]);
    }

}