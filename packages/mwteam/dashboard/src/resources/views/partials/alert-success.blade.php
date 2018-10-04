<div class="alert alert-success">
    @if(count($messages) > 1)
        <ul class="ul-error">
            @foreach($messages as $message)
                <li>{{$message}}</li>
            @endforeach
        </ul>
    @else
        <span>{{array_first($messages)}}</span>
    @endif
</div>