<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;
use App\Models\User;


class ContactController extends Controller
{
    public function index() {
      
        return view('welcome');
    }
 
    public function create() {        
        return view('contacts.create');
    }

    public function store(Request $request) {

        $contact = new Contact;

        $contact->name = $request->name;
        $contact->contact = $request->contact; 
        $contact->email = $request->email;

        $user = auth()->user();
        $contact->user_id = $user->id;

        $contact->save();

        return redirect('/')->with('msg', 'Contact created successfully!');

    }
    
    public function show($id){

        $contact = Contact::findOrfail($id);

        $user = auth()->user();
        $hasUserJoined = false;


        //Contact Owner
        $contactOwner = User::where('id', '=', $contact->user_id)->first()->toArray();

        return view('contacts.show', ['contact' => $contact, 'contactOwner' => $contactOwner, 'hasUserJoined' => $hasUserJoined]);    
    }

   

    public function dashboard() {
        $user = auth()->user();
        $contacts = $user->contacts;

        $search = request('search');

        if($search) {

            $contacts = Contact::where([
                ['name','like','%'.$search.'%']
            ])->get();

        } else {
            $contacts = Contact::all();
        }
        
        return view('contacts.dashboard', ['contacts' => $contacts, 'search' => $search]);
    }
    

    public function destroy($id){

        Contact::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Contact deleted successfully!');

    }

    public function edit($id){

        $user = auth()->user();

        $contact = Contact::findOrFail($id);

        if($user->id != $contact->user->id) {
            return redirect('/dashboard')->with('msg','You cannot edit contacts through this method.');
        }

        return view('/contacts.edit', ['contact' => $contact]);

    }
    
    public function update(Request $request){

        $data = $request->all();

        Contact::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Contact updated successfully!');

    }

    

}