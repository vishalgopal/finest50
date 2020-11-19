<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use Auth;
use DB;
use App\User;
class QnAController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    public function showQuestion($request){
        $question = Question::where('slug', $request)->with('answers')->with('user')->first();
        // return $question;
        $answers = Answer::where('question_id', $question->id)->with('user')->get();
        $authuser = Auth::user();
        $relatedQuestions = Question::where('category_id', $question->category_id)->inRandomOrder()->take(6)->get();
        // return $authuser;
        return view('qa.question', compact('question','relatedQuestions'));
    }

    public function showAllQuestions(){
        $latestQuestions = Question::orderBy('created_at', 'desc')->with('answers')->with('user')->take(200)->paginate(20);
        $mostAnswerQues = Question::orderBy('answers_count', 'desc')->take(200)->paginate(20);
        $randomQuestions = Question::orderBy('created_at', 'desc')->inRandomOrder()->take(10)->get();
        return view('qa.list', compact('latestQuestions','mostAnswerQues','randomQuestions'));
    }

    public function likeAnswer(Request $request){
        if (Auth::check())
        {
            $user = User::find(Auth::id());
            $answer = Answer::find($request->answerid);
            $user->toggleLike($answer); 
            if (Auth::user()->hasLiked($answer)){
                activity()
                ->causedBy(Auth::id())
                ->performedOn($answer)
                ->log(':causer.name Liked the Answer');
            if ($answer->likers()->count() > 1){
                $total = $answer->likers()->count() - 1;
                $likecpy = 'you and '. $total  .' more <i class="icon-thumbs-up"></i> this';
            }
            else{
                $likecpy = 'you  <i class="icon-thumbs-up"></i> this    ';
            }
        }
            else{
                activity()
                ->causedBy(Auth::id())
                ->performedOn($answer)
                ->log(':causer.name Uniked the Answer');
                if($answer->likers()->count() > 0){
                    $likecpy = $answer->likers()->count().' <i class="icon-thumbs-up"></i>';
                }
                else {
                    $likecpy = 'Be the first one to  <i class="icon-thumbs-up"></i> this';
                }
            }

            $arr = array('msg' => 'Successfully stored', 'status' =>  $user->hasLiked($answer), 'count'=> $answer->likers()->count(),'likecpy' => $likecpy);
            return Response()->json($arr);
        }
    }

    public function deleteanswer(Request $request, $answerid){
        if (Auth::check()){
            $answer = Answer::find($answerid);
            $check = Answer::where('id',$answerid)->where('user_id', Auth::id())->delete();
            $question = Question::where('id', $request->question_id)
                        ->update([
                        'answers_count'=> DB::raw('answers_count-1'), 
                        ]);
            if ($check){
                activity()
                ->causedBy(Auth::id())
                ->performedOn($answer)
                ->log(':causer.name deleted an Answer');
                $arr = array('msg' => 'Successfully deleted', 'status' =>  'Deleted');
                return Response()->json($arr);
            }
            else{
                $arr = array('msg' => 'Failed', 'status' =>  'Failed');
                return Response()->json($arr);
            }
        }
    }

    public function answerSubmit(Request $request){
        if (Auth::check())
        {   
            // Modify Request
            $user = User::find($request->member_id); 
            $request->merge([
                'user_id' => Auth::id(),
            ]);
            request()->validate([
            'answer' => 'required',
            'question_id' => 'required|numeric'
            ]);
            $data = $request->all();
            $check = Answer::create($data);
            $question = Question::where('id', $request->question_id)
                        ->update([
                        'answers_count'=> DB::raw('answers_count+1'), 
                        ]);
            $arr = array('msg' => 'Something goes to wrong. Please try again later', 'status' => false);
            if($check){ 
                activity()
                ->causedBy(Auth::id())
                ->performedOn($check)
                ->log(':causer.name Answered a Question');
            $arr = array('msg' => 'Successfully stored', 'status' => true);
            }
            return Response()->json($arr);
        }
    }
    public function answerEdit(Request $request){
        if (Auth::check())
        {   
            request()->validate([
            'answer' => 'required',
            'answer_id' => 'required|numeric'
            ]);
            $data = $request->all();
            $check = Answer::find($request->answer_id)->update(['answer' => $request->answer]);
            $answer = Answer::find($request->answer_id);
            $arr = array('msg' => 'Something goes to wrong. Please try again later', 'status' => false);
            if($check){ 
                activity('stream')
                ->causedBy(Auth::id())
                ->performedOn($answer)
                ->log(':causer.name Modified the answer');
            $arr = array('msg' => 'Successfully stored', 'status' => true);
            }
            return Response()->json($arr);
        }
    }
}
