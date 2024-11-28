<?php

declare(strict_types=1);

namespace App\UI\Home;

use Nette;
use Nette\Application\UI\Form;


final class HomePresenter extends Nette\Application\UI\Presenter
{
    protected function createComponentLogInForm(): Form
    {
        $form = new \Nette\Application\UI\Form;

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

        // Add the submit button
        $form->addSubmit('submit', 'Sign in')
            ->setHtmlAttribute('class', 'btn btn-primary mt-4 btn-lg w-100');

        $form->setHtmlAttribute('class', 'login-form position-relative border p-5 mx-2 rounded-3 shadow-lg row col-sm-8 col-lg-6 col-xl-4');
        // Handle the form success
        $form->onSuccess[] = [$this, 'loginFormSucceeded'];

        return $form;
    }

    public function loginFormSucceeded(Form $form, \stdClass $values): void
    {
        // Implement your login logic here
        $email = $values->email;
        $password = $values->password;

        // Example: Verify user credentials
        if ($email === 'user@example.com' && $password === 'password') {
            $this->redirect('Home:');
        } else {
            $this->flashMessage('Invalid email or password.', 'danger');
        }
    }

}


