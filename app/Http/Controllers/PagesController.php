<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Added 10/27 test
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;


class PagesController extends Controller
{
    public function index(){
        //Not necessary to pass title, only here for example
        //$title = 'Welcome to the Longlife Development Website Portal.';
        //return view('pages.index', compact('title')); use below for multiple values
        //return view('pages.index')->with('title', $title);

        $posts = Post::orderBy('created_at', 'desc')->take(1)->get(); 
        return view('pages.index')->with('posts', $posts);
    }

    public function about(){
        $title = 'About LongLife Development';
        return view('pages.about')->with('title', $title);
    }

    public function services(){
        //$title = 'LongLife Services';
        //Not Necessary, Only passing data by array for example.
        $data = array(
            'title' => 'LongLife Services',
            'services' => ['Web Design', 'WebSite Packages From $99.99']
        );
        return view('pages.services')->with($data);
    } 
}

