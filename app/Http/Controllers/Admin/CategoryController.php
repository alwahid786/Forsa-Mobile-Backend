<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Size;

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
      public function deletebanner(Request $request)
    {

        $id = $request->category_id;

        $deletecategory = $this->category->deletebanner($id);

        if($deletecategory == true)
        {
            return redirect()->back()->with('error', 'Delete banner Successfully.');
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
        public function editbannerData(Request $request)
    {
        $id = $request->id;

        $editbanner = $this->category->editbannerData($id);

        return response()->json([
            'status' => 'success',
            'data' => $editbanner,
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
        public function editsubcategory(Request $request)
    {
        $result = $this->category->editsubcategory($request);

        if($result == true) {
            return redirect()->back()->with('success', 'Update SubCategory Successfully.');
        }

    }
    public function subcategory(Request $request)
    {

        if($request->isMethod('post'))
        {
            $result = $this->category->saveSubcategory($request);

            if($result == true)
            {
                return redirect()->back()->with('success', 'Add SubCategory Successfully.');

            } else {

                return redirect()->back()->with('error', 'Add SubCategory Failed.');
            }
        }

        $allCategory = $this->category->getcategory();

        return view('pages.admin.category.SubCategory', ['category' => $allCategory]);

    }
      public function banner(Request $request)
    {
         if($request->isMethod('post'))
        {
            $result = $this->category->savebanner($request);

            if($result == true)
            {
                return redirect()->back()->with('success', 'Add banner Successfully.');

            } else {

                return redirect()->back()->with('error', 'Add banner Failed.');
            }
        }

        $banner = $this->category->getbanner();
        return view('pages.admin.category.Banner', ['banner' => $banner ]);

    }
            public function editbanner(Request $request)
    {
        $result = $this->category->editbanner($request);

        if($result == true) {
            return redirect()->back()->with('success', 'Update banner Successfully.');
        }

    }

 public function size(Request $request)
    {
         
        if($request->isMethod('post'))
        {
            $result = $this->category->savesize($request);
            
            if($result == true)
            {
                return redirect()->back()->with('success', 'Add Size Successfully.');

            } else {
                
                return redirect()->back()->with('error', 'Add Size Failed.');
            }
        }

        
        $allCategory = $this->category->getcategory(); 
        $allsize = $this->category->getsize(); 
        return view('pages.admin.category.Size' ,['category' => $allCategory , 'size'=> $allsize] );
}
public function addsize(Request $request)
    {
        $size = new Size();
        $size->size = $request->title;
        $size->category_id = $request->category_id;
        $success = $size->save();
        return redirect()->back()->with('success', 'Add Size Successfully.');
    }
}