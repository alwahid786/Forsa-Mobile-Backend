<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;


class ContactController extends Controller
{
    use ResponseTrait;

    // Contact Us function 
    public function contactUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'description' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError(implode(",", $validator->messages()->all()));
        }
        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->description = $request->description;
        $status = $contact->save();
        if ($status) {
            return $this->sendResponse([], 'Contact Request Sent Successfully!');
        }
        return $this->sendError('Something went wrong! try again later');
    }
}
