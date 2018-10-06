<div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a href="{{route('dashboard.home')}}" class="breadcrumb-item">خانه</a>

        @foreach($breadcrumbs as $breadcrumb)
            @if(is_null($breadcrumb['url']))
                <span class="breadcrumb-item active">{{$breadcrumb['title']}}</span>
            @else
                <a href="{{$breadcrumb['url']}}" class="breadcrumb-item">{{$breadcrumb['title']}}</a>
            @endif
        @endforeach
    </nav>
</div>