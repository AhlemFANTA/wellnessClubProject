<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AccountType;
use App\Entity\PasswordUpdate;
use App\Form\RegistrationType;
use App\Form\PasswordUpdateType;
use Symfony\Component\Form\FormError;
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
        return $this->redirectToRoute('account_create');
       }
       return $this->render('account/registration.html.twig', [
        'form' => $form->createView()
       ]);
    }

    //mettre à jour le mot de passe
    /**
     * Permet de modifier le mdp
     *@Route("/account/password-update", name="account_password")
     * @return Response
     */
    public function updatePassword(Request $request,EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder )
    {
        $passwordUpdate = new PasswordUpdate();
        //récuperer l'utilisateur
        $user = $this->getUser();

        $form = $this->createForm(PasswordUpdateType::class,$passwordUpdate);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {//c que le formulaire est bien rempli(validation est bien)
            //1 - verifier que le oldPassword du formulaire soit le même que le password de l'user
            if(!password_verify($passwordUpdate->getOldPassword(),$user->getHash()))
            {
                //gérer l'erreur
                //on va accéedr au champ pr lui affecter un error
                $form->get('oldPassword')->addError(new FormError("Le mot de passe que vous avez tapez n'est pas votre mot de passe acctuel"));


            }else{
                $newPassword = $passwordUpdate->getNewPassword();
                $hash = $encoder->encodePassword($user,$newPassword);
                //changer le mot de passe de user
                $user->setHash($hash);
                $manager->persist($user);
                $manager->flush();

                $this->addFlash('success',"Votre mot de passe a été bien modifié !");
                return $this->redirectToRoute('account_password');
                
            }


        }
            return $this->render('account/password.html.twig',[
                'form' => $form->createView()
            ]);
    }

    
    /**
     * Permet d'afficher la création du compte
     *@Route("create", name="account_create")
     * @return Response
     */
    public function compteEstCree()
    {
        return $this->render('account/accountIsCreate.html.twig');
    }

    /**
     * Permet d'afficher les paramatres d'admin
     *@Route("parametre", name="account_parametre")
     * @return Response
     */
    public function parametre()
    {
        return $this->render('account/parametre.html.twig');
    }
     /**
     * Permet d'afficher et de traiter le formulaire de modification de profil
     *@Route("/account/profile", name="account_profile")
     * @return Response
     */
    public function profile(Request $request,EntityManagerInterface $manager)
    {
        //récuperer l'user connecter
        $user = $this->getUser();
        $form = $this->createForm(AccountType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($user);
                $manager->flush();
                $this->addFlash('success',"Les données du profil ont été enregistré avec succés  !");

        }
        return $this->render('account/profile.html.twig',
    [
        'form'=>$form->createView()
    ]);
    }


}
