<?php declare(strict_types = 1);

namespace App\Domain\Message;

use App\Domain\Chatroom\ChatroomEntity;
use App\Domain\User\User;
use App\Model\Database\Entity\AbstractEntity;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Message\MessageRepository")
 * @ORM\Table(name="message_entity")
 * @ORM\HasLifecycleCallbacks
 */
class MessageEntity extends AbstractEntity
{

	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private int $id;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Domain\Chatroom\ChatroomEntity", inversedBy="messages")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private ChatroomEntity $chatroom;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Domain\User\User")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private User $sender;

	/** @ORM\Column(type="text") */
	private string $content;

	/** @ORM\Column(type="datetime") */
	private DateTime $sentAt;

	public function __construct(ChatroomEntity $chatroom, User $sender, string $content)
	{
		$this->chatroom = $chatroom;
		$this->sender = $sender;
		$this->content = $content;
		$this->sentAt = new DateTime();
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getChatroom(): ChatroomEntity
	{
		return $this->chatroom;
	}

	public function getSender(): User
	{
		return $this->sender;
	}

	public function getContent(): string
	{
		return $this->content;
	}

	public function getSentAt(): DateTime
	{
		return $this->sentAt;
	}

}
