<?php declare(strict_types = 1);

namespace App\Domain\Chatroom;

use App\Domain\User\User;
use App\Model\Database\Repository\AbstractRepository;

/**
 * @method ChatroomEntity|NULL find($id, ?int $lockMode = NULL, ?int $lockVersion = NULL)
 * @method ChatroomEntity|NULL findOneBy(array $criteria, array $orderBy = NULL)
 * @method ChatroomEntity[] findAll()
 * @method ChatroomEntity[] findBy(array $criteria, array $orderBy = NULL, ?int $limit = NULL, ?int $offset = NULL)
 * @extends AbstractRepository<ChatroomEntity>
 */
class ChatroomRepository extends AbstractRepository
{
	/** @return ChatroomEntity[] */
	public function getAllChatroomsForUser(int $userId): array
	{
		return $this->createQueryBuilder('c')
			->where('c.user1 = :userId OR c.user2 = :userId')
			->setParameter('userId', $userId)
			->getQuery()
			->getResult();
	}

	public function createNewChatroom(User $user1, User $user2): void
	{
		$chatroom = new ChatroomEntity($user1, $user2);
		$this->getEntityManager()->persist($chatroom);
		$this->getEntityManager()->flush();
	}

	public function getAllMessagesFromChatroom(ChatroomEntity $chatroom): array
	{
		return $this->_em->createQueryBuilder()->from(ChatroomEntity::class, 'c')
			->select('m')
			->join('c.messages', 'm')
			->where('c.id = :chatroomId')
			->setParameter('chatroomId', $chatroom->getId())
			->getQuery()
			->getResult();
	}
}
