<?php

namespace Admin\AdminBundle\Controller;

use Admin\AdminBundle\Form\CategoryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Bootstrap\ThemeBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdminAdminBundle:Default:index.html.twig');
    }
    
    public function usersAction()
    {
        return $this->render('AdminAdminBundle:Default:users.html.twig');
    }
    
    
    public function categoryAction(Request $request)
    {
        // Création de l'entité Advert
        $advert = new Category();
        
       $form = $this->createForm(CategoryType::class,$advert);
       
        if ($form->handleRequest($request)->isSubmitted()){
                //On persiste l'entité
                $em = $this->get('doctrine.orm.entity_manager');
                $em->persist($advert);
                $em->flush();
                
                //On crée un message d'info
                $this->get('session')->getFlashBag()->add('notice','Catégorie bien enregistrée');
                //On redirige
                return $this->redirectToRoute('admin_admin_category',['id'=>$advert->getId()]);
                
        }
        if ($form->isSubmitted()){
            //On crée un message d'info
            $this->get('session')->getFlashBag()->add('notice','Probleme avec le formulaire');
        }

        return $this->render('AdminAdminBundle:Default:category.html.twig',['myForm'=>$form->createView()]);
    }
    
    
    public function topicsAction()
    {
        return $this->render('AdminAdminBundle:Default:topics.html.twig');
    }
    
    
    public function messagesAction()
    {
        return $this->render('AdminAdminBundle:Default:messages.html.twig');
    }
    
    /**
     * @Route("/{page}", name="admin")
    */
    public function adminAction($page)
{
    return $this->render('AdminAdminBundle:Admin:'.$page.'.html.twig');
}
}
