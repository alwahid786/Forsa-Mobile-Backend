<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Size;


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

    // Create or update the category
    if (isset($request->category_id) && !empty($request->category_id)) {
        $category = Category::find($request->category_id);
    } else {
        $category = new Category;
    }

    $category->category_name = $request->category_name;
    $category->category_image = $request->category_image;

    if (isset($request->parent_id)) {
        $category->parent_id = $request->parent_id;
    }

    $category->save();
    if ($request->has('size') && !empty($request->size)) {
        $size = Size::where('category_id', $category->id)->first();

        if ($size) {
            $size->size = $request->size;
            $size->save();
        } else {
            $newSize = new Size;
            $newSize->size = $request->size;
            $newSize->category_id = $category->id;
            $newSize->save();
        }
    }
    return $this->sendResponse($category, 'Category added/updated successfully with sizes');
}


    // Get categories List
public function categoryList(Request $request)
{
    $categoryName = 'Kidswear'; 

    $query = Category::where('parent_id', null);

    if ($request->has('category_id')) {
        $query->where('id', $request->category_id);
    }

    $categories = $query->with(
        'parentCategory',
        $categoryName === 'Kidswear' 
            ? 'subCategories.subCategories.subCategories' 
            : 'subCategories.thirdCategories.forthCategories'
    )->get();

    return $this->sendResponse($categories, 'All Categories list');
}

}
