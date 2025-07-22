<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($user) ? 'Edit User' : 'Tambah User Baru' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}">
                        @csrf
                        @if(isset($user))
                            @method('PUT')
                        @endif

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1" for="name">Nama</label>
                            <input type="text" name="name" id="name" required
                                value="{{ old('name', $user->name ?? '') }}"
                                class="w-full px-4 py-2 rounded border border-gray-300 dark:bg-gray-900 dark:text-gray-100">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1" for="email">Email</label>
                            <input type="email" name="email" id="email" required
                                value="{{ old('email', $user->email ?? '') }}"
                                class="w-full px-4 py-2 rounded border border-gray-300 dark:bg-gray-900 dark:text-gray-100">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1" for="password">Password</label>
                            <input type="password" name="password" id="password"
                                @if(!isset($user)) required @endif
                                class="w-full px-4 py-2 rounded border border-gray-300 dark:bg-gray-900 dark:text-gray-100"
                                placeholder="{{ isset($user) ? 'Kosongkan jika tidak ingin mengubah password' : '' }}">
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                            {{ isset($user) ? 'Update' : 'Simpan' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>