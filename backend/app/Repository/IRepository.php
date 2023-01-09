<?php

namespace App\Repository;

interface IRepository
{
    public function All();
    public function Create(array $data);
    public function Update(array $data, $slug);
    public function Delete($slug);
    public function Show($slug);
}
