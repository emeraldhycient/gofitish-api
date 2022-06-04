<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Podcast;

class PodcastController extends Controller
{
    public static function uploadPodcast(Request $request)
    {


        $validate = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'podcast' => 'required',
            'poster' => 'required',
            'category' => 'required',
            'uploader_id' => 'required',
            'uploader_name' => 'required',
        ]);
        


        $podcast_path = null;
        $poster_path = null;

        if($request->hasFile('podcast') && $request->hasFile('poster')){
           //upload to cloudinary
           $podcastname = time().Str::random(5);
           $podcast_path = $request->podcast->storeOnCloudinaryAs('audios', $podcastname)->getSecurePath();
           $postername = time().Str::random(5);
           $poster_path = $request->poster->storeOnCloudinaryAs('images', $postername)->getSecurePath();
            /*to upload video and pictures locally 
            $podcast_path = time().Str::random(5).'.'.$request->podcast->extension();
            $request->video->move(public_path('videos'), $video_path);

            $poster_path = time().Str::random(5).'.'.$request->poster->extension();
            $request->poster->move(public_path('images'), $poster_path); */
        }

        $podcast = Podcast::create([
            'podcast_id' => Str::random(5),
            'title' => $request->title,
            'description' => $request->description,
            'podcast_url' => $podcast_path,
            'poster_url' => $poster_path,
            'podcast_category' => $request->category,
            'podcast_subcategory' => $request->subcategory,
            'uploader_id' => $request->uploader_id,
            'uploader_name' => $request->uploader_name,
        ]);
        
      
        return response()->json([
            'status' => 'success',
            'message'=>'podcast uploaded successfully',
            'Podcast' => $podcast,
        ]);
    }

    public static function getPodcasts(Request $request)
    {
        $podcasts = Podcast::all();
        return response()->json([
            'status' => 'success',
            'message'=>'podcasts retrieved successfully',
            'podcasts' => $podcasts,
        ]);
    }

    public static function getPodcast(Request $request, $podcast_id)
    {
        $podcast = Podcast::where('podcast_id', $podcast_id)->first();
        return response()->json([
            'status' => 'success',
            'message'=>'podcast retrieved successfully',
            'podcast' => $podcast,
        ]);
    }

    public static function deletePodcast(Request $request, $podcast_id)
    {
        $podcast = Podcast::where('podcast_id', $podcast_id)->first();
        $podcast->delete();
        return response()->json([
            'status' => 'success',
            'message'=>'podcast deleted successfully',
            'podcast' => $podcast,
        ]);
    }

    public static function updatePodcast(Request $request, $podcast_id)
    {
        $podcast = Podcast::where('podcast_id', $podcast_id)->first();
        $podcast->title = $request->title;
        $podcast->description = $request->description;
        $podcast->podcast_category = $request->category;
        $podcast->podcast_subcategory = $request->subcategory;
        $podcast->save();
        return response()->json([
            'status' => 'success',
            'message'=>'podcast updated successfully',
            'podcast' => $podcast,
        ]);
    }

    public static function getPodcastsByCategory(Request $request, $category)
    {
        $podcasts = Podcast::where('podcast_category', $category)->get();
        return response()->json([
            'status' => 'success',
            'message'=>'podcasts retrieved successfully',
            'podcasts' => $podcasts,
        ]);
    }

    public static function getPodcastsBySubCategory(Request $request, $subcategory)
    {
        $podcasts = Podcast::where('podcast_subcategory', $subcategory)->get();
        return response()->json([
            'status' => 'success',
            'message'=>'podcasts retrieved successfully',
            'podcasts' => $podcasts,
        ]);
    }

    public static function getPodcastsByUploader(Request $request, $id)
    {
        $podcasts = Podcast::where('uploader_id', $id)->get();
        return response()->json([
            'status' => 'success',
            'message'=>'podcasts retrieved successfully',
            'podcasts' => $podcasts,
        ]);
    }

    


}