<?php
namespace App\Services\Repository;

class ProductRepository extends BaseRepository {

    public function getAll(array $filters = []): bool|array
    {
        $query = 'SELECT * FROM product';

        if (!empty($filters)) {
            $where = [];
            $params = [];
            if (isset($filters['price'])) {
                $where[] = "price = %p1";
                $params['p1'] = $filters['price'];
            }

            if (isset($filters['priceLowerThen'])) {
                $where[] = "price >= %p2";
                $params['p2'] = $filters['priceLowerThen'];
            }

            if (!empty($where)) {
                $query .= " WHERE " . implode(' AND ', $where);
            }
            $stm = $this->connection->prepare($query, $params);
        }
        else {
            $stm = $this->connection->prepare($query);
        }
        
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getSingle($id)
    {
        // TODO: Implement getSingle() method.
    }

    public function update($id, array $values)
    {
        // TODO: Implement update() method.
    }
}