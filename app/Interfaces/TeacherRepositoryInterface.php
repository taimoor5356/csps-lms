<?php

namespace App\Interfaces;

interface TeacherRepositoryInterface 
{
    public function showTableData($request, $data, $trashed);
    public function index($request);
    public function create();
    public function show($id);
    public function destroy($id);
    public function store(array $teacherDetails);
    public function edit($id);
    public function update($request, $id);
    public function trashed($request);
    public function restore($id);
    public function getFulfilledTeacher();
}