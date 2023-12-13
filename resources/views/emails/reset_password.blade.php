<div>
    <h1>Hello {{ $user->first_name }}</h1>
    <p>Reset your password!<br />
        Please click the following link to reset your password:
        <a href="{{ $link = route('auth.reset_password.index', ['password_reset_token' => $password_reset_token]) }}">
            click here</a><br />
    </p>
    <p>You can also copy and paste the following link in your browser:<br />
        {{ $link }}
    </p>
    <p>If you did not request this, please ignore this email.</p>
</div>
