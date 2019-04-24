<?php

// src/Controller/TennisController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use App\Entity\Evenement;
use App\Entity\Staff;
use App\Entity\Cours;
use App\Entity\CompteClient;
use App\Entity\Inscription;
use App\Entity\Topic;
use App\Entity\Post;
use App\Entity\Commentaires;
use App\Form\EvenementType;
use App\Form\StaffType;
use App\Form\CoursType;
use App\Form\InscriptionType;
use App\Form\TopicType;
use App\Form\PostType;
use App\Form\CommentairesType;

class TennisController extends AbstractController

{


    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/",name="home")
     */
    public function index(Request $request, ObjectManager $manager)
    {

        $repo = $this->getDoctrine()->getRepository(Evenement::class);
        $evenement = $repo->findAll();

        $evt = new Evenement();
        $form = $this->createForm(EvenementType::class, $evt);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $evt->setDateEvenements(new \DateTime());

            $manager->persist($evt);
            $manager->flush();
            $repo = $this->getDoctrine()->getRepository(Evenement::class);
            $evenement = $repo->findAll();
        }
        return $this->render('pages/home.html.twig',['event' => $evenement, 'formulaire' => $form->createView()]);
    }

     /**
     * @Route("/supprimer_evenement/{id}",name="supprimer_evenement")
     */
    public function supprimer($id, Request $request, ObjectManager $manager)
    {
        $repo = $this->getDoctrine()->getRepository(Evenement::class);
        $evenement = $repo->find($id);
        $manager->remove($evenement);
        $manager->flush();
        return $this->redirectToRoute('home');
    }

     /**
     * @Route("/commentaires_evenement/{id}",name="commentaires_evenement")
     */
    public function commentaires($id, Request $request, ObjectManager $manager)
    {
        $repo = $this->getDoctrine()->getRepository(Evenement::class);
        $evenement = $repo->find($id);
        $commentaires = $evenement->getCommentaires();

        $new_commentaires = new Commentaires();
        $form = $this->createForm(CommentairesType::class, $new_commentaires);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $new_commentaires->setAuteur($this->getUser());
            $new_commentaires->setEvenement($evenement);
            $new_commentaires->setDate(new \Datetime());
            $evenement->addCommentaire($new_commentaires);
            $manager->persist($evenement);
            $manager->persist($new_commentaires);
            $manager->flush();
            $repo = $this->getDoctrine()->getRepository(Evenement::class);
            $evenement = $repo->find($id);
            $commentaires = $evenement->getCommentaires();
        }
        return $this->render('pages/reaction.html.twig',['evenement' => $evenement, 'commentaire' => $commentaires, 'formulaire' => $form->createView()]);
    }

     /**
     * @Route("/ajout_staff",name="ajout_staff")
     */
    public function ajout_staff(Request $request, ObjectManager $manager)
    {
        $staff = new Staff();

        $form = $this->createForm(StaffType::class,$staff);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $compte = $staff->getRenseignements();
            $compte->setDroits(0);
            $manager->persist($staff);
            $manager->persist($compte);
            $manager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('pages/ajout_staff.html.twig',['formulaire' => $form->createView()]);
    }

     /**
     * @Route("/ajout_cours",name="ajout_cours")
     */
    public function ajout_cours(Request $request, ObjectManager $manager)
    {
        $cours = new Cours();

        $form = $this->createForm(CoursType::class,$cours);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($cours);
            $manager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('pages/ajout_cours.html.twig',['formulaire' => $form->createView()]);
    }

     /**
     * @Route("/afficher_cours",name="afficher_cours")
     */
    public function afficher_cours(Request $request, ObjectManager $manager)
    {
        $repo = $this->getDoctrine()->getRepository(Cours::class);

        $cours = $repo->findAll();
        
        return $this->render('pages/affichage_cours.html.twig', ['cours' => $cours]);
    }

    /**
     * @Route("/inscription_cours/{id}",name="inscription_cours")
     */
    public function inscription_cours($id ,Request $request, ObjectManager $manager)
    {
        $repocours = $this->getDoctrine()->getRepository(Cours::class);
        $cours = $repocours->find($id);
        $cours->addInscription($this->getUser());
        $manager->persist($cours);
        $manager->flush();

        return $this->redirectToRoute('mes_cours');
    }

    /**
     * @Route("/mes_cours",name="mes_cours")
     */
    public function mes_cours(Request $request, ObjectManager $manager)
    {
        $repo = $this->getDoctrine()->getRepository(CompteClient::class);
        $inscriptions = $repo->find($this->getUser());
        $inscriptions = $inscriptions->getInscriptions();
        return $this->render('pages/mes_cours.html.twig', ['inscription' => $inscriptions]);
    }

     /**
     * @Route("/recherche/{option}",name="recherche")
     * @Route("recherche/{option}/{search}")
     */
    public function recherche($option, $search=null, Request $request, ObjectManager $manager)
    {
        switch ($option)
        {
            case 'Cours':
                $repo = $this->getDoctrine()->getRepository(Cours::class);
                if ($search != null)
                {
                    $element = $repo->findAll();

                }
                break;
            
            case 'Utilisateur':
                $repo = $this->getDoctrine()->getRepository(CompteClient::class);
                $querybuilder = $repo->createQueryBuilder('u');

                if ($search != null)
                {
                    $querybuilder->andWhere("u.nom LIKE '$search%' OR u.prenom LIKE '$search%' OR u.pseudo LIKE '$search%' OR u.tel LIKE '$search%' OR u.mail LIKE '$search%'");
                    $element = $querybuilder->getQuery()->getResult();
                }
                
                break;

            case 'Article':
                $repo = $this->getDoctrine()->getRepository(Evenement::class);
                $querybuilder = $repo->createQueryBuilder('a');
                if ($search != null)
                {
                    $querybuilder->andWhere("a.TitreEvenements LIKE '$search%'");
                    $element = $querybuilder->getQuery()->getResult();
                }

                break;
        }
        if ($search == null)
        {
            $element = $repo->findAll();
        }
        return $this->render('pages/recherche.html.twig',['option' => $option, 'element' => $element]);
    }

    /**
     * @Route("/contacts",name="contacts")
     */
    public function contacts(Request $request, ObjectManager $manager)
    {
        $repo = $this->getDoctrine()->getRepository(Staff::class);
        $staff = $repo->findAll();

        return $this->render('pages/staffs.html.twig',['staff' => $staff]);
    }


    /**
     * @Route("/forum",name="forum")
     */
    public function forum(Request $request, ObjectManager $manager)
    {
        $new_topic= new Topic();
        $form = $this->createForm(TopicType::class,$new_topic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $new_topic->setIDAuteurTopic($this->getUser());
            $manager->persist($new_topic);
            $manager->flush();
        }

        $repo = $this->getDoctrine()->getRepository(Topic::class);
        $sujet = $repo->findAll();

        return $this->render('pages/forum.html.twig',['sujet' => $sujet, 'formulaire' => $form->createView()]);
    }

    /**
     * @Route("/forum/{id}",name="posts")
     */
    public function posts($id, Request $request, ObjectManager $manager)
    {
        $repo = $this->getDoctrine()->getRepository(Topic::class);
        $sujet = $repo->find($id);
        $posts = $sujet->getPosts();
        foreach ($posts as $p)
            {
                $p->setTextePost($this->code($p->getTextePost()));
            }

        $new_post = new Post();
        $form = $this->createForm(PostType::class, $new_post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $new_post->setIDAuteurPost($this->getUser());
            $new_post->setIDTopic($sujet);
            $new_post->setDatePost(new \Datetime());
            $sujet->addPost($new_post);
            $manager->persist($sujet);
            $manager->persist($new_post);
            $manager->flush();
            $repo = $this->getDoctrine()->getRepository(Topic::class);
            $sujet = $repo->find($id);
            $posts = $sujet->getPosts();
            foreach ($posts as $p)
            {
                $p->setTextePost($this->code($p->getTextePost()));
            }
        }
        return $this->render('pages/posts.html.twig',['sujet' => $sujet, 'posts' => $posts, 'formulaire' => $form->createView()]);
    }

    private function code($texte)//fonction permettant de remplacer le bbcode en balises html pour la mise en forme
    {
    //les emojis
    $texte = str_replace(':c) ', '<img src="../images/smileys/smiley1.png" title="mario" alt="mario"/>', $texte);
    $texte = str_replace(':o ', '<img src="../images/smileys/smiley2.png" title="inquiet" alt="inquiet"/>', $texte);
    $texte = str_replace(':D ', '<img src="../images/smileys/smiley3.png" title="heureux" alt="heureux"/>', $texte);
    $texte = str_replace(':) ', '<img src="../images/smileys/smiley4.png" title="fleur" alt="fleur"/>', $texte);
    $texte = str_replace(':( ', '<img src="../images/smileys/smiley5.png" title="triste" alt="triste" />', $texte);
    //Mise en forme du texte
    //gras
    $texte = preg_replace('`\[g\](.+)\[/g\]`isU', '<strong>$1</strong>', $texte); 
    //italique
    $texte = preg_replace('`\[i\](.+)\[/i\]`isU', '<em>$1</em>', $texte);
    //souligné
    $texte = preg_replace('`\[s\](.+)\[/s\]`isU', '<u>$1</u>', $texte);
    return $texte;
    }



}

?>