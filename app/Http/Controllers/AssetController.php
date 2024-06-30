<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class AssetController extends Controller
{
    // Access Aset: public access to asset
    public function getAssets(string $file) {
        // Get file path
        $filePath = public_path("assets/{$file}");

        // If file not found, return 404
        if (!File::exists($filePath)) {
            abort(404, 'File not found');
        }

        // Return file
        return Response::file($filePath);
    }
}
