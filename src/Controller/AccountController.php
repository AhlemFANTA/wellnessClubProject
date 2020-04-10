<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends AbstractController
{
    /**
     * Permet d'afficher et de gérer le formulaire de conexion
     * @Route("/login", name="account_login")
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();//ça va nous donner un error
        //pr recuperer le derniere email
        $username = $utils->getLastUsername();
        return $this->render('account/login.html.twig',[
            'hasError' => $error !== null,
            'username' => $username
        ]);
    }
  /**
   * Permet de se déconnecter
   *@Route("/logout", name="account_logout")
   * @return void
   */
    public function logout()
    {
        //rien !
    }
    /**
     * Permet d'afficher le formulaire d'inscription
     *@Route("/register", name="account_register")
     * @return Response
     */
    public function register(Request $request, EntityManagerInterface $manager,UserPasswordEncoderInterface $encoder)
    {
       $user = new User();
       $form = $this->createForm(RegistrationType::class,$user);
       //le fomulaire qui va gérer la requette
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
        $hash = $encoder->encodePassword($user,$user->getHash());
        $user->setHash($hash);
        $manager->persist($user);
        //le manager va envoyer la requette
        $manager->flush();
        $this->addFlash('success',"Votre compte a été bien crée ! vous pouvez maintenant vous connecter");
        return $this->redirectToRoute('account_login');
       }
       return $this->render('account/registration.html.twig', [
        'form' => $form->createView()
       ]);
    }
}
