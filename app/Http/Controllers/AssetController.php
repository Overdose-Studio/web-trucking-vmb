<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class AssetController extends Controller
{
    // Access File: public access to asset
    public function getFile(string $path)
    {
        // Construct the full file path
        $filePath = public_path("assets/{$path}");

        // Check if the file exists
        if (!File::exists($filePath)) {
            abort(404, 'File not found');
        }

        // Return the file as a response
        return Response::file($filePath);
    }
}
