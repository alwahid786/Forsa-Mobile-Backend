<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    private $category;

    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->category = $category;
    }

    /**
     * add category
     *
     * @return \Illuminate\Http\Response
    */

    public function category(Request $request)
    {

        if($request->isMethod('post'))
        {
            $result = $this->category->saveCategory($request);

            if($result == true)
            {
                return redirect()->back()->with('success', 'Add Category Successfully.');

            } else {

                return redirect()->back()->with('error', 'Add Category Failed.');
            }
        }

        $allCategory = $this->category->getcategory();

        return view('pages.admin.category.category', ['category' => $allCategory]);

    }

    /**
     * delete category
     *
     * @return \Illuminate\Http\Response
    */

    public function deleteCategory(Request $request)
    {

        $id = $request->category_id;

        $deletecategory = $this->category->deletecategory($id);

        if($deletecategory == true)
        {
            return redirect()->back()->with('error', 'Delete Category Successfully.');
        }

    }

    /**
     * edit category
     *
     * @return \Illuminate\Http\Response
    */

    public function editCategoryData(Request $request)
    {

        $id = $request->id;

        $editCategory = $this->category->editCategoryData($id);

        return response()->json([
            'status' => 'success',
            'data' => $editCategory,
            'message' => 'category data!'
        ], 200);

    }

    public function editCategory(Request $request)
    {

        $result = $this->category->editcategory($request);

        if($result == true) {
            return redirect()->back()->with('success', 'Update Category Successfully.');
        }

    }

}
