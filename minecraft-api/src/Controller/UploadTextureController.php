<?php

namespace App\Controller;

use App\Entity\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UploadTextureController extends AbstractController
{
    #[Route('/items/{id}/upload_texture', name: 'upload_item_texture', methods: ['POST'])]
    public function upload(Request $request, Item $item, EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {
        $file = $request->files->get('textureFile');
        if ($file) {
            $constraints = new File([
                'maxSize' => '1024k',
                'mimeTypes' => [
                    'image/png',
                    'image/jpeg',
                ],
                'mimeTypesMessage' => 'Please upload a valid PNG or JPEG image',
            ]);

            $errors = $validator->validate(
                $file,
                $constraints
            );

            if (count($errors) > 0) {
                return new Response((string) $errors, Response::HTTP_BAD_REQUEST);
            }

            $uploadsDirectory = $this->getParameter('uploads_directory');
            $filename = uniqid().'.'.$file->guessExtension();

            $file->move(
                $uploadsDirectory,
                $filename
            );

            $item->setTextureName($filename);
            $entityManager->persist($item);
            $entityManager->flush();

            return new Response('Texture uploaded successfully');
        }

        return new Response('No file provided', Response::HTTP_BAD_REQUEST);
    }
}
