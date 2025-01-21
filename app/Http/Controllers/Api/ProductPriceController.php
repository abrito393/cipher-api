<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductPriceRequest;
use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ProductPriceController extends Controller
{

    /**
     * Obtener precios de un producto.
     *
     * @OA\Get(
     *     path="/api/products/{id}/prices",
     *     tags={"Precios de Productos"},
     *     summary="Obtener precios de un producto",
     *     description="Devuelve todos los precios asociados a un producto.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del producto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de precios obtenida correctamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="product", type="string", example="Producto A"),
     *             @OA\Property(
     *                 property="prices",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="currency", type="string", example="USD"),
     *                     @OA\Property(property="price", type="number", example=50.75)
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index(Product $product): JsonResponse
    {
        $prices = $product->productPrices()->with('currency')->get();

        return response()->json([
            'product' => $product->name,
            'prices' => $prices,
        ]);
    }

    /**
     * Crear un nuevo precio para un producto.
     *
     * @OA\Post(
     *     path="/api/products/{id}/prices",
     *     tags={"Precios de Productos"},
     *     summary="Crear un precio para un producto",
     *     description="Crea un nuevo precio asociado a un producto.",
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
     *             @OA\Property(property="currency_id", type="integer", example=1),
     *             @OA\Property(property="price", type="number", example=50.75)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Precio creado correctamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Price created successfully"),
     *             @OA\Property(property="price", type="object",
     *                 @OA\Property(property="currency_id", type="integer", example=1),
     *                 @OA\Property(property="price", type="number", example=50.75)
     *             )
     *         )
     *     )
     * )
     */
    public function store(ProductPriceRequest $request, Product $product): JsonResponse
    {
        $price = $product->productPrices()->create($request->validated());

        return response()->json([
            'message' => 'Price created successfully',
            'price' => $price,
        ], 201);
    }
}
