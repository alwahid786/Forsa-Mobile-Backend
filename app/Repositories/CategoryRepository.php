<?php

namespace App\Repositories;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\Size;
use Carbon\Carbon;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function saveBrand($request)
    {
        $file = $request->file('brand_image');

        $fileName = time() . '_' . $file->getClientOriginalName();

        $file->move(public_path('brand'), $fileName);

        $addBrand = Brand::create([
            'brand_name' =>  $request->brand_name,
            'brand_image' =>  url('public/brand/') . '/' . $fileName,
        ]);

        if ($addBrand)
        {

            return true;

        } else {

            return false;

        }
    }

    public function getBrand()
    {
        $allBrand = Brand::orderBy('created_at', 'desc')->get();
        return $allBrand;
    }

    public function deleteBrand($id)
    {
        $deleteBrand = Brand::where('id', $id)->delete();

        if ($deleteBrand)
        {

            return true;

        } else {

            return false;

        }
    }

    public function editBrandData($id)
    {
        $query = Brand::where('id', $id)->first();

        return $query;
    }

    public function editBrand($request)
    {
        $file = $request->file('brand_image');

        if($file && !empty($file))
        {

            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('brand'), $fileName);

            $updatebrand = Brand::where('id', $request->brand_id)->update([
                'brand_name' =>  $request->brand_name,
                'brand_image' =>  url('public/brand/') . '/' . $fileName
            ]);

        } else {

            $updatebrand = Brand::where('id', $request->brand_id)->update([
                'brand_name' => $request->brand_name
            ]);

        }


        if($updatebrand)
        {
            return true;
        } else {
            return false;
        }
    }

    public function saveCategory($request)
    {

        $file = $request->file('category_image');

        $fileName = time() . '_' . $file->getClientOriginalName();

        $file->move(public_path('category'), $fileName);

        $addCategory = Category::create([
            'category_name' =>  $request->category_name,
            'category_image' =>  url('public/category/') . '/' . $fileName,
            'parent_id' => NULL,
        ]);

        if ($addCategory)
        {

            return true;

        } else {

            return false;

        }
    }

    public function getcategory()
    {
        $allCategory = Category::orderBy('created_at', 'desc')->get();
        return $allCategory;
    }

    public function deletecategory($id)
    {
        $deleteCategory = Category::where('id', $id)->delete();

        if ($deleteCategory)
        {

            return true;

        } else {

            return false;

        }
    }
    public function deletebanner($id)
    {
        $deleteCategory = Banner::where('id', $id)->delete();

        if ($deleteCategory)
        {

            return true;

        } else {

            return false;

        }
    }

    public function editCategoryData($id)
    {

        $query = Category::where('id', $id)->with('parentCategory')->first();

        // dd($query->name->category_name);

        return $query;

    }
    public function editbannerData($id)
    {
        $query = Banner::where('id', $id)->first();

        return $query;

    }

    public function editcategory($request)
    {

        $file = $request->file('category_image');

        if($file && !empty($file))
        {

            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('category'), $fileName);

            $updateCategory = Category::where('id', $request->category_id)->update([
                'category_name' =>  $request->category_name,
                'category_image' =>  url('public/category/') . '/' . $fileName,
                'parent_id' => NULL,
            ]);

        } else {

            $updateCategory = Category::where('id', $request->category_id)->update([
                'category_name' => $request->category_name,
                'parent_id' => null,
            ]);

        }


        if($updateCategory)
        {
            return true;
        } else {
            return false;
        }



    }

    public function editsubcategory($request)
    {
        $file = $request->file('category_image');

        if($file && !empty($file))
        {

            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('category'), $fileName);

            $updateCategory = Category::where('id', $request->category_id)->update([
                'category_name' =>  $request->category_name,
                'parent_id' =>  $request->selected_category_id,
                'category_image' =>  url('public/category/') . '/' . $fileName,

            ]);

        } else {

            $updateCategory = Category::where('id', $request->category_id)->update([
                'parent_id' => $request->selected_category_id,
                'category_name' =>  $request->category_name,

            ]);

        }


        if($updateCategory)
        {
            return true;
        } else {
            return false;
        }



    }




      public function saveSubcategory( $request)
    {

        $file = $request->file('category_image');

        $fileName = time() . '_' . $file->getClientOriginalName();

        $file->move(public_path('category'), $fileName);

        $selectedCategoryId = $request->selected_category_id;

        $addCategory = Category::create([
            'category_name' =>  $request->category_name,
            'category_image' =>  url('public/category/') . '/' . $fileName,
            'parent_id' =>  $selectedCategoryId,
        ]);

        if ($addCategory)
        {

            return true;

        } else {

            return false;

        }
    }
    public function savebanner( $request)
    {

        $file = $request->file('banner_image');

        $fileName = time() . '_' . $file->getClientOriginalName();

      $file->move(public_path('category'), $fileName);

        $addbanner = Banner::create([
            'banner_image' =>  url('public/category/') . '/' . $fileName,
        ]);

        if ($addbanner)
        {

            return true;

        } else {

            return false;

        }
    }

      public function getbanner()
    {
        $banner = Banner::all();
        return $banner;
    }
     public function getsize()
    {
        $size = Size::orderBy('created_at', 'desc')->with('category')->get();

        return $size;
    }
    public function editbanner($request)

    {
        $file = $request->file('category_image');


        {

            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('category'), $fileName);

            $updateCategory = Banner::where('id', $request->category_id)->update([
                'banner_image' =>  url('public/category/') . '/' . $fileName,

            ]);

        }


        if($updateCategory)
        {
            return true;
        } else {
            return false;
        }

    }

    public function deleteSize($id)
    {
        $query = Size::where('id', $id)->delete();
        return $query;
    }

    public function getSizeData($id)
    {
        $query = Size::with('category')->where('id', $id)->first();
        return $query;
    }

    public function editSize($request)
    {
        $query = Size::where('id', $request->id)->update([
            'category_id' => $request->category_id,
            'size' => $request->title,
        ]);

        return $query;
    }
}
