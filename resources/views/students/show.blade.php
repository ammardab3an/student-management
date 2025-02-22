<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <!-- Student Details -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Student Information') }}</h3>
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Name:') }}</p>
                            <p class="text-sm text-gray-900 dark:text-gray-100">{{ $student->name }}</p>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Age:') }}</p>
                            <p class="text-sm text-gray-900 dark:text-gray-100">{{ $student->age }}</p>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Residence:') }}</p>
                            <p class="text-sm text-gray-900 dark:text-gray-100">{{ $student->residence }}</p>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Created At:') }}</p>
                            <p class="text-sm text-gray-900 dark:text-gray-100">{{ $student->created_at }}</p>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Updated At:') }}</p>
                            <p class="text-sm text-gray-900 dark:text-gray-100">{{ $student->updated_at }}</p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-6 flex space-x-4">
                        @if (auth()->user()->is_admin)
                        <a href="{{ route('students.edit', $student) }}" class="mb-4 ml-3 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Edit Student') }}
                        </a>
                        <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="mb-4 ml-3 bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded">
                                {{ __('Delete Student') }}
                            </button>
                        </form>
                        @endif
                        <a href="{{ route('students.index') }}" class="mb-4 ml-3 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Back to List') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
