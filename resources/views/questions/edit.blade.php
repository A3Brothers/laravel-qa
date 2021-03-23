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
                    <form action="{{route('questions.update', $question->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('questions._formRequest', ['buttonText'=>'Update Question'])
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>