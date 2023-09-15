<x-mail::message>
# Reset password.
Hello, {{ $login }}! Your password reset link:

<x-mail::button url="{{ $url }}">
Reset password
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
