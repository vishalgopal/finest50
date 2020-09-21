<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Blog;
use App\User;
use App\Question;

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
        // $categories = Category::where('parent',0)->get();
        $blogs = Blog::with('user', 'category')->get();
        $members = User::with('category')->where('featured',1)->take(10)->get();
        // return $members;
        $recentQAs = Question::with('user')->OrderBy('id','desc')->take(4)->get();
        $popularQAs = Question::with('user')->withCount('answers')->orderBy('answers_count', 'desc')->take(4)->get(); 
        return view('home.index', compact ('blogs','members','recentQAs','popularQAs'));
    }
}
