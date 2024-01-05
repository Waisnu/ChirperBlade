<!-- resources/views/profile/partials/update-timezone-form.blade.php -->

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Timezone Settings') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update your account\'s timezone.') }}
        </p>
    </header>

    <form id="timezone-form" method="post" action="{{ route('profile.update.timezone') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="timezone" :value="__('Timezone')" />
            <select id="timezone" name="timezone" class="mt-1 block w-full">
                @if ($timezones)
                    @foreach ($timezones as $value => $label)
                        <option value="{{ $value }}" @if($user->timezone == $value || (empty($user->timezone) && $value === '')) selected @endif>
                            {{ $label }}
                        </option>
                    @endforeach
                @else
                    <option value="" disabled>{{ __('No timezones available') }}</option>
                @endif
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('timezone')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button onclick="submitForm()">{{ __('Update Timezone') }}</x-primary-button>

            @if (session('status') === 'timezone-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 10000)"
                    class="text-sm text-gray-600"
                >{{ __('Timezone updated.') }}</p>
            @elseif (session('status') === 'timezone-not-updated')
                <p id="timezone-not-updated" class="text-sm text-red-600">{{ __('Timezone not updated. It is already set to the selected timezone.') }}</p>
            @endif
        </div>
    </form>

    <script>
        function submitForm() {
            const form = document.getElementById('timezone-form');
            const selectedTimezone = document.getElementById('timezone').value;
            const currentTimezone = '{{ $user->timezone }}';

            if (selectedTimezone !== currentTimezone) {
                form.submit();
                console.log('Timezone updated.');
            } else {
                document.getElementById('timezone-not-updated').innerText = 'Timezone not updated. It is already set to the selected timezone.';
            }
        }
    </script>
</section>
