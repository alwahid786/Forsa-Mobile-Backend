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

}
