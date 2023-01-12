<x-mail::message>
# Welcome {{ $message->student_name }}

<x-mail::panel>
    Your message has been successfully received and will be reviewed carefully. 
    <br>the message Number is: {{ $message->id }}
</x-mail::panel>

Thanks,
<br>Admin
</x-mail::message>
