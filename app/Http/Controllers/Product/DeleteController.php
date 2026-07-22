<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    public function __invoke(Product $product)
    {
        if ($product->preview_image && Storage::disk('public')->exists($product->preview_image)) {
            Storage::disk('public')->delete($product->preview_image);
        }

        foreach ($product->productImages as $productImage) {
            if (Storage::disk('public')->exists($productImage->file_path)) {
                Storage::disk('public')->delete($productImage->file_path);
            }

            $productImage->delete();
        }

        $product->tags()->detach();
        $product->colors()->detach();

        $product->delete();

        return redirect()->route('product.index');
    }
}
