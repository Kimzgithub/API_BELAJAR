<?php
 
namespace App\Http\Controllers\Api;
 
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
 
class ProductController extends Controller
{
    // GET: /api/products
    public function index()
    {
        return ProductResource::collection(Product::latest()->paginate(10));
    }
 
    // POST: /api/products
    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = Product::create($request->validated());
 
        return (new ProductResource($product))
            ->response()
            ->setStatusCode(201);
    }
 
    // GET: /api/products/{product}
    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }
 
    // PUT/PATCH: /api/products/{product}
    public function update(UpdateProductRequest $request, Product $product): ProductResource
    {
        $product->update($request->validated());
 
        return new ProductResource($product);
    }
 
    // DELETE: /api/products/{product}
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
 
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
