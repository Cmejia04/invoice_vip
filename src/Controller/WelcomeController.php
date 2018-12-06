<?php

namespace App\Controller;

use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Twig\Environment;

class WelcomeController extends Controller
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="home")
     * @param Request $request
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request) : Response
    {
        if ( null === $this->getUser() ) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        return new Response(
            $this->twig->render('home/index.html.twig', [ 'username' => $this->getUser()->getUsername() ])
        );
    }

    /**
     * @Route("/welcome", name="welcome")
     */
    public function index(EntityManagerInterface $em) : Response
    {
        $events = $em->getRepository(Event::class)->findAllData();
        return $this->render('home/index.html.twig', compact('events'));
    }

    /**
     * @Route("/createUser", name="create.user")
     * @param UserPasswordEncoderInterface $encoder
     */
    public function createUser(UserPasswordEncoderInterface $encoder){

        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $user->setUserName('user1');
        $user->setEmail('user1@opt.com');
        $user->setEnabled(1);
        $user->setPassword($encoder->encodePassword($user, '13365908'));
        //$user->setRoles(array('ROLE_ADMIN'));
        $userManager->updateUser($user);
    }
}