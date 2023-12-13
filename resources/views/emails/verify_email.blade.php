<div>
    <h1>Hello {{ $user->first_name }}</h1>
    <p>Verify your email!<br />
        Please click the following link to verify your email:
        <a
            href="{{ $link = route('auth.verify_email.index', ['email_verification_token' => $email_verification_token]) }}">
            click here</a><br />
    </p>
    <p>You can also copy and paste the following link in your browser:<br />
        {{ $link }}
    </p>
    <p>If you did not request this, please ignore this email.</p>
</div>
