<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    public function Contact(){
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }

    public function AddContact(Request $request){

        $validate = $request->validate([
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        DB::table('contact_forms')->insert([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success','Inserted Inserted contact successfully');
    }

    public function EditContact($id){
        $contact = DB::table('contacts')->find($id);
        return view('admin.contact.edit', compact('contact'));
    }

    public function UpdateContact(Request $request, $id){
    Contact::find($id)->update([
        'address' => $request->address,
        'phone' => $request->phone,
        'email' => $request->email,
        'created_at' => Carbon::now()
    ]);
    return redirect()->back()->with('success','Updated successfully');

    }

    public function DeleteContact($id){
        $contact = Contact::find($id)->delete();

        return redirect()->back()->with('success','Deleted successfully');
    }

    public function HomeContact(){
        return view('layouts.pages.contact');
    }

    public function StoreForm(Request $request){

        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'subject' => $request->subject
        ]);

        return redirect()->route('contactform')->with('success','Added successfully');
    }

    public function AdminMessage(){
        $messages = ContactForm::all();
        return view('admin.contact.message', (compact('messages')));
    }

    public function DeleteMessage($id){
        $message = ContactForm::find($id)->delete();
        return redirect()->back()->with('success','Deleted successfully');
    }


}
