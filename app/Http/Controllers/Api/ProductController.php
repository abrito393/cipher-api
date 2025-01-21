<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     title="API de Productos",
 *     version="1.0.0",
 *     description="Documentación de la API para gestionar productos y sus precios",
 *     @OA\Contact(
 *         email="abritodev@gmail.com"
 *     )
 * )
 * 
 * @OA\PathItem(
 *     path="/api/products",
 *     description="Rutas relacionadas con productos"
 * )
 */
class ProductController extends BaseController
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Obtener todos los productos.
     * 
     * @OA\Get(
     *     path="/api/products",
     *     tags={"Productos"},
     *     summary="Obtener todos los productos",
     *     description="Devuelve una lista de todos los productos disponibles",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de productos obtenida correctamente",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Producto A"),
     *                 @OA\Property(property="price", type="number", example=99.99)
     *             )
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $products = $this->productService->getAll();
        return response()->json($products, 200);
    }
    /**
     * Crear un nuevo producto.
     * 
     * @OA\Post(
     *     path="/api/products",
     *     tags={"Productos"},
     *     summary="Crear un producto",
     *     description="Crea un nuevo producto con los datos proporcionados",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string", example="Producto A"),
     *             @OA\Property(property="description", type="string", example="Descripción del producto"),
     *             @OA\Property(property="price", type="number", example=99.99),
     *             @OA\Property(property="currency_id", type="integer", example=1),
     *             @OA\Property(property="tax_cost", type="number", example=10.00),
     *             @OA\Property(property="manufacturing_cost", type="number", example=50.00)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Producto creado correctamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Producto A")
     *         )
     *     )
     * )
     */
    public function store(CreateProductRequest $request): JsonResponse
    {
        $product = $this->productService->create($request->validated());
        return response()->json($product, 201);
    }

    /**
     * Obtener un producto por ID.
     * 
     * @OA\Get(
     *     path="/api/products/{id}",
     *     tags={"Productos"},
     *     summary="Obtener un producto",
     *     description="Devuelve los datos de un producto específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del producto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Producto obtenido correctamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Producto A"),
     *             @OA\Property(property="price", type="number", example=99.99)
     *         )
     *     )
     * )
     */
    public function show($id): JsonResponse
    {
        $product = $this->productService->getById($id);
        return response()->json($product, 200);
    }

    /**
     * Actualizar un producto por ID.
     * 
     * @OA\Put(
     *     path="/api/products/{id}",
     *     tags={"Productos"},
     *     summary="Actualizar un producto",
     *     description="Actualiza los datos de un producto existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del producto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string", example="Producto A"),
     *             @OA\Property(property="price", type="number", example=99.99),
     *             @OA\Property(property="description", type="string", example="Descripción actualizada")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Producto actualizado correctamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Producto A Actualizado")
     *         )
     *     )
     * )
     */
    public function update(UpdateProductRequest $request, $id): JsonResponse
    {
        $product = $this->productService->update($id, $request->validated());
        return response()->json($product, 200);
    }

    /**
     * Eliminar un producto por ID.
     * 
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     tags={"Productos"},
     *     summary="Eliminar un producto",
     *     description="Elimina un producto existente por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del producto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Producto eliminado correctamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Product deleted successfully")
     *         )
     *     )
     * )
     */
    public function destroy($id): JsonResponse
    {
        $this->productService->delete($id);
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
