<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{

    public function saveBrand($request);

    public function getBrand();

    public function deleteBrand($id);

    public function editBrandData($id);

    public function editBrand($request);

    public function saveCategory($request);

    public function getcategory();

    public function deletecategory($id);

    public function deletebanner($id);

    public function editCategoryData($id);

    public function editcategory($request);

    public function editsubcategory($request);

    public function editbanner($request);

    public function editbannerData($id);

    public function saveSubcategory($request);

    public function savebanner($request);

    public function getbanner();

    public function getsize();

    public function deleteSize($id);

    public function getSizeData($id);

    public function editSize($request);

}
