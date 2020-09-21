<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AskQuestion;
use App\Newsletter;
use App\Lead;

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
        $check = AskQuestion::insert($data);
        $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' => false);
        if($check){ 
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
        $check = Lead::insert($data);
        $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' => false);
        if($check){ 
        $arr = array('msg' => 'Successfully stored', 'status' => true);
        }
        return Response()->json($arr);
       
    }
}
