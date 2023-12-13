Hello {{ $user->first_name }}

Reset your password!

Please click the following link to reset your password:
{{ $link = route('auth.reset_password.index', ['password_reset_token' => $password_reset_token]) }}

If you did not request this, please ignore this email.
