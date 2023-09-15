<x-mail::message>
# Introduction

Hello, {{ $login }}! Click the button for verified your email address.

<x-mail::button url="{{ $url }}" color="success">
Verify Email
</x-mail::button>

{{ $url }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
