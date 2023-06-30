<?php

namespace App\Http\Controllers;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function save(Request $request){

        
        $title = $request->news_title;
        $excerpt = $request->news_excerpt;

        $request->validate([
            'image' => 'required|image',
        ]);

        $news = News::create([
            'news_title' => $title,
            'news_excerpt' => $excerpt,
        ]);

        $imageName = time().'.'.$request->file('image')->extension();
        $request->image->move(public_path('images'), $imageName);

        $image = DB::table('images')->insert([
            'image_url' => $imageName,
            'imageused_id' => $news->id,
            'imageused_type' => 'news',
        ]);

        echo "UPLOADED IMAGE & NEWS";
    }
}
