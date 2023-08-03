<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{

    public function saveCategory($request);

    
    public function getcategory();
    
    public function deletecategory($id);
<<<<<<< Updated upstream

    public function editCategoryData($id);

    public function editcategory($request);
=======
    
    public function editCategory($id);
>>>>>>> Stashed changes


    // haider_dev
    
    public function saveSubcategory($request);
}
