<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;


class CategoryController extends Controller
{
    use ResponseTrait;

    // Add Category
    public function addCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string',
            'category_image' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        if (isset($request->category_id) && !empty($request->category_id)) {
            $category =  Category::find($request->category_id);
        } else {
            $category = new Category;
        }
        $category->category_name = $request->category_name;
        $category->category_image = $request->category_image;
        if (isset($request->parent_id)) {
            $category->parent_id = $request->parent_id;
        }
        $category->save();

        return $this->sendResponse($category, 'Category added successfully');
    }

    // Get categories List 
    public function categoryList(Request $request)
    {
        if ($request->has('category_id')) {
            $categories = Category::where('id', $request->category_id)->with('parentCategory', 'subCategories', 'size')->get();
        } else {
            $categories = Category::where('parent_id', null)->with('parentCategory', 'subCategories', 'size')->get();
        }
        return $this->sendResponse($categories, 'All Categories list');
    }
}
