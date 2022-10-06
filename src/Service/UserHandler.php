<?php

namespace LogRat\Core\Service;

use App\Entity\Apitoken;
use App\Entity\User;
use LogRat\Core\Enums\SecurityLevel;
use LogRat\Core\Exception\UserException;
use Symfony\Bridge\Doctrine\ManagerRegistry;

class UserHandler {

    private ManagerRegistry $entityManager;

    private User $user;

    public function __construct(ManagerRegistry $entityManager){
        $this->entityManager = $entityManager;
    }

    public function getUser() {
        if (!array_key_exists('username',$_REQUEST)) {
            throw new UserException('No username given',1);
        }

        $username = $_REQUEST['username'];

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['username' => $username]);

        if($user === null) {
            throw new UserException('User not found',2);
        }

        $this->user = $user;
    }

    public function checkPassword() : bool {
        $safedPassword = $this->user->getPassword();

        if(!array_key_exists('password',$_REQUEST) || $safedPassword === null) {
            return false;
        }

        $transmittedPassword = hash_hmac('sha256',$_REQUEST['password'],0);

        if($transmittedPassword === $safedPassword) {
            return true;
        }

        return false;
    }

    public function checkApitoken() : bool{

        $tokens = $this->user->getApitokens();

        if(!array_key_exists('apitoken',$_REQUEST)) {
            return false;
        }

        $tokenString = $_REQUEST['apitoken'];

        $token = $this->entityManager->getRepository(Apitoken::class)->findOneBy(['token' => $tokenString]);

        if($token === null) {
            return false;
        }

        if($tokens->contains($token)) {
            return true;
        }

        return false;
    }

    public function getSecurityLevel() : SecurityLevel{

        $mappings = [
            0 => SecurityLevel::SECURITY_LEVEL_NONE,
            1 => SecurityLevel::SECURITY_LEVEL_EASY,
            2 => SecurityLevel::SECURITY_LEVEL_MEDIUM,
            3 => SecurityLevel::SECURITY_LEVEL_HARD,
            4 => SecurityLevel::SECURITY_LEVEL_ADMIN
        ];

        $sec_lvl = $this->user->getSecurityLevel();

        return $mappings[$sec_lvl];
    }
}