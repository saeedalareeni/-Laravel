<x-mail::message>
# Welcome {{ $message->student_name }}

<x-mail::panel>
{{ $message->response }}
</x-mail::panel>

Thanks,
<br>Admin
</x-mail::message>
