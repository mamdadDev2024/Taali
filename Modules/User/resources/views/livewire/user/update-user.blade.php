<div class="max-w-md mx-auto bg-white dark:bg-gray-900 p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">{{ __('Update Profile') }}</h2>
    <form wire:submit.prevent="updateUser" class="space-y-4">


        <div class="flex justify-center mb-4" wire:target="uploadedImage" wire:loading.class="blur-md">
            @if ($uploadedImage)
                <img class="w-24 h-24 object-cover rounded-full border" src="{{ $uploadedImage->temporaryUrl() }}" alt="Preview">
            @elseif ($existingImagePath)
                <img class="w-24 h-24 object-cover rounded-full border" src="{{ asset($existingImagePath) }}" alt="Current Avatar">
            @else
                <img class="w-24 h-24 object-cover rounded-full border" src="{{ asset('profile-pictures/default-avatar.png') }}" alt="Default Avatar">
            @endif
        </div>

        <div>
            <x-form.label for="name">{{ __('Name') }}</x-form.label>
            <x-form.input type="text" wire="name" name="name" placeholder="Your Name" />
            <x-form.error name="name" />
        </div>

        <div>
            <x-form.label for="email">{{ __('Email') }}</x-form.label>
            <x-form.input type="email" wire="email" name="email" placeholder="you@example.com" />
            <x-form.error name="email" />
        </div>

        <div>
            <x-form.label for="image">{{ __('Profile Picture') }}</x-form.label>
            <x-form.file wire="uploadedImage" />
            <x-form.error name="image" />

            <div wire:loading wire:target="uploadedImage" class="text-gray-500 mt-1 text-sm">
                {{ __('Uploading...') }}
            </div>
        </div>

        <x-button-primary type="submit">{{ __('Update Profile') }}</x-button-primary>
    </form>
</div>
