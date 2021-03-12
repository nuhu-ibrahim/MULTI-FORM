<?php

namespace App\Controllers;

use App\Models\Contact;
use Core\Request\Request;
use Core\Validation\Validator;
use \Tamtamchik\SimpleFlash\Flash;

class PagesController extends BaseController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Contact();
    }

    public function index()
    {
        return view('index');
    }

    public function contacts()
    {
        // at a later point, you can convert it back to array like:
        $recoveredData = file_get_contents(gwd()."/contacts.txt");

        // unserializing to get actual array
        $contacts = unserialize($recoveredData);

        return view('contacts', ["contacts" => $contacts]);
    }

    public function store()
    {
        $request = new Request();
        $validator = new Validator();

        $rules = [
            [
                'fieldName' => 'name',
                'type' => 'text',
                'minLength' => 2,
                'maxLength' => 50,
                'required' => true,
            ],
            [
                'fieldName' => 'email',
                'type' => 'email',
                'minLength' => 3,
                'maxLength' => 50,
                'required' => true,
            ],
            [
                'fieldName' => 'number',
                'type' => 'phone',
                'minLength' => 5,
                'maxLength' => 15,
                'required' => true,
            ],
        ];

        // Get all the entries and turn then into an array
        $contacts = array();
        $generalValidity = true;
        foreach($request->post("name") as $key => $name){
            $validator = new Validator();

            $phone = $request->post("number")[$key];
            $email = $request->post("email")[$key];

            $contact_array = [
                "name" => $name,
                "number" => $phone,
                "email" => $email
            ];

            $contact = new Contact($contact_array);

            if(!$validator->validate($rules, $contact_array)) $generalValidity = false;

            $contacts[$key] = array(
                'contact' => $contact, 
                'isValid' => $validator->isValid(), 
                'errors' => $validator->getErrors()
            );
        }

        if($generalValidity){
            // serialize your input array (say $array)
            $serializedData = serialize($contacts);

            // save serialized data in a text file
            file_put_contents(gwd()."/contacts.txt", $serializedData);

            flash()->success('Your contacts have been saved successfully.');

            return redirect("contacts");
        }

        return view('contacts', ["contacts" => $contacts]);
    }
}
