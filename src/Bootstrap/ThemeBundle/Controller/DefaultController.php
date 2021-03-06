<?php

namespace Bootstrap\ThemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BootstrapThemeBundle:Default:index.html.twig');
    }
    
    
    public function categoriesAction()
    {
//        $em = $this->get('doctrine.orm.entity_manager');
//        $repo = $em->getRepository('BootstrapThemeBundle:Category');
//        $advert = $repo->find($id);
//        
//        if (null === $advert){
//            throw new NotFoundHttpException('Pas d\'avert avec cet id');
//        }
//
////        // On récupère la liste des candidatures de cette annonce
////
////        $listApplications = $em
////            ->getRepository('BootstrapThemeBundle:Application')
////            ->findBy(['advert' => $advert])
////        ;
//        
//        
//        return $this->render('@BootstrapTheme/Default/categories.html.twig');
        
        return $this->render('BootstrapThemeBundle:Default:categories.html.twig');
    }
    
    
     public function discussionAction()
    {
        return $this->render('BootstrapThemeBundle:Default:discussion.html.twig');
    }
    
    
    public function sujetsAction()
    {
        return $this->render('BootstrapThemeBundle:Default:sujets.html.twig');
    }
    
    
    public function compteAction()
    {
        return $this->render('BootstrapThemeBundle:Default:compte.html.twig');
    }
    
    
    public function newartAction()
    {
        return $this->render('BootstrapThemeBundle:Default:newart.html.twig');
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
