<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class ProductController extends BaseController
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        $this->middleware('auth:sanctum', ['except' => ['index', 'show', 'store','update','destroy']]);
    }

    public function index(): JsonResponse
    {
        $products = $this->productService->getAll();
        return response()->json($products, 200);
    }

    public function store(CreateProductRequest $request): JsonResponse
    {
        $product = $this->productService->create($request->validated());
        return response()->json($product, 201);
    }

    public function show($id): JsonResponse
    {
        $product = $this->productService->getById($id);
        return response()->json($product, 200);
    }

    public function update(UpdateProductRequest $request, $id): JsonResponse
    {
        $product = $this->productService->update($id, $request->validated());
        return response()->json($product, 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->productService->delete($id);
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
