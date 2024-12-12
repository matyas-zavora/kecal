<?php declare(strict_types = 1);

namespace App\UI\Modules\Front\Chatroom;

use Nette\Application\UI\Presenter;
use Nette\Application\UI\Template;

class ChatroomPresenter extends Presenter
{

	public function renderDefault(): void
	{
		if (!$this->getUser()->isLoggedIn()) {
			$this->redirect('LogIn:default');
		}

		/** @var Template $template */
		$template = $this->template;
		$template->setFile(__DIR__ . '/chatroom.latte');
	}

}
