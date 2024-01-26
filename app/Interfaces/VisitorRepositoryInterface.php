<?php

namespace App\Interfaces;

interface VisitorRepositoryInterface 
{
    public function showTableData($request, $data, $trashed);
    public function index($request);
    public function create();
    public function show($id);
    public function destroy($id);
    public function store(array $lectureDetails);
    public function edit($id);
    public function update($request, $id);
    public function trashed($request);
    public function restore($id);
}