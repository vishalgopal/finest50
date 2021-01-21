<?php

namespace App\Http\Controllers;
use App\Blog;
use App\Category;
use App\Comment;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
class BlogController extends Controller
{
    public function list(Request $request){
        $catid=0;
        if (isset($request->categories)){
            $category = Category::where('slug', $request->categories)->first();
            $blogs = Blog::where('category_id', $category->id)->where('status','published')->with('category')->paginate(18);
            $catid = $category->id;
        }
        else{
            $blogs = Blog::with('category')->where('status','published')->paginate(18);
        }
        $categories = Category::all();
        $featuredblogs = Blog::where('featured',1)->inRandomOrder()->take(10)->get();
        $trendingblogs = Blog::where('trending',1)->inRandomOrder()->take(10)->get();
        return view('blog.list', compact('blogs','categories','catid','featuredblogs','trendingblogs'));
    }

    public function listMember(Request $request){
        if (isset($request->username)){
            $user = User::where('slug', $request->username)->first();
            $blogs = Blog::where('category_id', $user->id)->where('status','published')->with('category')->paginate(18);
        }
        $categories = Category::all();
        return view('user.blog', compact('blogs','categories'));
    }

    public function single(Request $request){
        $blog = Blog::where('slug', $request->blogslug)->with('category','user')->first();
        $peers = Category::where('id', $blog->category->id)->first();
        views($blog)->record();
        //$popularblogs = Blog::where('status','published')->withCount('comments')->orderBy('comments_count', 'desc')->take(5)->get();
        $popularblogs = Blog::where('status','published')->whereIn('category_id', $peers->peers)->where('id','<>',$blog->id)->withCount('comments')->orderBy('comments_count', 'desc')->take(5)->get();
        $next = Blog::where('id','>',$blog->id)->where('status','published')->orderBy('id')->first();
        $prev = Blog::where('id','<',$blog->id)->where('status','published')->orderBy('id','desc')->first();
        // $recentblogs = Blog::where('status','published')->orderBy('created_at', 'desc')->take(5)->get();
        $recentblogs = Blog::where('status','published')->whereIn('category_id', $peers->peers)->where('id','<>',$blog->id)->orderBy('created_at', 'desc')->take(5)->get();
        $comments = Comment::where('blog_id', $blog->id)->where('parent_id',NULL)->with('children')->paginate(5);
        $relatedblogs = Blog::where('user_id', $blog->user_id)->where('status','published')->where('id','!=',$blog->id)->inRandomOrder()->take(4)->get();
        return view('blog.inner', compact('blog','relatedblogs','comments','popularblogs','recentblogs','next','prev'));
    }

    public function storeComment(Request $request){
        request()->validate([
            'comment' => 'required',
            'parent_id' => 'numeric|nullable',
            'blog_id' => 'numeric',
            ]);
             
            $request->merge([
                'user_id' => Auth::id()
            ]);
            
            $data = $request->all();
            $check = Comment::create($data);
            $comment = Comment::find($check);
            $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' => false);
            $blog = Blog::where('id', $request->blog_id)->first();
            if($check){ 
                activity('timeline')
                ->causedBy(Auth::id())
                ->performedOn($check)
                ->withProperties([
                    'slug' => '/blog/'.$blog->slug,
                    'image' => $blog->image,
                    'description' => Str::limit(strip_tags($blog->description), 150, ' ...'),
                    'useravatar' => Auth::user()->avatar,
                    'username' => Auth::user()->name,
                    'userslug' => Auth::user()->slug
                    ])
                ->log(':causer.name commented on a story - '. $blog->title);
            $arr = array('msg' => 'Successfully stored', 'status' => true);
            }
            return Response()->json($arr);
    }

    public function likeBlog(Request $request){
        if (Auth::check())
        {
            $user = User::find(Auth::id());
            $blog = Blog::find($request->blogid);
            $user->toggleLike($blog); 
            if (Auth::user()->hasLiked($blog)){
                activity()
                ->causedBy(Auth::id())
                ->performedOn($blog)
                ->log(':causer.name liked a story - :subject.title');
            if ($blog->likers()->count() > 1){
                
                $total = $blog->likers()->count() - 1;
                $likecpy = 'you and '. $total  .' more <i class="icon-thumbs-up"></i> this';
            }
            else{
                $likecpy = 'you  <i class="icon-thumbs-up"></i> this    ';
            }
        }
            else{
                activity()
                ->causedBy(Auth::id())
                ->performedOn($blog)
                ->log(':causer.name Liked the Blog - :subject.title');
                if($blog->likers()->count() > 0){
                    $likecpy = $blog->likers()->count().' <i class="icon-thumbs-up"></i>';
                }
                else {
                    $likecpy = 'Be the first one to  <i class="icon-thumbs-up"></i> this';
                }
            }

            $arr = array('msg' => 'Successfully stored', 'status' =>  $user->hasLiked($blog), 'count'=> $blog->likers()->count(),'likecpy' => $likecpy);
            return Response()->json($arr);
        }
    }


    public function saveblog(Request $request){
        request()->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'description' => 'required',
            ]);
        if (Auth::check()){
            $user = User::find(Auth::id());
            
            if ($files = $request->file('image')) {
                $uploadedimage = $request->image->store('images/blogs','public');
            }
            $request->merge([
                'user_id' => Auth::id(),
            ]);
            
            $data = $request->all();
            $data['image'] = $uploadedimage;
            $check = Blog::create($data);
            $blog = Blog::where('id', $check->id)->first();
            if ($check){
                activity('timeline')
                ->causedBy(Auth::id())
                ->performedOn($check)
                ->withProperties([
                    'slug' => '/blog/'.$blog->slug,
                    'image' => $blog->image,
                    'description' => Str::limit(strip_tags($blog->description), 150, ' ...'),
                    'useravatar' => Auth::user()->avatar,
                    'username' => Auth::user()->name,
                    'userslug' => Auth::user()->slug
                    ])
                ->log(':causer.name has written a new story - :subject.title');
                $arr = array('msg' => 'Successfully stored', 'status' =>  'Created');
                return Response()->json($arr);
            }
            else{
                $arr = array('msg' => 'Failed', 'status' =>  'Failed');
                return Response()->json($arr);
            }
        }
    }

    public function updateblog(Request $request, $blogid){
        if ($files = $request->file('image')) {
        request()->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:5048',
            ]);
        }
        else{
            request()->validate([
                'title' => 'required',
                ]);
        }
        if (Auth::check()){
            $user = User::find(Auth::id());
            $data = $request->except('_token');
            if ($files = $request->file('image')) {
                $uploadedimage = $request->image->store('public/images','public');
                $data['image'] = $uploadedimage;
            }
            unset($request['_token']);
            $check = Blog::where('id',$blogid)->where('user_id', Auth::id())->update($data);
            $blog = Blog::find($blogid);
            if ($check){
                activity('timeline')
                ->causedBy(Auth::id())
                ->performedOn($blog)
                ->withProperties([
                    'slug' => '/blog/'.$blog->slug,
                    'image' => $blog->image,
                    'description' => Str::limit(strip_tags($blog->description), 150, ' ...'),
                    'useravatar' => Auth::user()->avatar,
                    'username' => Auth::user()->name,
                    'userslug' => Auth::user()->slug
                    ])
                ->log(':causer.name has updated a story - :subject.title');
                $arr = array('msg' => 'Successfully edited', 'status' =>  'Edited');
                return Response()->json($arr);
            }
            else{
                $arr = array('msg' => 'Failed', 'status' =>  'Failed');
                return Response()->json($arr);
            }
        }
    }


    public function deleteblog(Request $request, $blogid){
        if (Auth::check()){
            $blog = Blog::find($blogid);
            $check = Blog::where('id',$blogid)->where('user_id', Auth::id())->delete();
            if ($check){
                activity()
                ->causedBy(Auth::id())
                ->performedOn($blog)
                ->log('Story Deleted');
                $arr = array('msg' => 'Successfully deleted', 'status' =>  'Deleted');
                return Response()->json($arr);
            }
            else{
                $arr = array('msg' => 'Failed', 'status' =>  'Failed');
                return Response()->json($arr);
            }
        }
    }

    public function deletecomment(Request $request, $commentid){
        if (Auth::check()){
            $comment = Comment::find($commentid);
            $check = Comment::where('id',$commentid)->where('user_id', Auth::id())->delete();
            if ($check){
                activity()
                ->causedBy(Auth::id())
                ->performedOn($comment)
                ->log('Comment Deleted');
                $arr = array('msg' => 'Successfully deleted', 'status' =>  'Deleted');
                return Response()->json($arr);
            }
            else{
                $arr = array('msg' => 'Failed', 'status' =>  'Failed');
                return Response()->json($arr);
            }
        }
    }
}
