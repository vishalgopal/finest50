<?php

namespace App\Http\Controllers;
use App\Blog;
use App\Category;
use App\Comment;
use Auth;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function list(Request $request){
        $catid=0;
        if (isset($request->categories)){
            $category = Category::where('slug', $request->categories)->first();
            $blogs = Blog::where('category_id', $category->id)->with('category')->paginate(18);
            $catid = $category->id;
        }
        else{
            $blogs = Blog::with('category')->paginate(18);
        }
        $categories = Category::all();
        return view('blog.list', compact('blogs','categories','catid'));
    }

    public function single(Request $request){
        $blog = Blog::where('slug', $request->blogslug)->with('category','user')->first();
        $popularblogs = Blog::withCount('comments')->orderBy('comments_count', 'desc')->take(5)->get();
        $next = Blog::where('id','>',$blog->id)->orderBy('id')->first();
        $prev = Blog::where('id','<',$blog->id)->orderBy('id','desc')->first();
        $recentblogs = Blog::orderBy('created_at', 'desc')->take(5)->get();
        $comments = Comment::where('blog_id', $blog->id)->where('parent_id',NULL)->with('children')->paginate(5);
        $relatedblogs = Blog::where('category_id', $blog->category_id)->where('id','!=',$blog->id)->inRandomOrder()->take(4)->get();
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
            $check = Comment::insert($data);
            $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' => false);
            if($check){ 
            $arr = array('msg' => 'Successfully stored', 'status' => true);
            }
            return Response()->json($arr);
    }
}
