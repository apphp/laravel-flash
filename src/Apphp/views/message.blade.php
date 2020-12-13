@foreach (session('flash_notification', collect())->toArray() as $message)
    <div class="alert alert-{{ $message['level'] }}" role="alert">
        @if ($message['button'])
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        @endif
        {!! $message['message'] !!}
    </div>
@endforeach
{{ session()->forget('flash_notification') }}
