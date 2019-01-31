@if($breadcrumbs)
    @section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach($breadcrumbs as $bc)
                @if( ! empty($bc['href']))
                    <li class="breadcrumb-item"><a href="{{ $bc['href'] }}">{{ $bc['text'] }}</a></li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">{{ $bc['text'] }}</li>
                @endif
            @endforeach
        </ol>
    </nav>
    @endsection
@endif
