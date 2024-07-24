<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- User Details -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">{{ __('User Information') }}</h3>
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-600">{{ __('Name:') }}</p>
                            <p class="text-sm text-gray-900">{{ $user->name }}</p>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-600">{{ __('Email:') }}</p>
                            <p class="text-sm text-gray-900">{{ $user->email }}</p>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-600">{{ __('Admin:') }}</p>
                            <input type="checkbox" disabled {{ $user->is_admin ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm">
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-6 flex space-x-4">
                        <a href="{{ route('users.edit', $user) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Edit User') }}
                        </a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Delete User') }}
                            </button>
                        </form>
                        <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Back to List') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
