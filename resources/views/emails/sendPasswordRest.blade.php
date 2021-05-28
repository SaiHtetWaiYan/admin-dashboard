@component('mail::message')
# {{ $maildata['title'] }}

Hello {{ $maildata['name']}} ,<br>

A request has been received to change the password for your account

@component('mail::button', ['url' => $maildata['url']])
Reset Your Password
@endcomponent

If u did not request a password reset, you can safely ignore this email. Only a person with access to your email can reset your account password.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
