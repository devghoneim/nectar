<?php

namespace App\Repository\Interface;


interface LocationRepositoryInterface
{

    public function getAll();
    public function create($data);
    public function edit($id);
    public function update($data);
    public function delete($id);
    public function findById($id);





}