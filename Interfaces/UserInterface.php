<?php

namespace App\Interfaces;

interface UserInterface {
    public function all();
    public function store(array $data);
    public function edit($id);
    public function update($id,array $data);
    public function delete($id);
}
