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

        // Return the file as a response depending on the file type
        switch (pathinfo($filePath, PATHINFO_EXTENSION)) {
            case 'css':
                $mimeType = 'text/css';
                break;
            case 'js':
                $mimeType = 'text/javascript';
                break;
            default:
                $mimeType = File::mimeType($filePath);
                break;
        }

        // Return the file as a response with the correct content type
        return response()->file($filePath, [
            'Content-Type' => $mimeType,
        ]);
    }
}
