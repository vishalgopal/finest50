<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Review;
use App\Consultation;
use App\Question;
use Auth;
use Chatify\Facades\ChatifyMessenger as Chatify;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function search(Request $request){
        $selectedCategories = [];
        $location = NULL;
        $sortby = $request->sortby ?? 'featured';
        $users = User::orderBy($sortby, 'desc')->where('location',$location)->where('type','member')->paginate(20);
        // $categories = Category::all();
        // $blogs = Blog::all();
        if (isset($request->categories))
            {
                $selectedCategories = explode(",",$request->categories);
                $catids = Category::whereIn('slug',$selectedCategories)->select('id')->get();
                $users = User::whereIn('category_id',$catids->pluck('id'))->where('location',$location)->where('type','member')->orderBy($sortby, 'desc')->paginate(20);
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
            // $slug = SlugService::createSlug(Question::class, 'slug', $request->title);
            $user = User::find($request->member_id); 
            $request->merge([
                'user_id' => Auth::id(),
                'category_id' => $category->category_id,
                // 'slug' => $slug
            ]);
            request()->validate([
            'title' => 'required',
            'member_id' => 'required|numeric'
            ]);
            
            $data = $request->all();
            $check = Question::create($data);

            $arr = array('msg' => 'Something goes to wrong. Please try again later', 'status' => false);
            if($check){ 
                activity()
                ->causedBy(Auth::id())
                ->performedOn($user)
                ->log(':causer.name asked a Question');
            $arr = array('msg' => 'Successfully stored', 'status' => true);
            }
            return Response()->json($arr);
        }
    }

    public function requestchat(Request $request){
        if (Auth::check())
        {   
            $user = User::find($request->to_id); 
            $messageID = mt_rand(9, 999999999) + time();
            Chatify::newMessage([
                'id' => $messageID,
                'type' => "user",
                'from_id' => Auth::user()->id,
                'to_id' => $request['to_id'],
                'body' => trim(htmlentities($request['body'])),
                'attachment' => null,
            ]);

            // fetch message to send it with the response
            $messageData = Chatify::fetchMessage($messageID);

            // send to user using pusher
            Chatify::push('private-chatify', 'messaging', [
                'from_id' => Auth::user()->id,
                'to_id' => $request['id'],
                'message' => Chatify::messageCard($messageData, 'default')
            ]);


            $arr = array('msg' => 'Something goes to wrong. Please try again later', 'status' => false);
            if($messageData){ 
                activity()
                ->causedBy(Auth::id())
                ->performedOn($user)
                ->log(':causer.name Requested Chat');
            $arr = array('msg' => 'Successfully stored', 'status' => true);
            }
            return Response()->json($arr);
        }
    }


    public function bookConsultation(Request $request){
        if (Auth::check())
        {   
            // Modify Request
            $user = User::find($request->member_id); 
            $request->merge([
                'user_id' => Auth::id(),
            ]);
            request()->validate([
            'consultation_datetime' => 'required|date',
            'member_id' => 'required|numeric'
            ]);
            
            $data = $request->all();
            $check = Consultation::create($data);
            $arr = array('msg' => 'Something goes to wrong. Please try again later', 'status' => false);
            if($check){ 
                activity()
                ->causedBy(Auth::id())
                ->performedOn($user)
                ->log(':causer.name booked a Consulation');
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
            $user = User::find($request->member_id); 
            $data = $request->all();
            $check = Review::create($data);
            
            // User Avaerage Rating to User table
            $average = Review::where('member_id', $request->member_id)->avg('rating');
            $total = Review::where('member_id', $request->member_id)->count();
            $userupdate = User::where('id', $request->member_id)
                        ->update(['rating' => $average, 'reviews' => $total]);
            $arr = array('msg' => 'Something goes to wrong. Please try again later', 'status' => false);
            if($check){ 
                activity()
                ->causedBy(Auth::id())
                ->performedOn($user)
                ->log(':causer.name wrote a Review');
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
            ->update(['follower' => $member2->followers()->count()]);
            $count = thousandsCurrencyFormat($member2->followers()->count());
            $arr = array('msg' => 'Success', 'status' =>  $member1->isFollowing($member2), 'count'=> $count);
            return Response()->json($arr);
        }
        else{
            return "Login Required";
            $arr = array('msg' => 'Failure', 'status' =>  'Login Required', 'count'=> $member2->followings()->count());
        }
    }
    
    public function updateprofile(Request $request){
        $data = $request->except(['_token','profile_avatar_remove','new_password', 'new_password_confirm']);
        if(isset($request->new_password) || isset($request->new_password)){
            $this->validate($request, [
                'new_password'          => 'required',
                'new_password_confirm' => 'required|same:new_password'
            ]);
            $request->merge([
                'password' => Hash::make($request->new_password),
            ]);
        }
        if (Auth::check()){
            $user = User::find(Auth::id());
            $data = $request->except(['_token','profile_avatar_remove','new_password', 'new_password_confirm']);;
            if ($files = $request->file('image')) {
                $uploadedimage = $request->image->store('public/images','public');
                $data['image'] = $uploadedimage;
            }
            $check = User::where('id',Auth::id())->update($data);
            if ($check){
                activity()
                ->causedBy(Auth::id())
                ->performedOn($user)
                ->log('User Details Modified');
                $arr = array('msg' => 'Successfully modified', 'status' =>  'Modified');
                return Response()->json($arr);
            }
            else{
                $arr = array('msg' => 'Failed', 'status' =>  'Failed');
                return Response()->json($arr);
            }
        }
    }

    public function uploadUserImages(Request $request)
    {
        dd($request);
    $this->validate($request, [
    'photos'=>'required',
    ]);
    if($request->hasFile('photos'))
        {
        $allowedfileExtension=['pdf','jpg','png','docx'];
        $files = $request->file('photos');
        foreach($files as $file){
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $check=in_array($extension,$allowedfileExtension);
        //dd($check);
        // if($check)
        //     {
        //     $items= Item::create($request->all());
        //     foreach ($request->photos as $photo) {
        //         $filename = $photo->store('photos');
        //         ItemDetail::create([
        //         'item_id' => $items->id,
        //         'filename' => $filename
        //         ]);
        //     }
        //     echo "Upload Successfully";
        // }
        // else
        // {
        //     echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
        // }
        }
        }
    }
}