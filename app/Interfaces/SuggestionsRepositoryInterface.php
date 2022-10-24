<?php

namespace App\Interfaces;

interface SuggestionsRepositoryInterface 
{
    public function showTableData($data, $trashed);
    public function index($request);
    public function create();
    public function show($id);
    public function destroy($id);
    public function store(array $studentDetails);
    public function edit($id);
    public function update($request, $id);
    public function trashed($request);
    public function restore($id);
    public function getFulfilledSuggestions();
}