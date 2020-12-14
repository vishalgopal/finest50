<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Blog;
use App\User;
use App\Question;
class SearchController extends Controller
{
    public function ajaxcall(Request $request, $type, $query){
        $location = NULL;
        if ($type=='blog'){
            $blogs = Blog::search($query)->where('status','published')->paginate(20);
            return view('search.blogs', compact('query','blogs'));
            
        }
        if ($type=='member'){
            $selectedCategories = [];
            
            $sortby = $request->sortby ?? 'featured';
            $users = User::search($query)->where('location',$location)
            ->where(function($query) {
                return $query->where('type','member')
                    ->orWhere('type','business');
            })->orderBy($sortby, 'desc')->paginate(20);
            // $categories = Category::search($query)->get();
            // if($categories){
            //    $selectedCategories = $categories->pluck('slug')->toArray();
            //     $catids = Category::whereIn('slug',$categories->pluck('slug'))->select('id')->get();
            //     $userscategory = User::whereIn('category_id',$catids->pluck('id'))->orderBy($sortby, 'desc')->get();
            //     $users = $users->merge($userscategory)->sortByDesc($sortby);
            //     $users = \App\CollectionHelper::paginate($users,5);
            // }
            if (isset($request->categories))
                {
                    $selectedCategories = explode(",",$request->categories);
                    $catids = Category::whereIn('slug',$selectedCategories)->select('id')->get();
                    $users = User::whereIn('id',$users->pluck('id'))->whereIn('category_id',$catids->pluck('id'))->where('location',$location)->orderBy($sortby, 'desc')->paginate(20);
                }
            return view('search.members', compact('users','selectedCategories', 'query'));
        }
        if ($type=='question'){
            $questions =  Question::search($query)->paginate(20);
            return view('search.questions', compact('query','questions'));

        }
        if ($type=='category'){
            $categories = Category::search($query)->paginate(20);
            return view('search.categories', compact('query','categories'));
        }
        if ($type=='all'){
            $users = User::search($query)->where('location',$location)
            ->where(function($query) {
                return $query->where('type','member')
                    ->orWhere('type','business');
            })->take(12)->get();
            $categories = Category::search($query)->get();
            // $userscategory = User::whereIn('category_id',$categories->pluck('id'))->take(12)->get();
            // $users = $users->merge($userscategory);
            $blogs = Blog::search($query)->where('status','published')->take(12)->get();
            $questions = Question::search($query)->take(12)->get();
            return view('search.all', compact('users','query','blogs','questions','categories'));
        }        
    }

}
