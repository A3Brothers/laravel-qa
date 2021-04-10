@if ($model instanceof App\Models\Question)
    @php
        $modelVote = $model->votes;   
        $isAnswer = false;
    @endphp
@elseif ($model instanceof App\Models\Answer)
    @php
        $modelVote = $model->votes_count; 
        $isAnswer = true;
    @endphp
@endif


<div @if(!$isAnswer) id="upVote" @endif class="@if($isAnswer) upVoteA @endif cursor-pointer w-10 text-center">
    <i class="fas fa-caret-up fa-2x"></i>
</div>

<form @if(!$isAnswer) id="questionUpVote" @endif @if($isAnswer) class="answerUpVote" @endif action="{{route($uri, $model->id)}}" method="post">
@csrf
<input type="hidden" name="vote" value="1">
</form>

<p>{{$modelVote}}</p>


<div @if(!$isAnswer) id="downVote" @endif class="@if($isAnswer) downVoteA @endif cursor-pointer w-10 text-center">
    <i class="text-gray-400 fas fa-caret-down fa-2x"></i>
</div>

<form @if(!$isAnswer) id="questionDownVote" @endif @if($isAnswer) class="answerDownVote" @endif action="{{route($uri, $model->id)}}" method="post">
@csrf
<input type="hidden" name="vote" value="-1">
</form>