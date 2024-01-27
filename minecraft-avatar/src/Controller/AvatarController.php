<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvatarController extends AbstractController
{
    #[Route('/avatar/{md5mail}', name: 'getavatar', methods: ['GET'])]
    public function getavatar(string $md5mail, #[Autowire('%profile_picture_directory%')] string $profilePictureDirectory): Response
    {
        $imagePathJpg = $profilePictureDirectory . "uploads" . DIRECTORY_SEPARATOR . $md5mail . '.jpg';
        $imagePathPng = $profilePictureDirectory . "uploads" . DIRECTORY_SEPARATOR . $md5mail . '.png';
        $placeholderPath = $profilePictureDirectory . 'missing_texture.png';

        if (is_readable($imagePathJpg)) {
            return new BinaryFileResponse($imagePathJpg);
        } elseif (is_readable($imagePathPng)) {
            return new BinaryFileResponse($imagePathPng);
        } else {
            return new BinaryFileResponse($placeholderPath);
        }
    }
}
