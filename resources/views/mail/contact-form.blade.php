@component('mail::message')

    __Full Name__: {{htmlspecialchars(strip_tags($data['fullName']))}}
    <br>
    __Company__: {{htmlspecialchars(strip_tags($data['company']))}}
    <br>
    __Email__: {{htmlspecialchars(strip_tags($data['email']))}}
    <br>
    __Phone__: {{htmlspecialchars(strip_tags($data['phone']))}}
    <br>
    __Department__: {{htmlspecialchars(strip_tags($data['department']))}}
    <br>
    __Text__:
    <br>
    {!! nl2br(htmlspecialchars(strip_tags($data['message']))) !!}

@endcomponent
