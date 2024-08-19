<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('question.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="question" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        Question:
                    </label>

                    <textarea id="question" rows="4"
                        class="{{ $errors->has('question') ? 'is-invalid' : 'block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' }}"
                        placeholder="Ask your question here" name="question">{{ old('question') }}</textarea>

                    @error('question')
                        <span class="text-red-500 text-sm mt-1 dark:text-red-400">{{ $errors->first('question') }}</span>
                    @enderror
                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Send</button>
            </form>

            <hr class="border-gray-700 border-dashed my-4">

            <div class="grid grid-cols-1 gap-4">
                @foreach ($questions as $question)
                    <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 flex justify-between">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $question->question }}</h3>
                            <div class="flex space-x-2">
                                <form :action="route('question.like', $question - > id)" method="POST">
                                    @csrf
                                    <button type="button">
                                        <x-icons.thumbs-down id="thumbs-down"
                                            class="w-5 h-5 text-gray-300 hover:text-gray-600 cursor-pointer" />
                                        <span class="text-red-600">

                                            {{ $question->unlikes }}
                                        </span>
                                    </button>
                                </form>
                                <form action="{{ route('vote.store', $question) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit">
                                        <x-icons.thumbs-up id="thumbs-up"
                                            class="w-5 h-5 text-gray-300 hover:text-gray-600 cursor-pointer" />
                                        <span class="text-green-600">
                                            {{ $question->likes }}
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
</x-app-layout>
