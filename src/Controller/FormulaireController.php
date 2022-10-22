<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;

class FormulaireController extends AbstractController
{
    /**
     * @Route("/TD4/login", name="user_login", methods={"GET", "POST"})
     */
    public function new(Request $request): Response
    {

        // http://localhost:8000/TD4/login
        // changer dans translation.yaml default en fr/en
        $user = new User();
        $message = '';
        if ($request->getLocale() == 'fr') {
            $message = 'Le mot de passe doit avoir au minimum 8 charactère et au moins une lettre et un nombre';
        } else {
            $message = 'Password must have a minimum of eight characters, at least one letter and one number';
        }
        // $local = $request->getLocale();
        // dump($local);
        $errorState = false;
        $form = $this->createFormBuilder($user)
            ->add('email', TextType::class)
            ->add('password', TextType::class, [
                'constraints' => new Assert\Regex([
                    'pattern' => '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
                    'message' => $message
                ]),
            ])
            ->add('password2', TextType::class, [
                'label' => 'Confirm password',
            ])
            ->add('save', SubmitType::class, ['label' => 'Create User'])
            ->getForm();

            
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            if ($form["password"]->getData() === $form["password2"]->getData()) {
                return $this->redirectToRoute('login_success');
            } else {
                $errorState = true;
            }
        }

        return $this->render('/Formulaire/login.html.twig', [
            'loginForm' => $form->createView(),
            'erreur' => $errorState
        ]);
    }


    /**
     * @Route("/TD4/login/success", name="login_success")
     */
    public function success(Request $request): Response
    {
        return $this->render('/Formulaire/success.html.twig');
    }
}
