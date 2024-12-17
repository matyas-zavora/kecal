<?php declare(strict_types = 1);

namespace App\UI\Modules\Front\Chatroom;

use App\Domain\Chatroom\ChatroomRepository;
use App\Domain\Message\MessageRepository;
use App\Domain\User\UserRepository;
use Nette\Application\UI\Presenter;
use Nette\Application\UI\Template;

class ChatroomPresenter extends Presenter
{
	/** @var ChatroomRepository @inject */
	public ChatroomRepository $chatroomRepository;

	/** @var UserRepository @inject */
	public UserRepository $userRepository;

	/** @var MessageRepository @inject */
	public MessageRepository $messageRepository;

	public function renderDefault(int $chatroomId = null): void
	{
		/** @var Template $template */
		$template = $this->template;

		if (!$this->getUser()->isLoggedIn()) {
			$this->redirect('LogIn:default');
		}

		/** @var int $userId */
		$userId = $this->getUser()->getId();
		$user = $this->userRepository->find($userId);
		$template->chatrooms = $this->chatroomRepository->getAllChatroomsForUser($userId);

		$template->nonChatUsers = $this->userRepository->getNonChatUsers($userId);

		$template->userData = $user;
		$template->title = 'Chatroom';

		$template->setFile(__DIR__ . '/chatroom.latte');
	}

}
