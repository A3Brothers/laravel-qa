<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Questions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border">
                <div class="flex justify-between text-md py-5 px-4 bg-red-100">
                    @include('layouts._messages')
                    <h1>All Questions</h1>
                    <a class="h-10 w-32 pt-2 bg-green-300 text-center border rounded hover:bg-green-400" href="{{ route('questions.create') }}">Ask Question</a>
                </div>

            <div class="flex flex-col justify-between w-8/12 m-auto">
                @foreach ($questions as $question)
                <div class="flex">
                    <div class="flex flex-col w-2/12 border-t-2">
                        <div class="w-1/2 m-auto text-center">
                            <div class="mb-3"><strong class="block text-4xl">{{ $question->votes }}</strong> {{Str::plural('vote', $question->votes)}}</div>
                            <div class="mb-3 {{$question->status}}"><strong class="block text-4xl">{{ $question->answers }}</strong> {{Str::plural('answer', $question->answers)}}</div>
                            <div><strong>{{ $question->views }}</strong> {{Str::plural('view', $question->views)}}</div>
                        </div>
                    </div>
                    <div class="w-10/12 border bg-gray-100 text-red-500 my-2 p-1">
                        <div class="media-body">
                            <div class="flex justify-between">
                                <h3 class="mt-0 font-bold text-xl hover:text-red-800"><a href="{{$question->url}}">{{$question->title}}</a></h3>
                                <div class="flex">
                                    <div class="h-7 bg-blue-400 mr-2 cursor-pointer px-4 text-white rounded border-black hover:bg-blue-500"><a href="{{ route('questions.edit', $question->id) }}">Edit</a></div>
                                    <div class="h-7 bg-red-400 cursor-pointer px-4 text-white rounded border-black hover:bg-red-500">
                                        <form action="{{ route('questions.destroy', $question->id) }}" method="post" onclick="return confirm('are you sure!')">
                                        @csrf
                                        @method('delete')
                                        <button>Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <p class="text-lg">
                                asked by 
                                <a class="hover:text-black text-gray-500" href="{{$question->user->url}}">{{$question->user->name}}</a>
                                <small>{{ $question->created_date }}</small>
                            </p>
                            {{ Str::limit($question->body, 250, '...') }}
                        </div>
                    </div>
                </div>
                
                @endforeach 
            <div class="mt-5"> {{ $questions->links() }} </div>
            </div>

            </div>
        </div>
    </div>
</x-app-layout>