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

    public function store(Request $request)
    {
        $request->validate([
            'countrycode' => 'required',
            'number' => 'required|digits:9',
        ], [
            'countrycode.required' => 'The country code field is required.',
            'number.required' => 'The number field is required.',
            'number.digits' => 'The number field must be exactly 9 digits.',
        ]);
    
        $contact = new Contact;
    
        $contact->countrycode = $request->countrycode;
        $contact->number = $request->number;
    
        $user = auth()->user();
        $contact->user_id = $user->id;
    
        $contact->save();
    
        return redirect('/contacts/dashboard')->with('msg', 'Contact created successfully!');
    }


    
    public function show($id){

        $contact = Contact::findOrfail($id);

        $user = auth()->user();
        $hasUserJoined = false;


        //Contact Owner
        $contactOwner = User::where('id', '=', $contact->user_id)->first()->toArray();

        return view('contacts.show', ['contact' => $contact, 'contactOwner' => $contactOwner, 'hasUserJoined' => $hasUserJoined]);    
    }

   

    public function dashboard()
    {
        // Obtenha o usuário autenticado
        $user = auth()->user();
    
        // Obtenha apenas os contatos relacionados ao usuário autenticado
        $contacts = $user->contacts;
    
        // Verifique se há um parâmetro de pesquisa
        $search = request('search');
    
        // Se houver uma pesquisa, filtre os contatos com base na pesquisa
        if ($search) {
            $contacts = Contact::where('number', 'like', '%' . $search . '%')->where('user_id', $user->id)->get();
        }
    
        // Retorne a view do dashboard, passando os contatos e a pesquisa como parâmetros
        return view('contacts.dashboard', ['contacts' => $contacts, 'search' => $search, 'user' => $user]);
    }

    

    public function destroy($id){

        Contact::findOrFail($id)->delete();

        return redirect('/contacts/dashboard')->with('msg', 'Contact deleted successfully!');

    }

 
    public function edit($id)
    {
        // Localize o contato pelo ID fornecido
        $contact = Contact::findOrFail($id);
    
        // Verifique se o contato pertence ao usuário autenticado antes de permitir a edição
        $user = auth()->user();
        if ($user->id !== $contact->user_id) {
            return redirect('/contacts/dashboard')->with('msg', 'You are not authorized to edit this contact.');
        }
    
        // Retorne a view de edição, passando o contato como parâmetro
        return view('contacts.edit', ['contact' => $contact]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'countrycode' => 'required',
            'number' => 'required|digits:9',
        ], [
            'countrycode.required' => 'The country code field is required.',
            'number.required' => 'The number field is required.',
            'number.digits' => 'The number field must be exactly 9 digits.',
        ]);
    
        $contact = Contact::findOrFail($id);
    
        $contact->countrycode = $request->countrycode;
        $contact->number = $request->number;
    
        $contact->save();
    
        return redirect('/contacts/dashboard')->with('msg', 'Contact updated successfully!');
    }



    

}