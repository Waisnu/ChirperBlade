<x-app-layout>
    <!-- Main Content Container -->
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">



        <!-- Chirp Creation Form -->
        <form method="POST" action="{{ route('chirps.store') }}">
            @csrf
            <!-- Textarea for Chirp Message -->
            <textarea
                name="message"
                placeholder="{{ __('What\'s on your mind?') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message') }}</textarea>

            <!-- Display Validation Errors for the 'message' field -->
            <x-input-error :messages="$errors->get('message')" class="mt-2" />

            <!-- Chirp Submission Button -->
            <x-primary-button class="mt-4">{{ __('Chirp') }}</x-primary-button>
        </form>




        <!-- Chirp Display Container -->
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">

            <!-- Loop through Chirps and Display Each One -->
            @foreach ($chirps as $chirp)
                <div class="p-6 flex space-x-2">
                    <!-- Chirp Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>

                    <!-- Chirp Content -->
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <!-- User Information -->
                            <div>
                                <span class="text-gray-800">{{ $chirp->user->name }}</span>
                                <small class="ml-2 text-sm text-gray-600">{{ $chirp->created_at->format('j M Y, g:i a') }}</small>
                                @unless ($chirp->created_at->eq($chirp->updated_at))
                                    <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                @endunless
                            </div>

                            <!-- Dropdown for Actions (Edit, Delete) -->
                            @if (auth()->user()->isAuthorized() || $chirp->user->is(auth()->user()))
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>

                                    <!-- Dropdown Content (Edit, Delete) -->
                                    <x-slot name="content">
                                        <!-- Edit Link -->
                                        <x-dropdown-link :href="route('chirps.edit', $chirp)">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>

                                        <!-- Delete Form -->
                                        <form method="POST" action="{{ route('chirps.destroy', $chirp) }}">
                                            @csrf
                                            @method('delete')

                                            <!-- Delete Link with JavaScript Confirmation -->
                                            <x-dropdown-link :href="route('chirps.destroy', $chirp)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            @endif
                        </div>

                        <!-- Chirp Message -->
                        <p class="mt-4 text-lg text-gray-900">{{ $chirp->message }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>