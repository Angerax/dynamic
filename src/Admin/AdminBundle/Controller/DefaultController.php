<?php

namespace Admin\AdminBundle\Controller;

use Admin\AdminBundle\Form\CategoryType;
use Admin\AdminBundle\Form\TopicType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Bootstrap\ThemeBundle\Entity\Category;
use Bootstrap\ThemeBundle\Entity\Topic;
use Bootstrap\ThemeBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
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
        
        return $this->render('AdminAdminBundle:Default:index.html.twig',['postPages'=>$postPages]);
    }
    
    public function usersAction(Request $request)
    {
        //Affiche les utilisateurs
        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('BootstrapThemeBundle:users');
        $listUsers = $repository->findAll();
        
        //Définis la pagination à 5 éléments par page
        $usersPages  = $this->get('knp_paginator')->paginate(
        $listUsers,
        $request->query->get('page', 1)/*le numéro de la page à afficher*/,
          5/*nbre d'éléments par page*/
    );
        
        return $this->render('AdminAdminBundle:Default:users.html.twig',['usersPages'=>$usersPages, 'listUsers'=>$listUsers]);
    }
    
 
    public function CategoryAction(Request $request)
    {
        // Création de l'entité Advert
        $advert = new Category();
        
        $form = $this->createForm(CategoryType::class,$advert);
       
        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()){
                //On persiste l'entité
                $em = $this->get('doctrine.orm.entity_manager');
                $em->persist($advert);
                $em->flush();
                
                //On crée un message d'info
                $this->get('session')->getFlashBag()->add('notice','Catégorie bien enregistrée');
                //On redirige
                return $this->redirectToRoute('admin_admin_Category',['id'=>$advert->getId()]);
                
        }
        if ($form->isSubmitted()){
            //On crée un message d'info
            $this->get('session')->getFlashBag()->add('notice','Probleme avec le formulaire');
        }
        
        //Affiche les catégories
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
 
        return $this->render('AdminAdminBundle:Default:Category.html.twig',['categoriesPages'=>$categoriesPages, 'listCategory'=>$listCategory,
                                                                             'myForm'=>$form->createView()]);
    }
    
    
    public function TopicAction(Request $request)
    {
        // Création de l'entité Advert
        $advert = new Topic();
        
        $form = $this->createForm(TopicType::class,$advert);
       
        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()){
                //On persiste l'entité
                $em = $this->get('doctrine.orm.entity_manager');
                $em->persist($advert);
                $em->flush();
                
                //On crée un message d'info
                $this->get('session')->getFlashBag()->add('notice','Sujet bien enregistrée');
                //On redirige
                return $this->redirectToRoute('admin_admin_Topic',['id'=>$advert->getId()]);
                
        }
        if ($form->isSubmitted()){
            //On crée un message d'info
            $this->get('session')->getFlashBag()->add('notice','Probleme avec le formulaire');
        }
        
        //Affiche les Sujets
        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('BootstrapThemeBundle:Topic');
        $listTopic = $repository->findAll();
        
        //Définis la pagination à 10 éléments par page
        $topicPages  = $this->get('knp_paginator')->paginate(
        $listTopic,
        $request->query->get('page', 1)/*le numéro de la page à afficher*/,
          10/*nbre d'éléments par page*/
    );
 
        return $this->render('AdminAdminBundle:Default:Topic.html.twig',['topicPages'=>$topicPages, 'listTopic'=>$listTopic,
                                                                             'TopicForm'=>$form->createView()]);
    }
    
    
    public function messagesAction(Request $request)
    {   
        //Affiche les messages
        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('BootstrapThemeBundle:Post');
        $listPost = $repository->findAll();
        
        //Définis la pagination à 5 éléments par page
        $postPages  = $this->get('knp_paginator')->paginate(
        $listPost,
        $request->query->get('page', 1)/*le numéro de la page à afficher*/,
          5/*nbre d'éléments par page*/
    );
        
        return $this->render('AdminAdminBundle:Default:messages.html.twig',['postPages'=>$postPages, 'listPost'=>$listPost]);
    }
    
    /**
     * @Route("/{page}", name="admin")
    */
    public function adminAction($page)
{
        return $this->render('AdminAdminBundle:Default:'.$page.'.html.twig');
}


/**
 * @param $id
 *
 * @Route("{page}/{id}", requirements={"id" = "\d+"}, name="admin_admin_delete")
 * @return  RedirectResponse
 */
public function deleteAction(Request $request,$id,$page){
    
        $em = $this->getDoctrine()->getManager();
        $del = $em->getRepository('BootstrapThemeBundle:'.$page)->findOneBy(array('id' => $id));
        
        
        if ($del != null){       
        $em->remove($del); 
        $em->flush();
        }
 
        $referer = $request->headers->get('referer');
        return $this->redirect($referer);

    }
}