<div class="text-right mb-4">
    <div class="">
        <span class="block">Answered {{$model->created_date}}</span>
        <a href="{{$model->user->url}}">
            <img class="inline-block" src="{{$model->user->avatar}}" alt="">
        </a>
        <a href="{{$model->user->url}}">{{$model->user->name}}</a>
    </div>
</div>