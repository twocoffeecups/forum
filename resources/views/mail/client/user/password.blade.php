<x-mail::message>
Hello {{ $login }}! You password: {{ $password }}.

{{--<x-mail::button :url="''">--}}
{{--Ok--}}
{{--</x-mail::button>--}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
