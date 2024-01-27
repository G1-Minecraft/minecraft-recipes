<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Service\FlashMessageHelperInterface;
use App\Service\UserManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function homePage(Request $request){
        return $this->render('base.html.twig');
    }

    #[Route('/register', name: 'register', methods: ['GET','POST'])]
    public function register(Request $request, EntityManagerInterface $entityManager, FlashMessageHelperInterface $flashMessageHelper, UserManagerInterface $utilisateurManager): Response
    {
        if($this->isGranted('ROLE_USER')){
            return $this->redirectToRoute('home');
        }
        $user = new User();
        $form = $this->createForm(UserType::class, $user, [
            'method'=> 'POST',
            'action'=> $this->generateUrl('register')
        ]);

        $form->handleRequest($request);
        $flashMessageHelper->addFormErrorsAsFlash($form);

        if($form->isSubmitted() && $form->isValid()){
            $utilisateurManager->processNewUser($user, $form['plainPassword']->getData(), $form['profilePictureFile']->getData());
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success','Registered successfully');
            return $this->redirectToRoute("home");
        }
        return $this->render('user/register.html.twig', ["form"=> $form]);

    }

    #[Route('/login', name: 'login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response{
        if($this->isGranted('ROLE_USER')){
            return $this->redirectToRoute('home');
        }
        $lastEmail = $authenticationUtils->getLastUsername();
        return $this->render('user/login.html.twig', ['lastEmail'=> $lastEmail]);
    }

    #[Route('/logout', name: 'logout', methods: ['POST'])]
    public function logout(): never{
        throw new \Exception("This route should never be called. Check security.yaml");
    }

}
