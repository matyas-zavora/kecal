<?php declare(strict_types = 1);

namespace App\UI\Modules\Front\LogIn;

use App\Domain\User\UserRepository;
use Nette\Application\UI\Presenter;
use Nette\Application\UI\Template;
use Nette\Forms\Form;

class LogInPresenter extends Presenter
{

	/** @var UserRepository @inject */
	public UserRepository $users;

	public function renderDefault(): void
	{
		if ($this->getUser()->isLoggedIn()) {
			$this->redirect('Chatroom:default');
		}

		/** @var Template $template */
		$template = $this->template;
		$template->setFile(__DIR__ . '/login.latte');
	}

	public function loginFormSucceeded(Form $form): void
	{
		$values = $form->getValues();
		try {
			$user = $this->users->authenticate($values->email, $values->password);
			$this->getUser()->login($user->toIdentity());

			$this->flashMessage('Login successful', 'success');
//          $this->redirect('Homepage:default');
			// TODO: Redirect to Chatroom
		} catch (\Throwable $e) {
			$this->flashMessage($e->getMessage(), 'danger');
		}
	}

	protected function createComponentLogInForm(): Form
	{
		$form = new \Nette\Application\UI\Form();

		// Add the email field with styling
		$form->addEmail('email', 'Email')
			->setHtmlAttribute('class', '')
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

}
