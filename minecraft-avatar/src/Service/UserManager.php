<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserManager implements UserManagerInterface
{

    public function __construct(
        #[Autowire('%profile_picture_directory%')] private readonly string $profilePictureDirectory,
        private readonly UserPasswordHasherInterface $userPasswordHasher
    ){}

    private function hashPassword(User $user, ?string $plainPassword) : void {
        $password = $this->userPasswordHasher->hashPassword($user,$plainPassword);
        $user->setPassword($password);
    }

    private function saveProfilePicture(User $user, ?UploadedFile $profilePictureFile) : void {
        if($profilePictureFile != null) {
            $name = md5($user->getEmail()) . '.' . $profilePictureFile->guessExtension();
            $profilePictureFile->move($this->profilePictureDirectory, $name);
            $user->setProfilePictureName($name);
        }
    }


    public function processNewUser(User $user, ?string $plainPassword, ?UploadedFile $profilePictureFile) : void {
        $this->hashPassword($user,$plainPassword);
        $this->saveProfilePicture($user,$profilePictureFile);
    }

}