<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserManager implements UserManagerInterface
{

    public function __construct(
        #[Autowire('%profile_picture_directory%')] private string $profilePictureDirectory,
        private readonly UserPasswordHasherInterface $userPasswordHasher
    ){
        $this->profilePictureDirectory .= "uploads";
    }

    private function hashPassword(User $user, ?string $plainPassword) : void {
        $password = $this->userPasswordHasher->hashPassword($user,$plainPassword);
        $user->setPassword($password);
    }

    private function saveProfilePicture(User $user, ?UploadedFile $profilePictureFile) : void {
        if($profilePictureFile != null) {
            $name = md5($user->getEmail()) . '.' . $profilePictureFile->guessExtension();
            $profilePictureFile->move($this->profilePictureDirectory, $name);
//            chmod($this->profilePictureDirectory . DIRECTORY_SEPARATOR . $name, 0777);
            $user->setProfilePictureName($name);
        }
    }


    public function processNewUser(User $user, ?string $plainPassword, ?UploadedFile $profilePictureFile) : void {
        $this->hashPassword($user,$plainPassword);
        $this->saveProfilePicture($user,$profilePictureFile);
    }

    public function deleteUserProfilePicture(User $user) : void {
        $fileName = $this->profilePictureDirectory . DIRECTORY_SEPARATOR . $user->getProfilePictureName();
        if (file_exists($fileName) && $user->getProfilePictureName() != null) {
            unlink($fileName);
        }
    }

    private function updateProfilePicture(User $user, ?string $email, ?UploadedFile $profilePictureFile) : void {
        if($email != null && $profilePictureFile == null) {
            $oldFileName = $this->profilePictureDirectory . DIRECTORY_SEPARATOR . $user->getProfilePictureName();
            $extension = pathinfo($oldFileName, PATHINFO_EXTENSION);
            $newName = md5($user->getEmail()) . '.' . $extension;
            if (file_exists($oldFileName) && $user->getProfilePictureName() !=null) {
                $newFile = fopen($this->profilePictureDirectory . DIRECTORY_SEPARATOR . $newName, 'w');
                $oldFile = fopen($oldFileName, 'r');
                stream_copy_to_stream($oldFile, $newFile);
                fclose($oldFile);
                fclose($newFile);
                unlink($oldFileName);
                $user->setProfilePictureName($newName);
            }
        }
        if($profilePictureFile != null) {
            $oldFileName = $this->profilePictureDirectory . DIRECTORY_SEPARATOR . $user->getProfilePictureName();
            if (file_exists($oldFileName) && $user->getProfilePictureName() !=null) {
                unlink($oldFileName);
            }
            $this->saveProfilePicture($user, $profilePictureFile);
        }
    }

    public function updateUser(User $user, ?string $email, ?string $newPlainPassword, ?UploadedFile $profilePictureFile) : void {
        if ($newPlainPassword !== null) {
            $this->hashPassword($user, $newPlainPassword);
        }
        $this->updateProfilePicture($user, $email, $profilePictureFile);
    }



}