<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class ChatbotController extends Controller
{
    public function index()
    {
        // Menampilkan halaman chat
        return view('chatbot.index');
    }

    public function send(Request $request)
    {
        $userInput = $request->input('message');

        try {
            $response = OpenAI::chat()->create([
                'model' => 'llama-3.3-70b-versatile',
                'messages' => [
                    ['role' => 'system', 'content' => 'Anda adalah Guru BK AI yang empati.'],
                    ['role' => 'user', 'content' => $userInput],
                ],
            ]);

            $reply = $response->choices[0]->message->content;
            return back()->with('reply', $reply)->with('user_message', $userInput);

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal terhubung ke AI: ' . $e->getMessage());
        }
    }
}