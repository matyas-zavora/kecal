<?php declare(strict_types = 1);

namespace App\Domain\Chatroom;

use Doctrine\ORM\EntityManagerInterface;
use App\Domain\User\User;

class CreateChatroomFacade
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createChatroom(User $user1, User $user2): ChatroomEntity
    {
        $chatroom = new ChatroomEntity($user1, $user2);
        $this->entityManager->persist($chatroom);
        $this->entityManager->flush();

        return $chatroom;
    }
}
