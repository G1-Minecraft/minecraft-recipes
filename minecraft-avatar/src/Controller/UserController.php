<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserEditType;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Service\FlashMessageHelperInterface;
use App\Service\UserManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function homePage(Request $request){
        if($this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('account');
        }
        else{
            return $this->redirectToRoute('login');
        }
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

    #[Route('/account', name: 'account', methods: ['GET', 'POST', 'DELETE'])]
    public function account(Request $request,
                            EntityManagerInterface $entityManager,
                            FlashMessageHelperInterface $flashMessageHelper,
                            UserManagerInterface $utilisateurManager,
                            UserRepository $userRepository, SessionInterface $session): Response{
        if($this->getUser() == null || $this->getUser()->getUserIdentifier() == null){
            return $this->redirectToRoute("login");
        }
        $userId = $this->getUser()->getUserIdentifier();
        $user = null;
        if($userId !=null){
            $user = $userRepository->findOneBy(['email' => $userId]);
        }
        if($user != null && $this->isGranted('ROLE_USER')){
                $form = $this->createForm(UserEditType::class, $user,
                    [
                        'method'=> 'POST',
                        'action'=> $this->generateUrl('account')
                    ]);
                $form->handleRequest($request);
                $flashMessageHelper->addFormErrorsAsFlash($form);
            if($request->isMethod('POST') && $form->isSubmitted() && $form->isValid()){
                $utilisateurManager->updateUser($user, $form['email']->getData(), $form['newPlainPassword']->getData(), $form['profilePictureFile']->getData());
                $entityManager->persist($user);
                $entityManager->flush();
                $this->addFlash('success','Account updated successfully');
                return $this->redirectToRoute("home");
            }

            elseif ($request->isMethod('DELETE')) {
                $redirection = $this->redirectToRoute('logout', [], 307);
                $utilisateurManager->deleteUserProfilePicture($user);
                $entityManager->remove($user);
                $entityManager->flush();

                $session->invalidate();

                $this->addFlash('success','Account deleted successfully');;
                return $redirection;
            }
            return $this->render('user/account.html.twig', ["form"=> $form, "email"=> $user->getUserIdentifier()]);
        }
        return $this->redirectToRoute("home");
    }

}
