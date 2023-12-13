Hello {{ $user->first_name }}

Your password was reset successfully!

You can now log in to your account:
{{ route('auth.sign_in.index') }}
