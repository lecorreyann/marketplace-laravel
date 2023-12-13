<div>
    <h1>Hello {{ $user->first_name }}</h1>
    <p>Your password was reset successfully!<br /></p>
    <p>You can now log in to your account:<br />
        <a href="{{ $link = route('auth.sign_in.index') }}">
            click here</a><br />
    </p>
    <p>You can also copy and paste the following link in your browser:<br />
        {{ $link }}
    </p>
</div>
