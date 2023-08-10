<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{

    public function allVendor();

    public function allUser();

    public function viewDetail($id);

}

