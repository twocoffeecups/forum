<x-mail::message>
Hello {{ $login }}! You password: {{ $password }}.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
