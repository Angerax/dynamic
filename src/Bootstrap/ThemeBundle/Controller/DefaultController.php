<?php

namespace Bootstrap\ThemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bootstrap\ThemeBundle\Entity\Post;
use Bootstrap\ThemeBundle\Entity\Users;
use Bootstrap\ThemeBundle\Entity\Topic;
use Bootstrap\ThemeBundle\Form\PostType;
use Bootstrap\ThemeBundle\Form\ImageType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DefaultController extends Controller
{
    public function indexAction()
    {
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
        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('BootstrapThemeBundle:Category');
        $listCategory = $repository->findAll();
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
        $tagName=$request->query->get('top');
        dump($tagName);
         // Création de l'entité Advert
        $advert = new Post();
        
       $form = $this->createForm(PostType::class,$advert);
       
        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()){
                //On persiste l'entité
            $tagName=$request->query->get('top');
                $uid = $this->getUser()->getid();
                dump($uid);
                $advert->setUsernames($this->getUser());
            
                $em = $this->get('doctrine.orm.entity_manager');
                $em->persist($advert);
                $em->flush();
                
                //On crée un message d'info
                $this->get('session')->getFlashBag()->add('notice','Sujet bien enregistrée');
                //On redirige
                return $this->redirect($request->getUri());
                
                
        }
        if ($form->isSubmitted()){
            //On crée un message d'info
            $this->get('session')->getFlashBag()->add('notice','Probleme avec le formulaire');
        }
         
        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('BootstrapThemeBundle:Post');
        $listPost = $repository->findby(
               array('topics' => $tagName)
                );
        
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

        $tagName=$request->query->get('cat');
        
        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('BootstrapThemeBundle:Topic');
        $listTopic = $repository->findby(
               array('categories' => $tagName)
//               array('date' => 'desc')
                );
       $topicPages  = $this->get('knp_paginator')->paginate(
        $listTopic,
        $request->query->get('page', 1)/*le numéro de la page à afficher*/,
          10/*nbre d'éléments par page*/
    );
              
        return $this->render('BootstrapThemeBundle:Default:sujets.html.twig',['topicPages'=>$topicPages, 'listTopic'=>$listTopic]);
    }
    
    
    public function compteAction(Request $request)
    {
        $advert = $this->getUser();
        
       $form = $this->createForm(ImageType::class,$advert);
       
        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()){
                //On persiste l'entité
                $advert = $form->getData();
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
        
        $uid = $this->getUser()->getid();
        
         $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('BootstrapThemeBundle:Post');
        $postPages = $repository->findBy
                (array('usernames' => $uid)
//               array('date' => 'desc')
                );
        
        return $this->render('BootstrapThemeBundle:Default:compte.html.twig',['ImageForm'=>$form->createView(),'postPages'=>$postPages]);
    }
    
    
    public function newartAction()
    {
        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('BootstrapThemeBundle:Topic');
        $listTopic = $repository->findAll();
        
        return $this->render('BootstrapThemeBundle:Default:newart.html.twig',['listTopic'=>$listTopic]);
    }
    
    
    public function registerAction()
    {
        return $this->render('BootstrapThemeBundle:Default:register.html.twig');
    }
    
    
    public function loginAction()
    {
        return $this->render('BootstrapThemeBundle:Default:login.html.twig');
    }
    
    
    public function passchangeAction()
    {
        return $this->render('BootstrapThemeBundle:Default:passchange.html.twig');
    }
    
    
    /**
     * @Route("/{page}", name="static")
    */
    public function staticAction($page)
{
    return $this->render('BootstrapThemeBundle:Static:'.$page.'.html.twig');
}
}
