<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getAll()
    {
        return Product::with('currency')->get();
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function findById($id)
    {
        return Product::with('currency')->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $product = $this->findById($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        $product = $this->findById($id);
        $product->delete();
        return true;
    }
}