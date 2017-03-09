@component('mail::message')
            # Email Confirmation

You've just registered on Face2WEB. Click on the button below to confirm your email!

@component('mail::button', ['url' => 'http://localhost:8000/confirm-email?hash=$hash'])
Confirm email
@endcomponent

@endcomponent
