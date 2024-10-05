<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function uploadimage(Request $request)
    {
        // Validate that the file is present and is an image
        $request->validate([
            'file' => 'required|image',  // This ensures the file is an image
        ]);
    
        // Store the image in the 'public' disk (usually storage/app/public/)
        $path = $request->file('file')->store('public');
    
        // Extract the image path
        $pathArray = explode('/', $path);
        $imgpath = $pathArray[1];
    
        // Create a new image record
        $img = new Image();
        $img->path = $imgpath;
    
        // Save the image and redirect
        if ($img->save()) {
            // Redirect to the named route 'displayimage'
            return redirect('display');
        }
    
        // In case of failure, return with an error message (optional)
        return redirect()->back()->with('error', 'Image upload failed.');
    }
    

    public function displayimage() {
        // Fetch all images from the database
        $images = Image::all();
    
        // Pass the images data to the 'display' view
        return view('display', [
            'images' => $images
        ]); // Missing closing parenthesis
    }
    
    
}
