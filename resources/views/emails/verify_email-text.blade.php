Hello {{ $user->first_name }}

Verify your email!

Please click the following link to verify your email:
{{ $link = route('auth.verify_email.index', ['email_verification_token' => $email_verification_token]) }}

If you did not request this, please ignore this email.
