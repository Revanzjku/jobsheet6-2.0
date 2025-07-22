<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <div class="flex justify-between items-center mb-4">
                <input type="text" wire:model.live.debounce.500ms="search" placeholder="Cari user..." class="px-4 py-2 rounded border border-gray-300 dark:bg-gray-900 dark:text-gray-100">
                <a href="{{ route('users.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded transition">+ Tambah User</a>
            </div>

            @if (session()->has('message'))
                <div x-data="{ show: true }" x-show="show" x-transition 
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('message') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" @click="show = false">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" viewBox="0 0 20 20">
                            <title>Close</title>
                            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                        </svg>
                    </span>
                </div>
            @endif

            <div class="mt-6">
                <table class="min-w-full divide-y divide-gray-200 border border-gray-300 dark:border-gray-700 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">No.</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-900 transition">
                            <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">{{ $users->firstItem() + $loop->index }}</td>
                            <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 font-medium">
                                {{ $user->name }}
                                <span class="ml-2 px-2 py-1 rounded bg-purple-100 text-purple-800 text-xs dark:bg-purple-900 dark:text-purple-200">{{ ucfirst($user->role) }}</span>
                            </td>
                            <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded dark:bg-blue-900 dark:text-blue-200">{{ $user->email }}</span>
                            </td>
                            <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                @if($user->role != 'admin')
                                    <a href="{{ route('users.edit', $user->id) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-semibold py-1 px-3 rounded mr-2 transition">Edit</a>
                                    <button wire:click="delete({{ $user->id }})" class="inline-block bg-red-500 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded transition"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">DELETE</button>
                                @else
                                    <span class="inline-block bg-gray-300 text-gray-700 font-semibold py-1 px-3 rounded cursor-not-allowed">Tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($users->isEmpty())
                    <div class="text-center py-6 text-gray-500 dark:text-gray-400">Tidak ada data user.</div>
                @endif

                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>