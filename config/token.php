<?php

return [

  'password_reset_token' => [
    'expires_in' => env('PASSWORD_RESET_TOKEN_EXPIRES_IN', 60 * 30),
  ],
  'email_verification_token' => [
    'expires_in' => env('EMAIL_VERIFICATION_TOKEN_EXPIRES_IN', 60 * 30),
  ],
  'remember_token' => [
    'expires_in' => env('REMEMBER_TOKEN_EXPIRES_IN', 60),
  ],

];
