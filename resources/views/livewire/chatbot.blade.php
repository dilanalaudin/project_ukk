<div x-data="{ open: @entangle('isOpen'), scrollChat() { $nextTick(() => { const container = $refs.chatContainer; container.scrollTop = container.scrollHeight; }); } }" 
     x-init="$watch('messages', () => scrollChat())"
     class="relative">
    
    {{-- Floating Action Button --}}
    <button @click="open = !open; if(open) scrollChat();" 
            class="fixed bottom-6 right-6 w-16 h-16 bg-indigo-600 text-white rounded-full shadow-2xl hover:scale-110 active:scale-95 transition-all duration-300 flex items-center justify-center z-[9999] group overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-tr from-indigo-700 to-violet-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        <template x-if="!open">
            <svg class="w-8 h-8 relative z-10 transition-transform duration-500 rotate-0 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
        </template>
        <template x-if="open">
            <svg class="w-8 h-8 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </template>
    </button>

    {{-- Chat Window --}}
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-12 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-12 scale-95"
         class="fixed bottom-24 right-6 w-[380px] md:w-[420px] max-h-[600px] h-[80vh] bg-white/90 backdrop-blur-xl border border-white/20 rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.15)] flex flex-col overflow-hidden z-[9998] border border-indigo-100">
        
        {{-- Glass Header --}}
        <div class="bg-indigo-600/90 backdrop-blur-md px-6 py-5 text-white shadow-lg relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 blur-2xl"></div>
            <div class="flex items-center gap-4 relative z-10">
                <div class="relative">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm border border-white/30">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-400 border-2 border-indigo-600 rounded-full shadow-sm animate-pulse"></div>
                </div>
                <div>
                    <h3 class="font-bold text-lg tracking-tight">BK AI
                    <p class="text-xs text-indigo-100 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full"></span>
                        Siap mendengarkan & membantu
                    </p>
                </div>
            </div>
        </div>

        {{-- Chat Messages --}}
        <div x-ref="chatContainer" 
             class="flex-1 overflow-y-auto p-6 space-y-6 scroll-smooth custom-scrollbar bg-gradient-to-b from-slate-50 to-white">
            
            @foreach($messages as $msg)
                @if($msg['role'] !== 'system')
                    <div class="flex {{ $msg['role'] === 'user' ? 'justify-end' : 'justify-start' }} animate-in fade-in slide-in-from-bottom-2 duration-300">
                        @if($msg['role'] !== 'user')
                            <div class="flex flex-col gap-1 w-full">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-2 mb-1">Guru BK AI</span>
                                <div class="max-w-[85%] p-4 rounded-2xl text-sm bg-white border border-slate-100 shadow-sm text-slate-700 leading-relaxed rounded-tl-none prose prose-sm">
                                    {!! $msg['content'] !!}
                                </div>
                            </div>
                        @else
                            <div class="max-w-[80%] p-4 rounded-2xl text-sm bg-indigo-600 text-white shadow-md shadow-indigo-100 leading-relaxed rounded-tr-none">
                                {{ $msg['content'] }}
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach
            
            @if($isTyping)
                <div class="flex justify-start animate-pulse">
                    <div class="bg-slate-100 px-4 py-3 rounded-2xl rounded-tl-none flex gap-1 items-center">
                        <div class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce"></div>
                        <div class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce [animation-delay:-0.15s]"></div>
                        <div class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce [animation-delay:-0.3s]"></div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Quick Suggestions --}}
        @if(empty($userInput) && !$isTyping)
        <div class="px-6 py-2 flex flex-wrap gap-2 overflow-x-auto no-scrollbar">
            <button wire:click="$set('userInput', 'Tips belajar efektif?')" class="whitespace-nowrap px-3 py-1.5 text-xs bg-indigo-50 text-indigo-700 rounded-full border border-indigo-100 hover:bg-indigo-100 transition-colors">📚 Tips Belajar</button>
            <button wire:click="$set('userInput', 'Cara mengelola stress?')" class="whitespace-nowrap px-3 py-1.5 text-xs bg-violet-50 text-violet-700 rounded-full border border-violet-100 hover:bg-violet-100 transition-colors">🧘 Atasi Stress</button>
            <button wire:click="$set('userInput', 'Bingung pilih jurusan...')" class="whitespace-nowrap px-3 py-1.5 text-xs bg-emerald-50 text-emerald-700 rounded-full border border-emerald-100 hover:bg-emerald-100 transition-colors">🎓 Karir/Jurusan</button>
        </div>
        @endif

        {{-- Input Area --}}
        <div class="p-4 bg-white border-t border-slate-100">
            <form wire:submit.prevent="sendMessage" class="flex items-center gap-2 bg-slate-50 p-1.5 rounded-2xl border border-slate-200 focus-within:border-indigo-400 focus-within:ring-4 focus-within:ring-indigo-50 transition-all duration-200">
                <input wire:model="userInput" 
                       type="text" 
                       placeholder="Ceritakan apa yang kamu rasakan..." 
                       class="flex-1 bg-transparent border-none focus:ring-0 text-sm px-3 py-2 text-slate-700 placeholder:text-slate-400" 
                       autocomplete="off">
                <button type="submit" 
                        wire:loading.attr="disabled" 
                        class="w-10 h-10 bg-indigo-600 text-white rounded-xl flex items-center justify-center hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-100 disabled:opacity-50">
                    <svg class="w-5 h-5 translate-x-0.5 -translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </form>
            <p class="text-[10px] text-center text-slate-400 mt-2">AI asisten tidak menggantikan konseling tatap muka.</p>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</div>
