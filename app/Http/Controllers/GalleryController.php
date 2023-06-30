<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    public function save(Request $request){

        
        $title = $request->album_name;
        $excerpt = $request->album_description;

        $request->validate([
            'image' => 'required|image',
        ]);

        $album = Gallery::create([
            'album_name' => $title,
            'album_description' => $excerpt,
        ]);

        $imageName = time().'.'.$request->file('image')->extension();
        $request->image->move(public_path('images'), $imageName);

        $image = DB::table('images')->insert([
            'image_url' => $imageName,
            'imageused_id' => $album->id,
            'imageused_type' => 'album',
        ]);

        echo "UPLOADED IMAGE & Album";
    }
}
