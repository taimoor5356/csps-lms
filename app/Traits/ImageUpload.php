<?php

namespace App\Traits;
use Illuminate\Http\Request;

trait ImageUpload{
    public function uploadImage($image, $file, $directory)
    {
        if (isset($image)) {
            if ($image->isValid()) {
                if ($image->getSize() > 500000) {
                    return response()->json(['status' => false]);
                } else {
                    dd('uplod');
                    $image->move($directory, $file);
                }
            }
        }
    }
}