<?php

namespace App\Domain\Chatroom;

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
    public function getAllChatroomsForUser(int $userId): array
    {
        return $this->createQueryBuilder('c')
            ->where('c.user1 = :userId OR c.user2 = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();
    }
}
