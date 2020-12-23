@foreach (session('flash_notification', collect())->toArray() as $message)
    <div
        class="alert alert-{{ $message['level'] }}{{ $message['important'] ? ' alert-important' : '' }}"
        @if($message['level'] == 'validation')
            style="background-color:{{ config('flash.validationBgColor') }};border:1px solid {{ config('flash.validationBorderColor') }}"
        @endif
        role="alert"
    >
        @if (!$message['important'])
            @if(config('flash.bootstrapVersion') == 3)
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            @else
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            @endif
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
