<?php

namespace App\Interfaces;

interface ApplicationInterface
{
    public function index($data, $page);
	public function getById($id, $user = null);
	public function store(array $data);
	public function update(array $data,$id);
    public function delete($id);
}
