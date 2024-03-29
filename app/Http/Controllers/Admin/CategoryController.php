<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Size;

class CategoryController extends Controller
{

    private $category;

    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->category = $category;
    }

    /**
     * add brands
     *
     * @return \Illuminate\Http\Response
    */

    public function brands(Request $request)
    {
        if($request->isMethod('post'))
        {
            $result = $this->category->saveBrand($request);

            if($result == true)
            {
                return redirect()->back()->with('success', 'Add Brand Successfully.');

            } else {

                return redirect()->back()->with('error', 'Add Brand Failed.');
            }
        }

        $allBrands = $this->category->getBrand();

        return view('pages.admin.brand.brand', ['brands' => $allBrands]);
    }

    public function deleteBrand(Request $request)
    {
        $id = $request->brand_id;

        $deleteBrand = $this->category->deleteBrand($id);

        if($deleteBrand == true)
        {
            return redirect()->back()->with('error', 'Delete brand Successfully.');
        }
    }

    public function editBrandView(Request $request)
    {
        $id = $request->id;

        $editbrand = $this->category->editBrandData($id);

        return response()->json([
            'status' => 'success',
            'data' => $editbrand,
            'message' => 'category data!'
        ], 200);
    }

    public function editBrand(Request $request)
    {
        $result = $this->category->editBrand($request);

        if($result == true) {
            return redirect()->back()->with('success', 'Update Brand Successfully.');
        }
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
            return redirect()->back()->with('success', 'Delete Category Successfully.');
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

        $allCategory = Category::get();

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
        if($request->category_image != null)
        {
            $result = $this->category->editbanner($request);
            if($result == true) {
                return redirect()->back()->with('success', 'Update banner Successfully.');
            }
        } else {
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


        $allCategory = Category::where('parent_id', '=', NULL)->get();
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

    public function deleteSize(Request $request)
    {

        $sizeId =  $request->size_id;

        $deleteSize = $this->category->deleteSize($sizeId);

        return redirect()->back()->with('error', 'Delete Size Successfully.');
    }

    public function getSizeData(Request $request)
    {
        $id = $request->id;

        $sizeData = $this->category->getSizeData($id);

        return response()->json([
            'status' => 'success',
            'data' => $sizeData,
            'message' => 'Size data!'
        ], 200);
    }

    public function editSize(Request $request)
    {
        $result = $this->category->editSize($request);

        if($result)
        {
            return redirect()->back()->with('success', 'Update Size Successfully.');
        }
    }

}
