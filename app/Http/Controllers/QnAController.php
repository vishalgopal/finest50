<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use Auth;
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

    public function likeAnswer(Request $request){
        if (Auth::check())
        {
            $user = User::find(Auth::id());
            $answer = Answer::find($request->answerid);
            $user->toggleLike($answer); 
            if (Auth::user()->hasLiked($answer)){
            if ($answer->likers()->count() > 1){
                $total = $answer->likers()->count() - 1;
                $likecpy = 'you and '. $total  .' more <i class="icon-thumbs-up"></i> this';
            }
            else{
                $likecpy = 'you  <i class="icon-thumbs-up"></i> this    ';
            }
        }
            else{
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
}
