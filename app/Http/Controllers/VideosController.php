<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videos;
use Illuminate\Support\Str;


class VideosController extends Controller
{
    public static function getVideos($cat)
    {
        $videos =null ;
        if($cat === 'all'){
            $videos = Videos::all();
        }else{
            $videos = Videos::where('category', $cat)->get();
        }
        return response()->json([
            'message'=>'videos fetched successfully',
            'videos' => $videos,
        ]);

    }

    public static function getVideo($id)
    {
        $video = Videos::where('video_id',$id);
        if($video->count() > 0){
        return response()->json([
            'message'=>'video fetched successfully',
            'video' => $video,
        ]);
        }else{
            return response()->json([
                'message'=>'video not found',
                'video'=>$video
            ]);
        }
    }

    public static function getVideosByUser($id)
    {
        $videos = Videos::where('uploader_id',$id)->get();
        return response()->json([
            'message'=>'videos fetched successfully',
            'videos' => $videos,
        ]);
    }

    public static function getVideosByCategory($cat)
    {
        $videos = Videos::where('category',$cat)->get();
        return response()->json([
            'message'=>'videos fetched successfully',
            'videos' => $videos,
        ]);
    }

    public static function getVideosBySubCategory($cat,$subcat)
    {
        $videos = Videos::where('category',$cat)->where('subcategory',$subcat)->get();
        return response()->json([
            'message'=>'videos fetched successfully',
            'videos' => $videos,
        ]);
    }

    public static function getVideosByTag($tag)
    {
        $videos = Videos::where('tags',$tag)->get();
        return response()->json([
            'message'=>'videos fetched successfully',
            'videos' => $videos,
        ]);
    }

    public static function searchVideo($search)
    {
        $videos = Videos::where('title','like','%'.$search.'%')->get();
        return response()->json([
            'message'=>'videos fetched successfully',
            'videos' => $videos,
        ]);
    }

    public static function getVideosBySearchAndCategory($search,$cat)
    {
        $videos = Videos::where('title','like','%'.$search.'%')->where('category',$cat)->get();
        return response()->json([
            'message'=>'videos fetched successfully',
            'videos' => $videos,
        ]);
    }


    //upload video 

    public static function uploadVideo(Request $request)
    {


        $validate = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'video' => 'required',
            'poster' => 'required',
            'category' => 'required',
            'uploader_id' => 'required',
            'uploader_name' => 'required',
        ]);
        


        $video_path = null;
        $poster_path = null;

        if($request->hasFile('video') && $request->hasFile('poster')){
           //upload to cloudinary
           $vidname = time().Str::random(5);
           $video_path = $request->video->storeOnCloudinaryAs('videos', $vidname)->getSecurePath();
           $postername = time().Str::random(5);
           $poster_path = $request->poster->storeOnCloudinaryAs('images', $postername)->getSecurePath();
            /*to upload video and pictures locally 
            $video_path = time().Str::random(5).'.'.$request->video->extension();
            $request->video->move(public_path('videos'), $video_path);

            $poster_path = time().Str::random(5).'.'.$request->poster->extension();
            $request->poster->move(public_path('images'), $poster_path); */
        }

        $video = Videos::create([
            'video_id' => Str::random(5),
            'title' => $request->title,
            'description' => $request->description,
            'video_url' => $video_path,
            'poster_url' => $poster_path,
            'video_category' => $request->category,
            'video_subcategory' => $request->subcategory,
            'video_tags' => $request->tags,
            'uploader_id' => $request->uploader_id,
            'uploader_name' => $request->uploader_name,
        ]);
        
      
        return response()->json([
            'status' => 'success',
            'message'=>'video uploaded successfully',
            'video' => $video,
        ]);
    }

}