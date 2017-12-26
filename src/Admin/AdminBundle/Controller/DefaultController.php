<?php

namespace Admin\AdminBundle\Controller;

use Admin\AdminBundle\Form\CategoryType;
use Admin\AdminBundle\Form\TopicType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Bootstrap\ThemeBundle\Entity\Category;
use Bootstrap\ThemeBundle\Entity\Topic;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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
        
        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('BootstrapThemeBundle:Category');
        $listCategory = $repository->findAll();
 
        return $this->render('AdminAdminBundle:Default:Category.html.twig',['listCategory'=>$listCategory,
                                                                             'myForm'=>$form->createView()]);
    }
    
    
    public function TopicAction(Request $request)
    {
        // Création de l'entité Advert
        $advert = new Topic();
        
       $form = $this->createForm(TopicType::class,$advert);
       
        if ($form->handleRequest($request)->isSubmitted()){
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
       
        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('BootstrapThemeBundle:Topic');
        $listTopic = $repository->findAll();
 
        return $this->render('AdminAdminBundle:Default:Topic.html.twig',['listTopic'=>$listTopic,
                                                                             'TopicForm'=>$form->createView()]);
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
        
//        $del = $repository->find($id);
//        $em = $this->getDoctrine()->getManager(); 
        
 if ($del != null){       
 $em->remove($del); 
 $em->flush();
 }
 
            $referer = $request->headers->get('referer');
            return $this->redirect($referer);

    }
}