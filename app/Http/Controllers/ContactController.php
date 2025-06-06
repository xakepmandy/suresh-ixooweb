<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact; 
use App\Models\User;
use App\Helpers\MailHelper; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContactMail; 
use Illuminate\Support\Facades\Mail; 

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        
        return view('admin.inquiry.index', compact('contacts'));
        
    }
    public function create()
    {
        return view('admin.inquiry.create');
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|max:255',
        'phone'    => 'required|string|max:20',
        'inquiry'  => 'required|string|max:255',
        'file'     => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',
        'company'  => 'nullable|string|max:255',
        'message'  => 'required|string',
    ]);

    
   if ($request->hasFile('file')) {
        $file = $request->file('file');
        $path = $file->store('contact_files', 'public');
        $imageName = basename($path);
        $data['file'] = $imageName;
        $data['file_path'] = storage_path('app/public/' . $path);
    }

    Contact::create($data);

    MailHelper::sendContactMail($data);

    return back()->with('success', 'Your message has been sent successfully!');
}

    public function show($id)
    {
        // Logic to show a specific contact
        $contact = Contact::findOrFail($id);
         // Set status to pending when viewed
      
        $contact->status = 'resolved';
        $contact->save();
        return view('admin.inquiry.show', compact('contact'));
    }

   
    public function destroy($id)
    {
        // Logic to delete a contact
        $contact = Contact::findOrFail($id);
        if ($contact->file) {
            Storage::disk('public')->delete("contact_files/{$contact->file}");
        }
        Contact::destroy($id);
        return redirect()->route('admin.contacts');
    }
    public function status($id)
    {
        // Logic to change the status of a contact
        return redirect()->route('admin.contacts');
    }
    public function reply($id)
    {
       
        return view('admin.inquiry.reply', compact('id'));
    }

    public function storeReply(Request $request)
    {
        $request->validate([
            'reply_message' => 'required|string|max:1000',
        ]);
        $contact = Contact::findOrFail($request->id);
        $contact->status = 'resolved'; // Update status to resolved
        $contact->save();
        // Send reply email
        $replyData = [
            'name' => $contact->name,
            'email' => $contact->email,
            'reply_message' => $request->reply_message,
        ];
        Mail::to($contact->email)->send(new ContactMail($replyData));
        return redirect()->route('admin.contacts')->with('success', 'Reply sent successfully!');
      
    }
    
}
