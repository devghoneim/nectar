<?php

namespace App\Repository\Interface;

interface UserRepositoryInterface
{
    public function create($data);
    public function checkPhone($phone);
}
