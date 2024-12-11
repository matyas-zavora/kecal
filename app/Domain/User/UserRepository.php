<?php declare(strict_types = 1);

namespace App\Domain\User;

use App\Exceptions\User\InvalidPasswordException;
use App\Exceptions\User\UserNotFoundException;
use App\Model\Database\Repository\AbstractRepository;

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
		$user = $this->findOneByEmail($email);
		if ($user === NULL) {
			throw new \Exception("User not found");
		}
		if (!$user->verifyPassword($password)) {
			throw new \Exception("Invalid password");
		}
		return $user;
	}
}
