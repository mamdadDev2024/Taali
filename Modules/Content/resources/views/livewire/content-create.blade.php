<div class="max-w-3xl mx-auto p-6 sm:p-8 bg-white dark:bg-gray-900 rounded-2xl shadow-lg dark:shadow-xl transition-colors duration-300">

    <h1 class="text-2xl font-semibold mb-6 text-gray-900 dark:text-gray-100">
        {{ __('Create Content') }}
    </h1>

    <form wire:submit.prevent="save" class="space-y-6">

        <!-- Title -->
        <div class="space-y-1">
            <x-form.label for="title">{{ __('Title') }}</x-form.label>
            <x-form.input type="text" wire:model.defer="title" id="title"
                          class="bg-gray-50 dark:bg-gray-800 border-gray-300 dark:border-gray-700
                                 text-gray-900 dark:text-gray-100"
                          placeholder="{{ __('Enter title') }}" />
            <x-form.error name="title" />
        </div>
        <!-- Excerpt -->
        <div class="space-y-1">
            <textarea
                wire:model.defer="exerpt"
                id="exerpt"
                rows="5"
                class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700
                    text-gray-900 dark:text-gray-100 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                placeholder="{{ __('Full exerpt or content body') }}">
            </textarea>
            <x-form.error name="exerpt" />
        </div>

        <!-- Description -->
        <div class="space-y-1">
                <textarea
                    wire:model.defer="description"
                    id="description"
                    rows="5"
                    class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700
                        text-gray-900 dark:text-gray-100 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                    placeholder="{{ __('Full description or content body') }}">
                </textarea>
                <x-form.error name="description" />
        </div>

        <!-- Type -->
        <div class="space-y-1">
            <x-form.label for='type'>{{ __('Content Type') }}</x-form.label>
            <div class="flex flex-wrap gap-4">
                @foreach(['article','video','audio','post'] as $typeOption)
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" wire:model.defer="type" value="{{ $typeOption }}"
                               class="accent-indigo-600 dark:accent-indigo-400" />
                        <span class="text-gray-700 dark:text-gray-200 capitalize">{{ __($typeOption) }}</span>
                    </label>
                @endforeach
            </div>
            <x-form.error name="type" />
        </div>

        <!-- Image Upload -->
        <div class="space-y-1">
            <x-form.label for="image">{{ __('Image') }}</x-form.label>
            <x-form.file wire:model="image" id="image"
                         class="bg-gray-50 dark:bg-gray-800 border-gray-300 dark:border-gray-700
                                text-gray-900 dark:text-gray-100" />
            <x-form.error name="image" />

            @if($image)
                <div class="mt-2">
                    <img src="{{ $image->temporaryUrl() }}" alt="Preview"
                         class="w-32 h-32 object-cover rounded-lg border border-gray-300 dark:border-gray-700 shadow-sm" />
                </div>
            @endif
        </div>

        <!-- Audio Upload -->
        <div class="space-y-1">
            <x-form.label for="audio">{{ __('Audio File') }}</x-form.label>
            <x-form.file wire:model="audio" id="audio"
                         class="bg-gray-50 dark:bg-gray-800 border-gray-300 dark:border-gray-700
                                text-gray-900 dark:text-gray-100" />
            <x-form.error name="audio" />

            @if($audio)
                <div class="mt-2">
                    <audio controls class="w-full">
                        <source src="{{ $audio->temporaryUrl() }}">
                        {{ __('Your browser does not support the audio element.') }}
                    </audio>
                </div>
            @endif
        </div>

        <!-- Video URL -->
        <div class="space-y-1">
            <x-form.label for="videoUrl">{{ __('Video URL') }}</x-form.label>
            <x-form.input type="url" wire:model.defer="videoUrl" id="videoUrl"
                          class="bg-gray-50 dark:bg-gray-800 border-gray-300 dark:border-gray-700
                                 text-gray-900 dark:text-gray-100"
                          placeholder="{{ __('https://example.com/video') }}" />
            <x-form.error name="videoUrl" />
        </div>

        <!-- Submit -->
        <div class="pt-4">
            <x-button-primary type="submit" class="w-full py-3 text-lg">
                {{ __('Create Content') }}
            </x-button-primary>
        </div>

    </form>
</div>
