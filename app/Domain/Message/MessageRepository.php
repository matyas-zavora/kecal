<?php

namespace App\Domain\Message;

use App\Model\Database\Repository\AbstractRepository;

/**
 * @method MessageEntity|NULL find($id, ?int $lockMode = NULL, ?int $lockVersion = NULL)
 * @method MessageEntity|NULL findOneBy(array $criteria, array $orderBy = NULL)
 * @method MessageEntity[] findAll()
 * @method MessageEntity[] findBy(array $criteria, array $orderBy = NULL, ?int $limit = NULL, ?int $offset = NULL)
 * @extends AbstractRepository<MessageEntity>
 */
class MessageRepository extends AbstractRepository
{
    public function getMessagesForChatroom(int $chatroomId): array
    {
        return $this->createQueryBuilder('m')
            ->where('m.chatroom = :chatroomId')
            ->setParameter('chatroomId', $chatroomId)
            ->getQuery()
            ->getResult();
    }
}
