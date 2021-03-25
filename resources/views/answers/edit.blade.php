<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Answer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border">
                <div class="flex justify-between my-3">
                    <p></p>
                    <a class="h-10 w-auto pt-2 bg-green-300 text-center border rounded hover:bg-green-400" href="{{ route('questions.show', $question->slug) }}">Back to question</a>
                </div>

                <div>
                    <form action="{{ route('questions.answers.update', [$question->id, $answer->id]) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="flex flex-col mb-1">
                            <textarea id="commentAnswer" class="@error('body') invalid @enderror" name="body" cols="30" rows="10"> {{old('body', $answer->body)}} </textarea>
                        </div>
                        @error('body')
                                <div class="text-sm mb-2 text-center text-red-600">{{ $message }}</div>
                        @enderror
                        <div class="flex mb-4">
                            <button class="border-black border-2 rounded bg-white w-2/12 text-2xl hover:bg-gray-100">Update Answer</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>