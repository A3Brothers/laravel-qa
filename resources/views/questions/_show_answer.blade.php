<answer :answer="{{ $answer }}" v-slot="{ pressed, editing, edit, cancel, update, bodyHtml, body, onInput, isInvalid}">
    <div class="flex">
        <div class="flex flex-col w-1/12 justify-center items-center">

            @include('questions._question_answer_voting', ['model'=> $answer, 'uri'=> 'answer.vote'])

            @can('accept', $answer)
                <div onclick="event.preventDefault(); getElementById('accept-answer-{{ $answer->id }}').submit();" class="cursor-pointer w-10 text-center">
                    <i class="{{$answer->status}} hover:text-green-600 fas fa-check fa-lg"></i>
                </div>
                <form action="{{ route('answers.accept', $answer->id) }}"method="POST" id="accept-answer-{{ $answer->id }}" style="display: none;">
                    @csrf
                </form>
            @else
                @if ($answer->is_best)
                    <div class="cursor-pointer w-10 text-center">
                        <i class="{{$answer->status}} hover:text-green-600 fas fa-check fa-lg"></i>
                    </div>
                @endif
            @endcan
            
        </div>

        <div class="w-11/12">

                <li class="border-b-2 my-4 bg-gray-50">

                    <div v-if="editing">
                        <form @submit.prevent="update">
                            <textarea required class="w-full" :value="body" @input="event => onInput(event, 'body')"  name="" id="" cols="30" rows="10"></textarea>
                            <button class="bg-blue-400 text-white rounded border w-20 hover:bg-blue-500" :disabled="isInvalid">Update</button>
                            <button @click="cancel" class="bg-red-400 text-white rounded border w-20 hover:bg-red-500">Cancel</button>

                        </form>
                    </div>

                    <div v-if="!editing">
                        <div v-html="bodyHtml">{bodyHtml}</div>
                    </div>


                    <div v-if="!editing" class="flex mt-4">
                        
                        @can('update', $answer)
                        <div @click="edit" class="h-7 bg-blue-400 mr-2 cursor-pointer px-4 text-white rounded border-black hover:bg-blue-500" >Edit</div>
                        @endcan

                        @can('delete', $answer)
                        <div class="h-7 bg-red-400 cursor-pointer px-4 text-white rounded border-black hover:bg-red-500">
                            <form action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}" method="post" onclick="return confirm('are you sure!')">
                            @csrf
                            @method('delete')
                            <button>Delete</button>
                            </form>
                        </div>                                        
                        @endcan
                    </div>

                    <user-info :model="{{$answer}}" label="Answered"></user-info>
                    
                
                </li>
        </div>
    </div>
</answer>

