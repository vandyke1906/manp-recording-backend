<?php

namespace App\Interfaces;

interface ApplicationInterface
{
    public function index($data);
	public function getById($id);
	public function store(array $data);
	public function update(array $data,$id);
    public function delete($id);
}
