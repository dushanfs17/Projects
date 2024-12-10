<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactFormController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone_number' => 'required|string|max:20',
            'country' => 'required|in:Macedonia,Germany,Austria,USA,Russia',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contactMessage = ContactForm::create($validated);
        Log::info('New contact message created: ' . $contactMessage->id);
        return response()->json(['message' => 'Your message has been received!'], 201);;
    }

    public function update(Request $request, $id)
    {
        $message = ContactForm::findOrFail($id);
        $message->update($request->all());
        return response()->json(['message' => 'Message updated successfully!'], 201);
    }

    public function show($id)
    {
        $message = ContactForm::findOrFail($id);

        $message->update(['is_read' => true]);

        return view('message.show', compact('message'));
    }

    public function destroy($id)
    {
        $message = ContactForm::findOrFail($id);

        $message->delete();

        return redirect()->route('dashboard')->with('Message deleted successfully.');
    }

    public function markAsRead($id)
    {
        $message = ContactForm::findOrFail($id);
        $message->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}
