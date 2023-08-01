<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{

    public function saveCategory($request);

    public function getcategory();

    public function deletecategory($id);

}
