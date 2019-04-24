<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


use App\Entity\CompteClient;
use App\Repository\CompteClientRepository;
use App\Form\CompteClientType;
use App\Form\UploadType;
use App\Entity\Evenement;
use App\Entity\Upload;

class CompteClientControllerPhpController extends AbstractController
{
    /**
     * @Route("/compte/inscription", name="compte_client_controller_php")
     */
    public function index(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $compte = new CompteClient();

        $form = $this->createForm(CompteClientType::class, $compte);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($compte, $compte->getMdp());
            $compte->setMdp($hash);
            $compte->setDroits(1);

            $manager->persist($compte);
            $manager->flush();
            $repo = $this->getDoctrine()->getRepository(Evenement::class);
            $evenement = $repo->findAll();

            return $this->redirectToRoute('connexion');
        }

        return $this->render('compte_client_controller_php/index.html.twig', [
            'controller_name' => 'CompteClientControllerPhpController',
            'formulaire' => $form->createView()
        ]);
    }

    /**
     * @Route("/compte/connexion", name="connexion")
     */
    public function connexion()
    {
        return $this->render('compte_client_controller_php/connexion.html.twig');
    }

    /**
     * @Route("/compte/deconnexion", name="deconnexion")
     */
    public function deconnexion(){}

    /**
     * @Route("/compte/informations", name="informations")
     */
    public function informations()
    {
        return $this->render('compte_client_controller_php/informations.html.twig');
    }

    /**
     * @Route("/compte/modification/{id}", name="modification")
     */
    public function modification(CompteClient $compte,Request $request, ObjectManager $manager)
    {
        $form = $this->createFormBuilder($compte)
                     ->add('mail',EmailType::class)
                     ->add('tel')
                     ->add('pseudo')
                     ->add('avatar')
                     ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            if ($request->request->get('avatar') != "")
            {
                $compte->setAvatar($request->request->get('avatar'));
            }
            $manager->persist($compte);
            $manager->flush();
            return $this->redirectToRoute('informations');
        }
        return $this->render('compte_client_controller_php/modification.html.twig',[
            'formulaire' => $form->createView()
        ]);
    }
}
