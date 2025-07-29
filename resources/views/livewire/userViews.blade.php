<div>
    <!-- Search Bar -->
    <div class="mb-8">
            <div class="relative">
                <input type="text" wire:model.live.debounce.500ms="search" placeholder="Cari pengguna..." 
                    class="w-full pl-10 pr-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <div class="absolute left-3 top-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
    </div>

    <!-- User Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($users as $user)
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-xl">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold dark:text-white">{{ $user->name }}</h3>
                        @if ($user->role !== 'admin')
                            <p class="text-gray-600 dark:text-gray-300 text-sm">{{ $user->email }}</p>
                        @endif
                    </div>
                </div>
                <div class="flex justify-between text-sm text-gray-500 dark:text-gray-400">
                    <span>Bergabung: {{ $user->created_at->format('d M Y') }}</span>
                    @if($user->id === Auth::id())
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded dark:bg-green-900 dark:text-green-200">Anda</span>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-8">
            <p class="text-gray-500 dark:text-gray-400">Tidak ada pengguna yang ditemukan</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
    <div class="mt-8">
        {{ $users->links() }}
    </div>
    @endif
</div>
