<?php declare(strict_types = 1);

namespace App\Domain\User;

use App\Domain\Chatroom\ChatroomEntity;
use App\Model\Database\Repository\AbstractRepository;
use Exception;

/**
 * @method User|NULL find($id, ?int $lockMode = NULL, ?int $lockVersion = NULL)
 * @method User|NULL findOneBy(array $criteria, array $orderBy = NULL)
 * @method User[] findAll()
 * @method User[] findBy(array $criteria, array $orderBy = NULL, ?int $limit = NULL, ?int $offset = NULL)
 * @extends AbstractRepository<User>
 */
class UserRepository extends AbstractRepository
{

	public function findOneByEmail(string $email): ?User
	{
		return $this->findOneBy(['email' => $email]);
	}

	public function createNewUser(
		string $name,
		string $surname,
		string $email,
		string $username,
		string $password,
	): User
	{
		$user = new User(
			$name,
			$surname,
			$email,
			$username,
			$password,
		);
		$this->getEntityManager()->persist($user);
		$this->getEntityManager()->flush();

		return $user;
	}

	public function authenticate(string|null $email, string|null $password): User
	{
		if ($email === null) {
			throw new Exception('Email is required');
		}

		if ($password === null) {
			throw new Exception('Password is required');
		}

		$user = $this->findOneByEmail($email);
		if ($user === null) {
			throw new Exception('User not found');
		}

		if (!$user->verifyPassword($password)) {
			throw new Exception('Invalid password');
		}

		return $user;
	}

	/** @return User[] */
	public function getNonChatUsers(int $userId): array
	{
		$qb = $this->createQueryBuilder('u');

		$qb->where(
			$qb->expr()->not(
				$qb->expr()->exists(
					$this->_em->createQueryBuilder()
						->select('1')
						->from(ChatroomEntity::class, 'c')
						->where('c.user1 = u OR c.user2 = u')
						->andWhere('(:currentUserId = c.user1 OR :currentUserId = c.user2)')
						->getDQL()
				)
			)
		)
			->andWhere('u.id != :currentUserId')
			->setParameter('currentUserId', $userId);

		return $qb->getQuery()->getResult();
	}

}
