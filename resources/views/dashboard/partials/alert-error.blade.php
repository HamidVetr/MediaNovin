<div class="alert alert-danger">
    <ul>
        @foreach($messages as $message)
            <li>{{$message}}</li>
        @endforeach
    </ul>
</div>