@component('mail::message')

    __Full Name__: {{htmlspecialchars(strip_tags($data['full_name']))}}
    <br>
    __E-mail__: {{htmlspecialchars(strip_tags($data['email']))}}
    <br>
    __Phone__: {{htmlspecialchars(strip_tags($data['phone']))}}
    <br>
    __Education__:
    <br>
    {!! nl2br(htmlspecialchars(strip_tags($data['education']))) !!}
    <br>
    __Experience__:
    <br>
    {!! nl2br(htmlspecialchars(strip_tags($data['experience']))) !!}
    <br>

@endcomponent
