<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Questions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border">
                <div class="flex justify-between my-3">
                    <p></p>
                    <a class="bg-white h-10 w-auto pt-2 bg-green-300 text-center border rounded hover:bg-green-400" href="{{ route('questions.index') }}">Back to all questions</a>
                </div>

                <div>
                    <form action="{{route('questions.store')}}" method="POST">
                        @csrf
                        <div class="flex justify-between mb-1">
                            <label class="w-3/12 text-center" for="questiontitle">Question title</label>
                            <input class="w-9/12 @error('title') invalid @enderror" type="text" name="title" id="questiontitle" value="{{old('title', '')}}" placeholder="title...">
                        </div>
                        @error('title')
                                <div class="text-sm mb-2 text-center text-red-600">{{ $message }}</div>
                        @enderror
                        <div class="flex justify-between mb-1">
                            <label class="w-3/12 text-center" for="questionbody">Question body</label>
                            <textarea class="w-9/12 @error('body') invalid @enderror" name="body" id="questionbody" cols="30" rows="10">{{old('body', '')}}</textarea>
                        </div>
                        @error('body')
                                <div class="text-sm mb-2 text-center text-red-600">{{ $message }}</div>
                        @enderror
                        <div class="flex justify-center mb-4">
                            <button class="border rounded bg-green-300 w-2/12 text-2xl hover:bg-green-400">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>