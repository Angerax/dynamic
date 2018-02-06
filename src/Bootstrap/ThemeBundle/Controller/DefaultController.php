<?php

namespace Bootstrap\ThemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bootstrap\ThemeBundle\Entity\Category;
use Bootstrap\ThemeBundle\Entity\Post;
use Bootstrap\ThemeBundle\Entity\Users;
use Bootstrap\ThemeBundle\Entity\Topic;
use Bootstrap\ThemeBundle\Form\PostType;
use Bootstrap\ThemeBundle\Form\ImageType;
use Bootstrap\ThemeBundle\Form\SearchType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        //Affiche les 3 derniers articles posté
         $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('BootstrapThemeBundle:Post');
        $postPages = $repository->findBy(array(), array('date' => 'DESC'),
                3
                );
        
        
        return $this->render('BootstrapThemeBundle:Default:index.html.twig',['postPages'=>$postPages]);
    }
    
    
    public function categoriesAction(Request $request)
    {
        //Affiche toutes les catégories
        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('BootstrapThemeBundle:Category');
        $listCategory = $repository->findAll();
        
        //Définis la pagination à 5 éléments par page
        $categoriesPages  = $this->get('knp_paginator')->paginate(
        $listCategory,
        $request->query->get('page', 1)/*le numéro de la page à afficher*/,
          5/*nbre d'éléments par page*/
    );
        
        
        return $this->render('BootstrapThemeBundle:Default:categories.html.twig',['categoriesPages'=>$categoriesPages, 'listCategory'=>$listCategory]);
    }
    
    /**
     * 
     * @Route("discussion", name="post")
     */
     public function discussionAction(Request $request)
    {
        //Récupère l'id du sujet
        $tagName=$request->query->get('top');
        
        // Création de l'entité Post
        $advert = new Post();
        
        $form = $this->createForm(PostType::class,$advert);
       
        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()){
                //On persiste l'entité
                $tagName=$request->query->get('top');
                $uid = $this->getUser()->getid(); //Récupération de l'utilisateur connecté
                dump($uid);
                $advert->setUsernames($this->getUser()); //Définis l'auteur du post
            
                $em = $this->get('doctrine.orm.entity_manager');
                $em->persist($advert);
                $em->flush();
                
                //On crée un message d'info
                $this->get('session')->getFlashBag()->add('notice','Sujet bien enregistrée');
                //Redirection vers la même page
                return $this->redirect($request->getUri());              
        }
        
        if ($form->isSubmitted()){
            //On crée un message d'info
            $this->get('session')->getFlashBag()->add('notice','Probleme avec le formulaire');
        }
        
        //Affiche les messages liés à un sujet
        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('BootstrapThemeBundle:Post');
        $listPost = $repository->findby(
               array('topics' => $tagName)
                );
        //Définis la pagination à 10 éléments par page
        $postPages  = $this->get('knp_paginator')->paginate(
        $listPost,
        $request->query->get('page', 1)/*le numéro de la page à afficher*/,
          10/*nbre d'éléments par page*/
    );
         
        return $this->render('BootstrapThemeBundle:Default:discussion.html.twig',['postPages'=>$postPages, 'listPost'=>$listPost,'PostForm'=>$form->createView()]);
    }
    

    /**
     * 
     * @Route("sujets", name="sujets")
     */
    public function sujetsAction(Request $request)
    {
        //Récupère l'id de la catégorie
        $tagName=$request->query->get('cat');
        
        //Affiche les sujets liés à une catégorie
        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('BootstrapThemeBundle:Topic');
        $listTopic = $repository->findby(
               array('categories' => $tagName)
                );
        //Définis la pagination à 10 éléments par page
        $topicPages  = $this->get('knp_paginator')->paginate(
        $listTopic,
        $request->query->get('page', 1)/*le numéro de la page à afficher*/,
          10/*nbre d'éléments par page*/
    );
              
        return $this->render('BootstrapThemeBundle:Default:sujets.html.twig',['topicPages'=>$topicPages, 'listTopic'=>$listTopic]);
    }
    
    
    public function compteAction(Request $request)
    {
        //Récupération de l'utilisateur connecté
        $advert = $this->getUser();
        
        $form = $this->createForm(ImageType::class,$advert);
       
        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()){
                //On persiste l'entité
                $advert = $form->getData(); //Récupération de l'image dans le formulaire
                $em = $this->get('doctrine.orm.entity_manager');
                $em->persist($advert);
                $em->flush();
                
                //On crée un message d'info
                $this->get('session')->getFlashBag()->add('notice','Catégorie bien enregistrée');
                //On redirige
                return $this->redirect($request->getUri());
                
        }
        if ($form->isSubmitted()){
            //On crée un message d'info
            $this->get('session')->getFlashBag()->add('notice','Probleme avec le formulaire');
        }
        
        //Récupération de l'id de l'utilisateur
        $uid = $this->getUser()->getid();
        
        //Affiche les messages posté par l'utilisateur
        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('BootstrapThemeBundle:Post');
        $postPages = $repository->findBy
                (array('usernames' => $uid)
                );
        
        return $this->render('BootstrapThemeBundle:Default:compte.html.twig',['ImageForm'=>$form->createView(),'postPages'=>$postPages]);
    }
    
    
    public function newartAction(Request $request)
    {
        
        $topic = new Topic();      
//        $formTopic = $this->get('form.factory')->create(\Admin\AdminBundle\Form\TopicType::class, $topic);
//        $formTopic->remove('Enregistrer');
//        
        $post = new Post();
//        $formPost = $this->get('form.factory')->create(PostType::class, $post);
//        $formPost->remove('topics');
        
        $postAndTopic = new \Bootstrap\ThemeBundle\Entity\PostAndTopic();
        $postAndTopic->setPost($post)
                ->setTopic($topic);
        
        $formPost = $this->createForm(\Bootstrap\ThemeBundle\Form\PostAndTopicType::class,$postAndTopic);
        
        if ($formPost->handleRequest($request)->isSubmitted() && $formPost->isValid()){
                //On persiste l'entité
                $uid = $this->getUser()->getid(); //Récupération de l'utilisateur connecté
                $post->setUsernames($this->getUser()); //Définis l'auteur du post
                $em = $this->get('doctrine.orm.entity_manager');
                $em->persist($topic);        
                $em->persist($post);
                $em->flush();
                
        }
        
        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('BootstrapThemeBundle:Topic');
        $listTopic = $repository->findAll();
        
        return $this->render('BootstrapThemeBundle:Default:newart.html.twig',['listTopic'=>$listTopic, 'PostForm'=>$formPost->createView()]);
    }
    
    
    public function searchAction(Request $request)
    {
     //Affiche les messages
        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('BootstrapThemeBundle:Post');
        
        $tag=$request->get("tag");

        
        $query=$repository->createQueryBuilder('p')
                ->where('p.message like :message')
                ->orwhere('p.url like :url')
                ->orwhere('p.embed like :embed')
                ->setParameter('message','%'.$tag.'%')
                ->setParameter('url','%'.$tag.'%')
                ->setParameter('embed','%'.$tag.'%')
                ->orderBy('p.date', 'DESC')
                ->getQuery();
        
        $listPost = $query->getResult();
        
        //Définis la pagination à 5 éléments par page
        $postPages  = $this->get('knp_paginator')->paginate(
        $listPost,
        $request->query->get('page', 1)/*le numéro de la page à afficher*/,
          2/*nbre d'éléments par page*/
    );
        
     return $this->render('BootstrapThemeBundle:Default:search.html.twig',['postPages'=>$postPages, 'listPost'=>$listPost]);   
    }
    
    
    /**
     * @Route("/{page}", name="static")
    */
    public function staticAction($page)
{
    return $this->render('BootstrapThemeBundle:Static:'.$page.'.html.twig');
}
}
