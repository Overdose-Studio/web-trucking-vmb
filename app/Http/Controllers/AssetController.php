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

        // Check if the file is `.css` set the header to `text/css`
        if (pathinfo($filePath, PATHINFO_EXTENSION) === 'css') {
            return Response::file($filePath, ['Content-Type' => 'text/css']);
        } else {
            return Response::file($filePath);
        }
    }
}
