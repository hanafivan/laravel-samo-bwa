<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Helpers\WrapperResponse;
define('SUCCESS', 'Successfully Get Data Product');

class ProductCategoryController extends Controller
{
    //
    public function all(Request $request) {
        $id = $request->input('id');
        $limit = $request->input('limit');
        $name = $request->input('name');
        $show_product = $request->input('show_product');

        if ($id) {
            $category = ProductCategory::with(['products'])->find($id);
            if ($category) {
                return WrapperResponse::success($category, SUCCESS);
            }
            return WrapperResponse::error(null, 'Failed to find Data Product', 404);
        }

        $category = ProductCategory::query();

        if ($name) {
            $category->where('name', 'like', '%'.$name.'%');
        }

        if ($show_product) {
            $category->with('products');
        }

        return WrapperResponse::success($category->paginate($limit), SUCCESS);
    }
}
