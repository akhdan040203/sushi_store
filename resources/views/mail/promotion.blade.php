<x-mail::message>
# {{ $title }}

@if($image)
<img src="{{ $image }}" alt="Promotion Banner" style="width: 100%; border-radius: 12px; margin-bottom: 20px;">
@endif

{{ $body }}

<x-mail::button :url="$url">
{{ $buttonText }}
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
