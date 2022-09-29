<?php

namespace App\Http\Controllers;

use App\Jobs\CreateFile;
use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $posts = Post::latest('id')->paginate(7);
        return view('index',['posts'=>$posts]);
    }

    public function detail($slug){
        $post = Post::where('slug',$slug)->with(['galleries','comments'])->firstOrFail();
        return view('post.detail',compact('post'));
    }

    public function jobTest(){

        // store in jobs
//        dispatch(function (){
//            sleep(5);
//            logger("San Kyi Tar");
//        })->delay(now()->addSecond(10));

        CreateFile::dispatch()->delay(now()->addSecond(10));

        return "job test";
    }

}
