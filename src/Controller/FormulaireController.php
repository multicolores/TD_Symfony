<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Contracts\Translation\TranslatorInterface;

class FormulaireController extends AbstractController
{

    /**
     * @Route("/TD4/register", name="user_register", methods={"GET", "POST"})
     */
    public function new(Request $request, TranslatorInterface $translator): Response
    {

        // http://localhost:8000/TD4/login
        // changer dans translation.yaml default en fr/en
        $user = new User();
        $message = $translator->trans('Error', [], 'message');

        // $local = $request->getLocale();
        // dump($local);
        $errorState = false;
        $errorMessage = $translator->trans('ErrorSamePassword', [], 'message');

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
                    return $this->redirectToRoute('registration_success');
            } else {
                $errorState = true;
                // $errorMessage = "Attention les mots de passes renseignés ne sont pas identiques !";
            }
        }

        return $this->render('/Formulaire/login.html.twig', [
            'loginForm' => $form->createView(),
            'erreur' => $errorState,
            'errorMessage' => $errorMessage
        ]);
    }

    /**
     * @Route("/TD4/registration/success", name="registration_success")
     */
    public function registration_success(Request $request): Response
    {
        return $this->render('/Formulaire/registrationSuccess.html.twig');
    }

    /**
     * @Route("/TD4/login/success", name="login_success")
     */
    public function success(Request $request): Response
    {
        return $this->render('/Formulaire/success.html.twig');
    }


    /**
     * @Route("/TD4/login", name="user_login")
     */
    public function login(Request $request, TranslatorInterface $translator): Response
    {
        $user = new User();
        $errorState = false;
        $errorMessage = $translator->trans('InvalidPassOrEmail', [], 'message');

        $form = $this->createForm(LoginFormType::class, $user);

        function checkValid($email, $password)
        {
            if ($email == "flo@gmail.com" && $password == "azerty123") {
                return true;
            } else {
                return false;
            }
        }

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

                if (checkValid($form["email"]->getData(), $form["password"]->getData())) {
                    return $this->redirectToRoute('login_success');
                } else {
                    $errorState = true;
                    // $errorMessage = "Mot de passe ou email renseigné invalid";
                }

        }

        return $this->render('/Formulaire/login.html.twig', [
            'loginForm' => $form->createView(),
            'erreur' => $errorState,
            'errorMessage' => $errorMessage
        ]);
    }
}
