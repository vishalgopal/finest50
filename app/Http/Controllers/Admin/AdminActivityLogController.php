<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class AdminActivityLogController extends Controller
{
    protected $userauthdata;
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware(function ($request, $next) {
        //     $this->userauthdata = Auth::user();

        //     return $next($request);
        // });
    }

    public function index()
    {
        $activities = Activity::all();
        // return $activities;
        return view('admin.activitylog.view', compact('activities'));
    }


    public function create()
    {
        return view('admin.activitylog.create');
    }


    public function store(Request $request)
    {
        request()->validate([
            'title' => ['required', 'string', 'max:255'],
            'thumbnailUrl' => 'mimes:jpg,JPG,jpeg,JPEG,png,PNG',
            'hindiUrl' => 'mimes:pdf,PDF',
            'englishUrl' => 'mimes:pdf,PDF',
            'urdUurl' => 'mimes:pdf,PDF',
            'year' => ['required', 'string', 'max:255'],
            'month' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255']
        ]);
        // return $request;

        $thumbnailUrl = null;
        $hindiUrl = null;
        $englishUrl = null;
        $urdUurl = null;
        //Thumbnail
        if ($files = $request->file('thumbnailUrl')) {
            $destinationPath = public_path('uploads/activitylog/' . $request->title);
            $thumbnailUrl = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $thumbnailUrl);
            $thumbnailUrl = 'uploads/activitylog/' . $request->title . '/' . $thumbnailUrl;
        }
        //Hinndi
        if ($files = $request->file('hindiUrl')) {
            $destinationPath = public_path('uploads/activitylog/' . $request->title);
            $hindiUrl = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $hindiUrl);
            $hindiUrl = 'uploads/activitylog/' . $request->title . '/' . $hindiUrl;
        }
        //English
        if ($files = $request->file('englishUrl')) {
            $destinationPath = public_path('uploads/activitylog/' . $request->title);
            $englishUrl = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $englishUrl);
            $englishUrl = 'uploads/activitylog/' . $request->title . '/' . $englishUrl;
        }
        //Urdu
        if ($files = $request->file('urdUurl')) {
            $destinationPath = public_path('uploads/activitylog/' . $request->title);
            $urdUurl = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $urdUurl);
            $urdUurl = 'uploads/activitylog/' . $request->title . '/' . $urdUurl;
        }


        $book = Book::create([
            // 'sort' => $request->sort,
            'title' => $request->title,
            'thumbnailUrl' => $thumbnailUrl,
            'hindiUrl' => $hindiUrl,
            'englishUrl' => $englishUrl,
            'urdUurl' => $urdUurl,
            'year'     => $request->year,
            'month'     => $request->month,
            'status'     => $request->status

        ]);


        $arr = array('status' => 'success');
        return Response()->json($arr);
    }

    public function edit($id)
    {
        $book = Book::where('id', $id)->first();
        return view('activitylog.edit', compact('book'));
    }

    public function update(Request $request)
    {

        request()->validate([
            'title' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:255'],
            'month' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255']
        ]);
        $book=Book::where('id', $request->b_id)->first();
        $thumbnailUrl = $book->thumbnailUrl;
        $hindiUrl = $book->hindiUrl;
        $englishUrl = $book->englishUrl;
        $urdUurl = $book->urdUurl;
        //Thumbnail
        if ($files = $request->file('thumbnailUrl')) {
            request()->validate([
                'thumbnailUrl' => 'mimes:jpg,JPG,jpeg,JPEG,png,PNG'
            ]);
            $destinationPath = public_path('uploads/activitylog/' . $request->title);
            $thumbnailUrl = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $thumbnailUrl);
            $thumbnailUrl = 'uploads/activitylog/' . $request->title . '/' . $thumbnailUrl;
        }
        //Hinndi
        if ($files = $request->file('hindiUrl')) {
            request()->validate([
                'hindiUrl' => 'mimes:pdf,PDF'
            ]);
            $destinationPath = public_path('uploads/activitylog/'. $request->title.'/hindi');
            $hindiUrl = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $hindiUrl);
            $hindiUrl = 'uploads/activitylog/' . $request->title . '/hindi/' . $hindiUrl;
        }
        //English
        if ($files = $request->file('englishUrl')) {
            request()->validate([
                'englishUrl' => 'mimes:pdf,PDF'
            ]);
            $destinationPath = public_path('uploads/activitylog/'. $request->title.'/english');
            $englishUrl = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $englishUrl);
            $englishUrl = 'uploads/activitylog/' . $request->title . '/english/' . $englishUrl;
        }
        //Urdu
        if ($files = $request->file('urdUurl')) {
            request()->validate([
                'urdUurl' => 'mimes:pdf,PDF'
            ]);
            $destinationPath = public_path('uploads/activitylog/'. $request->title.'/urdu');
            $urdUurl = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $urdUurl);
            $urdUurl = 'uploads/activitylog/' . $request->title . '/urdu/' . $urdUurl;
        }

        $activitylog = Book::where('id', $request->b_id)->update([
            // 'sort' => $request->sort,
            'title' => $request->title,
            'thumbnailUrl' => $thumbnailUrl,
            'hindiUrl' => $hindiUrl,
            'englishUrl' => $englishUrl,
            'urdUurl' => $urdUurl,
            'year'     => $request->year,
            'month'     => $request->month,
            'status'     => $request->status

        ]);



        $arr = array('status' => 'success');
        return Response()->json($arr);
    }
    public function delete(Request $request)
    {
        $news = Book::where('id', $request->c_id)->delete();
        return 'success';
    }
}
