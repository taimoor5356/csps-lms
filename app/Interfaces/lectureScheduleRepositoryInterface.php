<?php

namespace App\Interfaces;

interface LectureScheduleRepositoryInterface 
{
    public function index($request);
    public function create();
    public function store($request, $courseId);
    public function show($request);
    public function edit($request);
    public function update($request, $id);
}
//