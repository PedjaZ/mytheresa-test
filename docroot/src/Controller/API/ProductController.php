<?php
namespace App\Controller\API;

use App\Controller\BaseController;
use App\Model\APIModelInterface;
use App\Services\API\APIModelConverter;
use App\Services\Repository\ProductRepository;
use App\Services\Routing\RouteTypes\GetRoute;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends BaseController implements APIControllerInterface {

    protected ProductRepository $productRepository;

    public function __construct() {
        $this->productRepository = new ProductRepository();
    }

    #[GetRoute('getAllProducts', '/product')]
    public function getAll(Request $request)
    {
        $return = [];

        $pagination = $this->handlePagination($request);

        $filters = $this->createBasicFilterValues($request->query->all());
        $result = APIModelConverter::convertMultiple($this->productRepository->getAll($filters, $pagination['offset'], $pagination['limit']));

        return new JsonResponse($result);
    }

    public function createMultiple(Request $request)
    {
        // TODO: Implement createMultiple() method.
    }

    public function update(Request $request)
    {
        // TODO: Implement update() method.
    }

    public function getSingle(Request $request)
    {
        // TODO: Implement getSingle() method.
    }
}