<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AskQuestion;
use App\Newsletter;
use App\Lead;
use App\Country;
use App\State;
use App\City;


class FormController extends Controller
{
    // Homepage Ask QnA
    public function storeHomeQnA(Request $request)
    {  
        request()->validate([
        'fullname' => 'required',
        'phone' => 'required|regex:/[0-9]{10}/',
        'question' => 'required',
        'category_id' => 'required|numeric'
        ]);
         
        $data = $request->all();
        $check = AskQuestion::create($data);
        $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' => false);
        if($check){ 
            activity()
                ->log('User asked a Question from homepage');
        $arr = array('msg' => 'Successfully stored', 'status' => true);
        }
        return Response()->json($arr);
       
    }

    // Footer Newsletter Subscription
    public function storeNewsletter(Request $request)
    {  
        request()->validate([
        'email' => 'required|email',
        'source' => 'required',
        'contact' => 'regex:/[0-9]{10}/',
        ]);
         
        $data = $request->all();
        $check = Newsletter::insert($data);
        $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' => false);
        if($check){ 
            activity()
                ->log('User subscribed to Newsletter');
        $arr = array('msg' => 'Successfully stored', 'status' => true);
        }
        return Response()->json($arr);
       
    }

    // Contact Us Form
    public function contactFrom(Request $request)
    {  
        request()->validate([
        'email' => 'required|email',
        'firstname' => 'required',
        'lastname' => 'required',
        'subject' => 'required',
        'phone' => 'regex:/[0-9]{10}/',
        'message' => 'required',
        'category_id' => 'required',
        ]);
         
        $data = $request->all();
        $check = Lead::create($data);
        $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' => false);
        if($check){ 
        $arr = array('msg' => 'Successfully stored', 'status' => true);
        }
        return Response()->json($arr);
       
    }

    public function getState(Request $req){
        $country = Country::where('country',$req->country)->first();
        $states = State::where('country_id',$country->id)->get();
        return $states;
    }
    public function getCity(Request $req){
        $states = State::where('state',$req->state)->first();
        $cities = City::where('state_id',$states->id)->get();
        return $cities;
    }
}
