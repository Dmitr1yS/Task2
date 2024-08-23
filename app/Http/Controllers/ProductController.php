<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    private $validCategories = [
        'laptops',
        'mobile-accessories',
        'smartphones',
        'tablets',
    ];

    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            // Получение всех продуктов из базы данных
            $products = Product::all();
            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function fetchAndSave(): \Illuminate\Http\JsonResponse
    {
        try {
            $responseData = [
                'Apple',
                'Macbook',
                'iPhone',
                'iPad',
            ];

            $savedProducts = []; // Переменная для хранения всех сохраненных продуктов

            foreach ($responseData as $query) {
                $response = Http::withoutVerifying()->get("https://dummyjson.com/products/search?q={$query}");
                $data = $response->json();

                if (isset($data['products'])) {
                    $savedProducts = array_merge($savedProducts, $this->processProducts($data['products']));
                }
            }

            // Возвращение объединенного ответа
            return response()->json([
                'message' => 'Products have been saved or updated successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function processProducts(array $products): array
    {
        $savedProducts = [];

        foreach ($products as $item) {
            // Проверка, принадлежит ли продукт к допустимым категориям
            if (in_array($item['category'], $this->validCategories)) {
                $savedProduct = Product::updateOrCreate(
                    ['title' => $item['title']], // Уникальный ключ - название продукта
                    [
                        'description' => $item['description'],
                        'price' => $item['price'],
                        'category' => $item['category']
                    ]
                );

                $savedProducts[] = $savedProduct;
            }
        }

        return $savedProducts;
    }
}
