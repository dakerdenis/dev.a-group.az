@component('mail::message')

    __Full Name__: {{htmlspecialchars(strip_tags($data['fullName']))}}
    <br>
    __Phone__: {{htmlspecialchars(strip_tags($data['phone']))}}
    <br>
    __Text__:
    <br>
    {!! nl2br(htmlspecialchars(strip_tags($data['message']))) !!}

@endcomponent
