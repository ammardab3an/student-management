<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <!-- User Details -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('User Information') }}</h3>
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Name:') }}</p>
                            <p class="text-sm text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Email:') }}</p>
                            <p class="text-sm text-gray-900 dark:text-gray-100">{{ $user->email }}</p>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Admin:') }}</p>
                            <input type="checkbox" disabled {{ $user->is_admin ? 'checked' : '' }} class="rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm">
                        </div>
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Created At:') }}</p>
                            <p class="text-sm text-gray-900 dark:text-gray-100">{{ $user->created_at }}</p>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Updated At:') }}</p>
                            <p class="text-sm text-gray-900 dark:text-gray-100">{{ $user->updated_at }}</p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-6 flex space-x-4">
                        <a href="{{ route('users.edit', $user) }}" class="mb-4 ml-3 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Edit User') }}
                        </a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="mb-4 ml-3 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Delete User') }}
                            </button>
                        </form>
                        <a href="{{ route('users.index') }}" class="mb-4 ml-3 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Back to List') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
