<?php

namespace App\Http\Controllers;

use App\Mail\emails\responseMessage;
use App\Mail\emails\StudentWelcomeEmail;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{

    public function index()
    {
        $data = Message::all();
        return response()->view('cms.orders.index', ['messages' => $data]);
    }

    public function create()
    {
        return response()->view('cms.orders.addOrder');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_university_id' => "required|integer",
            'student_name' => "required|string|max:45",
            'student_email' => "required|email|unique:messages,student_email|max:45",
            'type' => "required|string",
            'title' => "required|string|max:100",
            'message' => "required|string|min:5",
            'image' => "nullable|image|mimes:jpeg,jpg,png|max:1024",
            'urgent' => "nullable|in:on",
        ]);
        if ($validated) {
            $message = new Message;
            $message->student_university_id = $request->input('student_university_id');
            $message->student_name = $request->input('student_name');
            $message->student_email = $request->input('student_email');
            $message->type = $request->input('type');
            $message->title = $request->input('title');
            $message->message = $request->input('message');
            $message->urgent = $request->boolean('urgent');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '_image_' . $message->student_university_id . '.' . $file->getClientOriginalExtension();
                $file->storeAs('message', $imageName, ['disk' => 'public']);
                $message->image = 'message/' . $imageName;
            }
            $saved = $message->save();
            if ($saved) {
                Mail::to($message->student_email)->send(new StudentWelcomeEmail($message));
            }
            return redirect('message/send')->with('success', 'Your Message has been sent successfully, check your email.');
        }
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);
        return response()->view('cms.orders.orderDetails', ['message' => $message]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'response' => "required|string|min:5",
        ]);
        if ($validated) {
            $message = Message::findOrFail($id);
            $message->status = "closed";
            $message->response = $request->input('response');
            $message->closed_date = now();

            $saved = $message->save();
            if ($saved) {
                Mail::to($message->student_email)->send(new responseMessage($message));
            }
            return redirect()->route('message.index');
        }
    }

    public function ShowSearchBar()
    {
        return response()->view('cms.orders.ShowSearchBar');
    }

    public function searchResult(Request $request)
    {
        $value = $request->input('search');
        if ($value) {
            if ($searchResult = Message::where('id', 'LIKE', "%" . $value . "%")->first()) {
                return response()->view('cms.orders.resultSearch', ['message' => $searchResult]);
            } else {
                return redirect('message/search')->with('error', 'You Have Entered an invalid ID.');
            }
        } else {
            return redirect('message/search')->with('error', 'You have entered an empty value');
        }
    }
}