<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Helpers\WrapperResponse;

define('SUCCESS', 'Successfully Get Data Product');

class ProductController extends Controller
{
    //
    public function all(Request $request) {
        $id = $request->input('id');
        $limit = $request->input('limit');
        $name = $request->input('name');
        $description = $request->input('description');
        $tags = $request->input('tags');
        $categories = $request->input('categories');
        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');

        $product = Product::with(['category', 'galleries']);
        if ($id) {
            $product = $product->find($id);
            if ($product) {
                return WrapperResponse::success($product, SUCCESS);
            }
            return WrapperResponse::error(null, 'Failed to find Data Product', 404);
        }
        if ($name) {
            $product->where('name', 'like', '%'.$name.'%');
        }
        if ($description) {
            $product->where('description', 'like', '%'.$description.'%');
        }
        if ($tags) {
            $product->where('tags', 'like', '%'.$tags.'%');
        }
        if ($price_from) {
            $product->where('price_from', '>=', $price_from);
        }
        if ($price_to) {
            $product->where('price_to', '<=', $price_to);
        }
        if ($categories) {
            $product->where('categories', $categories);
        }
        return WrapperResponse::success($product->paginate($limit), SUCCESS);
    }
}
