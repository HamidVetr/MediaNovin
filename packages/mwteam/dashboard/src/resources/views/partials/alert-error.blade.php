<div class="alert alert-danger">
    <ul class="ul-error">
        @foreach($messages as $message)
            <li>{{$message}}</li>
        @endforeach
    </ul>
</div>