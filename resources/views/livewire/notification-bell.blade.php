<div class="relative" x-data="{ open: false }">
    <!-- Bell Icon -->
    <button @click="open = !open" class="relative p-2 text-gray-600 hover:text-indigo-600 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
            </path>
        </svg>
        
        @if($unreadCount > 0)
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/4 -translate-y-1/4 bg-red-600 rounded-full">
                {{ $unreadCount }}
            </span>
        @endif
    </button>

    <!-- Dropdown Panel -->
    <div x-show="open" 
         @click.away="open = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute right-0 z-50 w-80 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
         style="display: none;">
        
        <div class="py-1">
            <div class="px-4 py-2 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-sm font-semibold text-gray-700">Notifikasi</h3>
                @if($unreadCount > 0)
                    <button wire:click="markAllAsRead" class="text-xs text-indigo-600 hover:text-indigo-800">
                        Tandai semua dibaca
                    </button>
                @endif
            </div>

            <div class="max-h-64 overflow-y-auto">
                @forelse($notifications as $notification)
                    <div class="px-4 py-3 hover:bg-gray-50 border-b border-gray-100 cursor-pointer {{ $notification->read_at ? 'opacity-75' : 'bg-blue-50' }}"
                         wire:click="markAsRead('{{ $notification->id }}')">
                        <div class="flex items-start">
                             <div class="flex-shrink-0">
                                @if(isset($notification->data['icon']))
                                    <!-- Simple icon mapping or default -->
                                    <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-3 w-0 flex-1">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $notification->data['title'] ?? 'Notifikasi' }}
                                </p>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $notification->data['details'] ?? '' }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-4 py-6 text-center text-gray-500 text-sm">
                        Tidak ada notifikasi.
                    </div>
                @endforelse
            </div>
            
        </div>
    </div>
</div>
