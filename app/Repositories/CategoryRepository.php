<?php

namespace App\Repositories;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Carbon\Carbon;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function saveCategory($request)
    {

        $file = $request->file('category_image');

        $fileName = time() . '_' . $file->getClientOriginalName();

        $file->move(public_path('category'), $fileName);

        $addCategory = Category::create([
            'category_name' =>  $request->category_name,
            'category_image' =>  $fileName,
            'parent_id' => NULL,
        ]);

        if ($addCategory)
        {

            return true;

        } else {

            return false;

        }
    }
    //haider dev
        public function saveSubcategory( $request)
    {

        $file = $request->file('category_image');

        $fileName = time() . '_' . $file->getClientOriginalName();

        $file->move(public_path('category'), $fileName);
    
        $selectedCategoryId = $request->selected_category_id;
        
        $addCategory = Category::create([
            'category_name' =>  $request->category_name,
            'category_image' =>  $fileName,
            'parent_id' =>  $selectedCategoryId,
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
        $allCategory = Category::all();
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

    public function editCategoryData($id)
    {

        $query = Category::where('id', $id)->first();

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
                'category_image' =>  $fileName,
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

}
