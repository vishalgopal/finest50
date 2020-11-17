<?php

namespace App\Http\Controllers;

use App\Blog;
use App\User;
use App\Category;
use App\Question;
use Illuminate\Http\Request;
use Stevebauman\Location\Location;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return Blog::search('& method')->get();
        // return $position = \Location::get(\Request::ip());
        $blogs = Blog::with('user', 'category')->where('status','published')->where('featured',1)->take(6)->get();
        $members = User::with('category')->where('featured',1)->take(10)->get();
        $recentQAs = Question::with('user')->OrderBy('id','desc')->take(4)->get();
        // $popularQAs = Question::with('user')->withCount('answers')->orderBy('answers_count', 'desc')->take(4)->get(); 
        $popularQAs = Question::with('user')->orderBy('answers_count', 'desc')->take(4)->get(); 
        return view('home.index', compact ('blogs','members','recentQAs','popularQAs'));
    }
}
