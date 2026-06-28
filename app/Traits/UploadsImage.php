<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploadsImage
{
    /**
     * Convert and upload image as WebP.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param int $quality
     * @return string Path to saved file
     */
    protected function uploadAsWebp(UploadedFile $file, string $folder, int $quality = 80): string
    {
        $extension = $file->getClientOriginalExtension();
        
        // If it's already webp or svg, just store it directly
        if (in_array(strtolower($extension), ['webp', 'svg'])) {
            return $file->store($folder, 'public');
        }

        $sourcePath = $file->getRealPath();
        
        // Check if getimagesize works, otherwise fallback to store directly
        $imageInfo = @getimagesize($sourcePath);
        if (!$imageInfo) {
            return $file->store($folder, 'public');
        }

        $mime = $imageInfo['mime'];
        $image = null;

        // Try to create image resource from different mime types using GD
        if (function_exists('imagecreatefromjpeg') && $mime == 'image/jpeg') {
            $image = @imagecreatefromjpeg($sourcePath);
        } elseif (function_exists('imagecreatefrompng') && $mime == 'image/png') {
            $image = @imagecreatefrompng($sourcePath);
            if ($image) {
                imagepalettetotruecolor($image);
                imagealphablending($image, true);
                imagesavealpha($image, true);
            }
        } elseif (function_exists('imagecreatefromgif') && $mime == 'image/gif') {
            $image = @imagecreatefromgif($sourcePath);
        }

        // If GD fails or not supported, just store original
        if (!$image || !function_exists('imagewebp')) {
            return $file->store($folder, 'public');
        }

        // Create target filename
        $filename = Str::random(40) . '.webp';
        $path = $folder . '/' . $filename;
        
        // Ensure folder exists
        Storage::disk('public')->makeDirectory($folder);

        $destinationPath = Storage::disk('public')->path($path);
        
        // Convert to WebP
        @imagewebp($image, $destinationPath, $quality);
        imagedestroy($image);

        // If imagewebp failed to write the file, fallback
        if (!file_exists($destinationPath)) {
            return $file->store($folder, 'public');
        }

        return $path;
    }
}
