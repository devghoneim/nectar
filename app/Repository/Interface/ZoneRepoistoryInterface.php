<?php

namespace App\Repository\Interface;

interface ZoneRepoistoryInterface
{

    public function getAll();
    public function create($data);
    public function edit($id);
    public function update($data);
    public function delete($id);

}