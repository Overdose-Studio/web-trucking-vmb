<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class AssetController extends Controller
{
    // Access File: public access to asset
    public function getFile(string $file) {
        // Get file path
        $filePath = public_path("assets/{$file}");

        // If file not found, return 404
        if (!File::exists($filePath)) {
            abort(404, 'File not found');
        }

        // Return file
        return Response::file($filePath);
    }

    // Access Directory Files: public access to asset directory
    public function getDirectoryFile(string $directory, string $file) {
        // Get file path
        $filePath = public_path("assets/{$directory}/{$file}");

        // If file not found, return 404
        if (!File::exists($filePath)) {
            abort(404, 'File not found');
        }

        // Return file
        return Response::file($filePath);
    }
}
