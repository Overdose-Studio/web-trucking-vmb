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

        // Get the file's MIME type
        $mimeType = mime_content_type($filePath);

        // Set appropriate headers based on file type
        $headers = [];
        if (strpos($mimeType, 'text') !== false) {
            $headers['Content-Type'] = $mimeType;
            $headers['Content-Disposition'] = 'inline';
        }

        // Return the file as a response with the correct content type
        return response()->file($filePath, [
            'Content-Type' => $mimeType,
        ]);
    }
}
