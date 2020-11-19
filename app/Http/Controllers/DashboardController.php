<?php

namespace App\Http\Controllers;

use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Question;
use App\Answer;
use App\Comment;
use App\Blog;
use App\Category;
use App\Review;
use App\Flag;
use App\Country;
use App\State;
use App\City;
use App\Location;
use Storage;

class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function dashboard(){
        $user = User::where('id', Auth::id())->first();
        $blogids = Blog::where('user_id', Auth::id())->select('id')->get();
        // $comments = Comment::whereIn('blog_id', $blogids)->where('parent_id',NULL)->orderBy('id', 'desc')->take(3)->get();
        $comments = DB::table('comments')->whereIn('blog_id', $blogids->pluck('id'))->where('parent_id', NULL)
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->leftjoin('flags', 'comments.id', '=', 'flags.subject_id')
            ->select('comments.*', 'users.name', 'users.avatar', DB::raw('IF(STRCMP(flags.type,"comment") = 0, TRUE, FALSE) as flagged'))
            ->orderBy('comments.id', 'desc')->take(3)->get();
        $totalcomments = Comment::whereIn('blog_id', $blogids->pluck('id'))->count();
        $followers =  $user->followers->take(12);
        // $reviews = Review::where('user_id', Auth::id())->with('user')->orderBy('created_at', 'desc')->take(3)->get();
        $reviews = DB::table('reviews')->where('reviews.member_id', Auth::id())
        ->join('users', 'reviews.user_id', '=', 'users.id')
        ->leftjoin('flags', 'reviews.id', '=', 'flags.subject_id')
        ->select('reviews.*', 'users.name', 'users.avatar', DB::raw('IF(STRCMP(flags.type,"review") = 0, TRUE, FALSE) as flagged'))
        ->orderBy('reviews.id', 'desc')->take(3)->get();
        $blogs  = Blog::where('user_id', Auth::id())->with('user', 'comments')->orderBy('id', 'desc')->take(6)->get();
        $activites = Activity::where('causer_id',Auth::id())->orderBy('id','desc')->take(6)->get();
        return view('dashboard.index', compact('user','comments','reviews','totalcomments','followers','blogs','activites'));
    }


    public function blogs(){
        $user = User::where('id', Auth::id())->first();
        $blogs  = Blog::where('user_id', Auth::id())->with('user', 'comments')->orderBy('id', 'desc')->paginate(21);
        return view('dashboard.blog', compact('user','blogs'));
    }
    
    public function newblog(){
        $user = User::where('id', Auth::id())->first();
        $blogs  = Blog::where('user_id', Auth::id())->with('user', 'comments')->orderBy('id', 'desc')->paginate(21);
        return view('dashboard.newblog', compact('user','blogs'));
    }

    public function editblog(Request $request){
        $user = User::where('id', Auth::id())->first();
        $blog  = Blog::where('user_id', Auth::id())->where('slug', $request->slug)->with('user', 'comments')->orderBy('id', 'desc')->first();
        return view('dashboard.editblog', compact('user','blog'));
    }

    public function comments(){
        $user = User::where('id', Auth::id())->first();
        $blogids = Blog::where('user_id', Auth::id())->select('id')->get();
        $comments = DB::table('comments')->whereIn('blog_id', $blogids->pluck('id'))->where('parent_id', NULL)
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->join('blogs', 'comments.blog_id', 'blogs.id')
            ->leftjoin('flags', 'comments.id', '=', 'flags.subject_id')
            ->select('comments.*', 'users.name', 'users.avatar', 'blogs.slug', 'blogs.title',DB::raw('IF(STRCMP(flags.type,"comment") = 0, TRUE, FALSE) as flagged'))
            ->orderBy('id', 'desc')->paginate(18);
        // return $comments = Comment::whereIn('blog_id', $blogids->pluck('id'))->where('parent_id', NULL)->with('user')->orderBy('id', 'desc')->paginate(18);
        return view('dashboard.comments', compact('user','comments'));
    }


    public function reviews(){
        $user = User::where('id', Auth::id())->first();
        $blogids = Blog::where('user_id', Auth::id())->select('id')->get();
        $reviews = DB::table('reviews')->where('reviews.member_id', Auth::id())
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->leftjoin('flags', 'reviews.id', '=', 'flags.subject_id')
            ->select('reviews.*', 'users.name', 'users.avatar', DB::raw('IF(STRCMP(flags.type,"comment") = 0, TRUE, FALSE) as flagged'))
            ->orderBy('id', 'desc')->paginate(18);
        // return $reviews = Comment::whereIn('blog_id', $blogids->pluck('id'))->where('parent_id', NULL)->with('user')->orderBy('id', 'desc')->paginate(18);
        return view('dashboard.reviews', compact('user','reviews'));
    }


    public function questions(){
        $user = User::where('id', Auth::id())->first();
        $questions = Question::with('user')->where('member_id', $user->id)->where('answers_count',0)->paginate(18);
        // return $answers;
        return view('dashboard.questions', compact('user','questions'));
    }


    public function answers(){
        $user = User::where('id', Auth::id())->first();
        $answers = Answer::with('user', 'question')->where('user_id', $user->id)->paginate(18);
        // return $answers;
        return view('dashboard.answers', compact('user','answers'));
    }

    public function followers(){
        $user = User::where('id', Auth::id())->first();
        $followers = $user->followers;
        return view('dashboard.followers', compact('user','followers'));
    }

    public function profile(){
        $user = User::where('id', Auth::id())->first();
        $countries = Country::where('is_active', 1)->get();
        $locations = Location::all();
        $images = $user->getMedia('photos');
        $videos = $user->getMedia('videos');
        return view('dashboard.profile', compact('user', 'countries','locations','images','videos'));
    }

    public function toggleFlag(Request $request){
        request()->validate([
            'type' => 'required',
            'subject_id' => 'numeric',
            ]);

            $type = $request->type;
            if ($type=="comment"){
                $subject = Comment::find($request->subject_id);
            }
            else if($type=="review"){
                $subject = Review::find($request->subject_id);
            }  
            else{
                $arr = array('msg' => 'Error', 'status' => false);
                return Response()->json($arr);
            }           
            $request->merge([
                'user_id' => Auth::id(),
                'subject_type' => get_class($subject),
                'status' => 'pending'
            ]);
            
            $data = $request->all();
            $getdata = Flag::where('subject_id', $request->subject_id)->where('user_id', Auth::id())->where('subject_type', $request->subject_type)->first();
            if($getdata){
                $getdata->delete();
                activity()
                ->causedBy(Auth::id())
                ->performedOn($subject)
                ->log('User Unflagged');
                $arr = array('msg' => 'Removed Flag', 'status' => true);
            }
            else{
                activity()
                ->causedBy(Auth::id())
                ->performedOn($subject)
                ->log('User Flagged');
                $check = Flag::create($data);
                $arr = array('msg' => 'Flagged Sent for review', 'status' => true);
            }
        return Response()->json($arr);
    }

    public function messages(){
        $user = User::where('id', Auth::id())->first();
        return view('dashboard.messages', compact('user'));
    }

    public function editorupload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
        
            $uploadedimage = $request->upload->store('editorimg','public');

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/'.$uploadedimage); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');
    
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $file = $request->file('file');
        $uploadedimage = $request->file->store('tmp','public');

        // $name = uniqid() . '_' . trim($file->getClientOriginalName());
        // $file->move($path, $name);
        return response()->json([
            'name'          => $uploadedimage,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function storeimage(Request $request)
    {
        $user = User::where('id', Auth::id())->first();
        foreach ($request->input('images', []) as $file) {
            $user->addMedia(public_path('/storage/'.$file))->toMediaCollection('photos');
        }
        return response()->json([
            'name'          => "stored",
        ]);
    }

    public function deletemedia(Request $request, User $user)
    {
        $user = User::where('id', Auth::id())->first();
        $photos = $user->getMedia('photos');
        foreach ($photos as $photo){
            if ($photo->id == $request->pic && $photo->model_id == Auth::id()){
                $photo->delete();
                return response()->json([
                    'msg'          => "success",
                ]);
            }
        }
        return response()->json([
            'msg'          => "failure",
        ]);
    }

    public function storevideo(Request $request)
    {
        $user = User::where('id', Auth::id())->first();
        foreach ($request->input('videos', []) as $file) {
            $user->addMedia(public_path('/storage/'.$file))->toMediaCollection('videos');
        }
        return response()->json([
            'name'          => "stored",
        ]);
    }

    public function deletevideo(Request $request, User $user)
    {
        $user = User::where('id', Auth::id())->first();
        $photos = $user->getMedia('photos');
        foreach ($photos as $photo){
            if ($photo->id == $request->pic && $photo->model_id == Auth::id()){
                $photo->delete();
                return response()->json([
                    'msg'          => "success",
                ]);
            }
        }
        return response()->json([
            'msg'          => "failure",
        ]);
    }

    public function updateavatar(Request $request)
    {    
        $file = $request->file('file');
        $user = User::where('id', Auth::id())->first();
        $uploadedimage = $request->file->store('users-avatar','public');
        // https://randomuser.me/api/portraits/men/1.jpg
        // return response()->json([
        //     'name'          => $uploadedimage,
        //     'original_name' => $file->getClientOriginalName(),
        // ]);
        $userupdate = User::where('id', Auth::id())
                        ->update(['avatar' => $uploadedimage]);
            $arr = array('msg' => 'Something goes to wrong. Please try again later', 'status' => false);
            if($userupdate){ 
                activity()
                ->causedBy(Auth::id())
                ->performedOn($user)
                ->log(':causer.name Updated Profile picture');
            $arr = array('msg' => 'Successfully stored', 'status' => true);
            }
            return Response()->json($arr);
    }
    

}
