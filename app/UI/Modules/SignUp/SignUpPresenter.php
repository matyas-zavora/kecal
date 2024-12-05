<?php

namespace App\UI\Modules\SignUp;

class SignUpPresenter
{
	protected function createComponentSignUpForm(): Form
	{
		$form = new Form;
		// Add the username
		$form->addText('username', 'Username')
			->setHtmlAttribute('class', 'login-input form-control p-2 border-0 text-white')
			->setHtmlAttribute('placeholder', ' ')
			->setRequired('Please enter your username.');

		// Add the email field with styling
		$form->addEmail('email', 'Email')
			->setHtmlAttribute('class', 'login-input form-control p-2 border-0 text-white')
			->setHtmlAttribute('placeholder', ' ')
			->setRequired('Please enter your email.');

		// Add the password field with styling
		$form->addPassword('password', 'Password')
			->setHtmlAttribute('class', 'login-input form-control p-2 border-0 text-white')
			->setHtmlAttribute('placeholder', ' ')
			->setRequired('Please enter your password.');

		// Add the check password field with styling
		$form->addPassword('check_password', 'Password')
			->setHtmlAttribute('class', 'login-input form-control p-2 border-0 text-white')
			->setHtmlAttribute('placeholder', ' ')
			->setRequired('Please enter your password again.');

		// Add the submit button
		$form->addSubmit('submit', 'Sign in')
			->setHtmlAttribute('class', 'btn btn-primary mt-4 btn-lg w-100');

		$form->setHtmlAttribute('class', 'login-form position-relative border p-5 rounded-3 shadow-lg w-50 row ');
		// Handle the form success
		$form->onSuccess[] = [$this, 'signupFormSucceeded'];

		return $form;
	}

	public function signupFormSucceeded(Form $form, \stdClass $values): void
	{
		// Implement your login logic here
		$email = $values->email;
		$password = $values->password;

		// Example: Verify user credentials
		if ($email === '123@example.com' && $password === '123') {
			$this->flashMessage('Login successful!', 'success');
			$this->redirect('Home:default');
		} else {
			$this->flashMessage('Invalid email or password.', 'danger');
		}
	}
}
