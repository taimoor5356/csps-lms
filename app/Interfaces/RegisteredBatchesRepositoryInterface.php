<?php

namespace App\Interfaces;

interface RegisteredBatchesRepositoryInterface 
{
    public function showTableData($data, $trashed);
    public function index($request);
    public function create();
    public function store(array $studentDetails);
    public function show($id);
    public function destroy($id);
    public function edit($id);
    public function update($request);
}