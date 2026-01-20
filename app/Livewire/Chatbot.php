<?php

namespace App\Livewire;

use Livewire\Component;
use OpenAI; // Import library dasar

class Chatbot extends Component
{
    public $messages = [];
    public $userInput = '';
    public $isOpen = false;
    public $isTyping = false;

    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
        if ($this->isOpen && empty($this->messages)) {
            $name = auth()->user()->name ?? 'Siswa';
            $this->messages[] = [
                'role' => 'assistant', 
                'content' => "Halo **$name**! 👋 Saya adalah Guru BK AI-mu. Ada yang ingin kamu ceritakan atau tanyakan hari ini? Saya di sini untuk mendengarkanmu tanpa menghakimi."
            ];
        }
    }

    public function sendMessage()
    {
        if (empty(trim($this->userInput))) return;

        $this->messages[] = ['role' => 'user', 'content' => $this->userInput];
        $this->isTyping = true;
        
        $currentInput = $this->userInput;
        $this->userInput = '';

        try {
            // PERBAIKAN: Menggunakan withBaseUri (bukan BaseUrl)
            $client = OpenAI::factory()
                ->withApiKey(env('OPENAI_API_KEY'))
                ->withBaseUri('https://api.groq.com/openai/v1') 
                ->withHttpClient(new \GuzzleHttp\Client([
                    'verify' => false, 
                    'timeout' => 30.0,
                ]))
                ->make();

            $userName = auth()->user()->name ?? 'Siswa';
            
            $response = $client->chat()->create([
                'model' => 'llama-3.3-70b-versatile',
                'messages' => [
                    [
                        'role' => 'system', 
                        'content' => "Anda adalah Guru BK (Bimbingan Konseling) yang sangat empati, bijaksana, dan kebapakan/keibuan. 
                        Nama pengguna adalah $userName. Berikan saran yang mendukung kesehatan mental, motivasi belajar, dan pengembangan diri. 
                        Gunakan bahasa Indonesia yang santun namun akrab. 
                        PENTING: Gunakan format Markdown (tebal, list, dll) agar jawabanmu mudah dibaca."
                    ],
                    ...$this->messages
                ],
            ]);

            $content = $response->choices[0]->message->content;
            
            // Sederhana: ubah markdown ke HTML dasar (atau biarkan frontend menangani jika menggunakan library)
            // Di sini kita gunakan parser sederhana agar tidak perlu install library tambahan jika repot
            // Tapi untuk hasil terbaik, kita asumsikan tailwind-typography ada (prose class)
            
            $this->messages[] = [
                'role' => 'assistant',
                'content' => $this->parseMarkdown($content)
            ];
        } catch (\Exception $e) {
            $this->messages[] = [
                'role' => 'assistant', 
                'content' => 'Maaf, sepertinya saya sedang istirahat sebentar. Coba lagi nanti ya! 🙏 Error: ' . $e->getMessage()
            ];
        }

        $this->isTyping = false;
    }

    private function parseMarkdown($text)
    {
        // Parser markdown sangat sederhana untuk bold dan bullet
        $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);
        $text = preg_replace('/^\s*[\-\*]\s+(.*)$/m', '• $1', $text);
        $text = nl2br($text);
        return $text;
    }
    public function render()
    {
        return view('livewire.chatbot');
    }
}