<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;

abstract class BaseController {

    public const DEFAULT_NUMBER_PER_PAGE = 5;
    public const MAX_RESULTS_PER_PAGE = 5;

    /**
     * @param Request $request
     * @return array
     */
    public function handlePagination(Request $request): array
    {
        $page = $request->query->get('page') ? $request->query->get('page') : 0;
        $limit = $request->query->get('limit') ? $request->query->get('limit') : self::DEFAULT_NUMBER_PER_PAGE;
        $offset = 0;

        if ($limit > self::MAX_RESULTS_PER_PAGE) {
            throw new \Exception("The maximum number of result per page is 4! Please use a smaller number for max results.");
        }

        if ($page > 0) {
            $offset += $limit * $page;
        }

        return [
            'limit' => $limit,
            'offset' => $offset,
        ];
    }

    /**
     * @param array $rawFilters
     * @return array
     */
    public function createBasicFilterValues(array $rawFilters): array
    {
        $filters = [];

        foreach ($rawFilters as $key => $value) {
            if ($key != 'page' && $key != 'limit') {
                if (strpos($value, ',') !== false) {
                    $value = explode(',', $value);
                }

                if ($value === 'null'){

                    $filters[$key] = null;
                    continue;
                }

                if ($value !== '') {
                    $filters[$key] = $value;
                }
            }
        }

        return $filters;
    }
}