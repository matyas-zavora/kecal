<?php

namespace App\UI\Modules\Front\Chatroom;

use Nette\Application\UI\Presenter;

class ChatroomPresenter extends Presenter
{
	public function renderDefault(): void
	{
		if (!$this->getUser()->isLoggedIn()) {
			$this->redirect('LogIn:default');
		}

		$this->template->render(__DIR__ . '/templates/default.latte');
	}
}
