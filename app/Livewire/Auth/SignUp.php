<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Livewire\Forms\SignUpForm;

class SignUp extends Component
{

  public SignUpForm $form;

  public function mount(): void
  {
    // Set the demo form if the app is running in the local environment
    if (app()->environment('local')) {
      $this->form->setDemoForm();
    }
  }

  public function register()
  {

    $this->resetErrorBag();

    $this->form->create();

    return back()->with('success', 'Your account has been created successfully. We have sent you an email to verify your email address and activate your account, please check your inbox (and spam folder).');
  }
}
