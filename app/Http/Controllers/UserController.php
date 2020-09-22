<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Review;
use App\Consultation;
use App\Question;
use Auth;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class UserController extends Controller
{
    public function search(Request $request){
        $selectedCategories = [];
        $sortby = $request->sortby ?? 'featured';
        $users = User::orderBy($sortby, 'desc')->paginate(20);
        if (isset($request->categories))
            {
                $selectedCategories = explode(",",$request->categories);
                $catids = Category::whereIn('slug',$selectedCategories)->select('id')->get();
                $users = User::whereIn('category_id',$catids->pluck('id'))->orderBy($sortby, 'desc')->paginate(20);
            }
        return view('user.search', compact('users','selectedCategories'));
    }
    public function profile(Request $request){
        $user = User::where('slug',$request->username)->first();
        $reviews = Review::where('member_id', $user->id)->with('user','member')->paginate(5);
        return view('user.profile', compact('user', 'reviews'));
    }

    public function askQuestion(Request $request){
        if (Auth::check())
        {   
            // Modify Request
            $category = User::where('id',$request->member_id)->select('category_id')->first();
            $slug = SlugService::createSlug(Question::class, 'slug', $request->title);

            $request->merge([
                'user_id' => Auth::id(),
                'category_id' => $category->category_id,
                'slug' => $slug
            ]);
            request()->validate([
            'title' => 'required',
            'member_id' => 'required|numeric'
            ]);
            
            $data = $request->all();
            $check = Question::insert($data);

            $arr = array('msg' => 'Something goes to wrong. Please try again later', 'status' => false);
            if($check){ 
            $arr = array('msg' => 'Successfully stored', 'status' => true);
            }
            return Response()->json($arr);
        }
    }


    public function bookConsultation(Request $request){
        if (Auth::check())
        {   
            // Modify Request
            $request->merge([
                'user_id' => Auth::id(),
            ]);
            request()->validate([
            'consultation_datetime' => 'required|date',
            'member_id' => 'required|numeric'
            ]);
            
            $data = $request->all();
            $check = Consultation::insert($data);
            $arr = array('msg' => 'Something goes to wrong. Please try again later', 'status' => false);
            if($check){ 
            $arr = array('msg' => 'Successfully stored', 'status' => true);
            }
            return Response()->json($arr);
        }
    }


    public function rateReview(Request $request){
        if (Auth::check())
        {   
            // Modify Request
            $request->merge([
                'user_id' => Auth::id(),
            ]);
            request()->validate([
            'review' => 'required',
            'rating' => 'required|numeric',
            'member_id' => 'required|numeric'
            ]);
            
            $data = $request->all();
            $check = Review::insert($data);
            // User Avaerage Rating to User table
            $average = Review::where('member_id', $request->member_id)->avg('rating');
            $total = Review::where('member_id', $request->member_id)->count();
            $userupdate = User::where('id', $request->member_id)
                        ->update(['rating' => $average, 'reviews' => $total]);
            $arr = array('msg' => 'Something goes to wrong. Please try again later', 'status' => false);
            if($check){ 
            $arr = array('msg' => 'Successfully stored', 'status' => true);
            }
            return Response()->json($arr);
        }
    }


    public function userFollow(Request $request){
        if (Auth::check())
        {
            $member1 = User::find(Auth::id());
            $member2 = User::find($request->member_id);
            $member1->toggleFollow($member2); 
            $userupdate = User::where('id', $request->member_id)
            ->update(['followers' => $member2->followers()->count()]);
            $arr = array('msg' => 'Success', 'status' =>  $member1->isFollowing($member2), 'count'=> $member2->followers()->count());
            return Response()->json($arr);
        }
        else{
            return "Login Required";
            $arr = array('msg' => 'Failure', 'status' =>  'Login Required', 'count'=> $member2->followings()->count());
        }
    }

}
