<?php declare(strict_types = 1);

namespace App\UI\Modules\Front\SignUp;

use App\Domain\User\UserRepository;
use App\Model\Security\Passwords;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Nette\Application\UI\Template;

class SignUpPresenter extends Presenter
{

	/** @var UserRepository @inject */
	public UserRepository $users;

	public function renderDefault(): void
	{
		/** @var Template $template */
		$template = $this->template;
		$template->setFile(__DIR__ . '/signup.latte');
	}

	public function createComponentSignUpForm(): Form
	{
		$form = new Form();

		$form->addText('name', 'Name')
			->setHtmlAttribute('class', 'login-input form-control p-2 border-0 text-white')
			->setHtmlAttribute('placeholder', ' ')
			->setRequired('Please enter your name.');

		$form->addText('surname', 'Surname')
			->setHtmlAttribute('class', 'login-input form-control p-2 border-0 text-white')
			->setHtmlAttribute('placeholder', ' ')
			->setRequired('Please enter your surname.');

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
			->addRule($form::Equal, 'Passwords do not match.', $form['password'])
			->setRequired('Please enter your password again.');

		// Add the submit button
		$form->addSubmit('submit', 'Sign in')
			->setHtmlAttribute('class', 'btn btn-primary mt-4 btn-lg w-100');

		$form->setHtmlAttribute('class', 'login-form position-relative border p-5 rounded-3 shadow-lg w-50 row ');
		// Handle the form success
		$form->onSuccess[] = [$this, 'signupFormSucceeded'];

		return $form;
	}

	public function signupFormSucceeded(Form $form): void
	{
		$values = $form->getValues();

		$password = (new Passwords())->hash($values->password);

		$this->users->createNewUser(
			name: $values->name,
			surname: $values->surname,
			email: $values->email,
			username: $values->username,
			password: $password
		);

		$this->flashMessage('You have successfully signed up.', 'success');
		$this->redirect('LogIn:default');
	}

}
