<?php declare(strict_types = 1);

namespace App\UI\Modules\Front\Chatroom;

use App\Domain\Chatroom\ChatroomEntity;
use App\Domain\Chatroom\ChatroomRepository;
use App\Domain\Message\MessageRepository;
use App\Domain\User\User;
use App\Domain\User\UserRepository;
use Nette\Application\Attributes\Persistent;
use Nette\Application\UI\Form;
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

	#[Persistent]
	public ?int $chatroom = null;

	public function renderDefault(): void
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
		$template->selectedId = $this->chatroom;
		if ($this->chatroom !== null) {
			$template->selectedChatroomMessages = $this->messageRepository->getMessagesForChatroom($this->chatroom);
			$template->selectedChatroom = $this->chatroomRepository->find($this->chatroom);
		}

		$template->setFile(__DIR__ . '/chatroom.latte');
	}

	public function handleCreateNewChatroom(int $userId): void
	{
		/** @var User $user1 */
		$user1 = $this->userRepository->find($this->getUser()->getId());
		/** @var User $user2 */
		$user2 = $this->userRepository->find($userId);
		$this->chatroomRepository->createNewChatroom($user1, $user2);
		$this->redirect('this');
	}

	public function createComponentSendMessageForm(): Form
	{
		$form = new Form();
		$form->addTextArea('message', 'Message')
			->addRule($form::MaxLength, 'Message is too long', 255)
			->setRequired();
		$form->addSubmit('submit');
		$form->addHidden('chatroomId');
		$form->onSuccess[] = [$this, 'processSendMessageForm'];

		return $form;
	}

	public function processSendMessageForm(Form $form): void
	{
		$values = $form->getValues();

		/** @var ChatroomEntity $chatroom */
		$chatroom = $this->chatroomRepository->find($values->chatroomId);

		/** @var User $sender */
		$sender = $this->userRepository->find($this->getUser()->getId());

		$this->messageRepository->createNewMessage(
			$values->message,
			$chatroom,
			$sender
		);

		$this->flashMessage('Message sent', 'success');
		$this->redirect('this');
	}

	public function handleFetchNewMessages(string $chatroomId): void
	{
		$messages = $this->messageRepository->getMessagesForChatroom((int) $chatroomId);

		$tmp = [];
		foreach ($messages as $message) {
			$tmp[] = [
				'content' => $message->getContent(),
				'sender' => (string) $message->getSender()->getId(),
				'sentAt' => $message->getSentAt()->format('d. m. Y. h:m'),
			];
		}

		$this->sendJson($tmp);
	}

}
