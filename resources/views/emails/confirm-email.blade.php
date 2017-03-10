@component('mail::message')
<div class="mail-title">
    <b>Email Confirmation</b>
</div>

You've just registered on Face2WEB. Click on the button below to confirm your email!

@component('mail::button', ['url' => "http://localhost:8000/confirm-email?code=".$hash])
Confirm email
@endcomponent

@endcomponent
