<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        if (isset($data['preview_image'])) {
            Storage::disk('public')->delete($product->preview_image);
            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
        }

        $tagsIds = $data['tags'] ?? [];
        $colorsIds = $data['colors'] ?? [];
        $productImages = $data['product_images'] ?? [];

        unset($data['tags'], $data['colors'], $data['product_images']);

        $product->update($data);

        $product->tags()->sync($tagsIds);
        $product->colors()->sync($colorsIds);

        if (!empty($productImages)) {
            foreach ($product->productImages as $oldImage) {
                if (Storage::disk('public')->exists($oldImage->file_path)) {
                    Storage::disk('public')->delete($oldImage->file_path);
                }

                $oldImage->delete();
            }

            foreach ($productImages as $productImage) {
                if (!$productImage) {
                    continue;
                }

                $filePath = Storage::disk('public')->put('/images', $productImage);

                ProductImage::create([
                    'product_id' => $product->id,
                    'file_path' => $filePath,
                ]);
            }
        }

        return redirect()->route('product.show', $product);
    }
}
