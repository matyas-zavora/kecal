<?php

namespace App\Domain\Chatroom;

use App\Model\Database\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Domain\User\User;
use DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Chatroom\ChatroomRepository")
 * @ORM\Table(name="chatroom_entity")
 * @ORM\HasLifecycleCallbacks
 */
class ChatroomEntity extends AbstractEntity
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private int $id;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Domain\User\User")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private User $user1;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Domain\User\User")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private User $user2;

	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	private ?int $lastMessageUserId = null;

	/**
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	private ?DateTime $lastMessageAt = null;

	public function __construct(User $user1, User $user2)
	{
		$this->user1 = $user1;
		$this->user2 = $user2;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getUser1(): User
	{
		return $this->user1;
	}

	public function getUser2(): User
	{
		return $this->user2;
	}

	public function getLastMessageUserId(): ?int
	{
		return $this->lastMessageUserId;
	}

	public function getLastMessageAt(): ?DateTime
	{
		return $this->lastMessageAt;
	}

	public function setLastMessageUserId(?int $lastMessageUserId): void
	{
		$this->lastMessageUserId = $lastMessageUserId;
	}

	public function setLastMessageAt(?DateTime $lastMessageAt): void
	{
		$this->lastMessageAt = $lastMessageAt;
	}

	public function setLastMessageData(?int $lastMessageUserId, ?DateTime $lastMessageAt): void
	{
		$this->setLastMessageUserId($lastMessageUserId);
		$this->setLastMessageAt($lastMessageAt);
	}

	public function getSecondUser(User $user): User
	{
		if ($this->user1 === $user) {
			return $this->user2;
		}

		return $this->user1;
	}
}
