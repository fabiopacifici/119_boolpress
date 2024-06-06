<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\NewLeadMessage;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class LeadController extends Controller
{


    public function store(Request $request) {


        $data = $request->all();
        // validate
        $validator = Validator::make($data, [
            'name' => 'required',
            'email' =>'required|email',
            'message' =>'required'
        ]);

        // return response json with errors if the validator fails
        if($validator->fails()){
            return response()->json([
                'success'=> false,
                'errors' => $validator->errors()
            ]);
        }

        // create the lead
       /*  $newLead = new Lead();
        $newLead->fill($data);
        $newLead->save(); */
        $newLead = Lead::create($data);

        // send the email
        Mail::to('admin@boolpress.com')->send(new NewLeadMessage($newLead));

        // return the success response
        return response()->json([
            'success'=> true,
            'message' => 'Your message was received successfully'
        ]);
    }


}
