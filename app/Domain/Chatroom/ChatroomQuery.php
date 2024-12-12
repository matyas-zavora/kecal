<?php

namespace App\Domain\Chatroom;

use App\Model\Database\Query\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use App\Domain\User\User;

class ChatroomQuery extends AbstractQuery
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findChatroomsByUser(User $user): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select('c')
            ->from(ChatroomEntity::class, 'c')
            ->where('c.user1 = :user OR c.user2 = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }
}
