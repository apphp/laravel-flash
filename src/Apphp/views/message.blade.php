@foreach (session('flash_notification', collect())->toArray() as $message)
    <div class="alert alert-{{ $message['level'] }}{{ $message['important'] ? ' alert-important' : '' }}" role="alert">
        @if (!$message['important'])
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        @endif
        @if($message['title'])
            <h4 class="alert-heading">{{$message['title']}}</h4>
            @if($message['message'])
                <hr>
                <p class="mb-0">{!! $message['message'] !!}</p>
            @endif
        @else
            {!! $message['message'] !!}
        @endif
    </div>
@endforeach
{{ session()->forget('flash_notification') }}
