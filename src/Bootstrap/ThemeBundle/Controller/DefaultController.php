<?php

namespace Bootstrap\ThemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BootstrapThemeBundle:Default:index.html.twig');
    }
    
    
    public function categoriesAction()
    {
        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('BootstrapThemeBundle:Category');
        $listCategory = $repository->findAll();
        
        
        return $this->render('BootstrapThemeBundle:Default:categories.html.twig',['listCategory'=>$listCategory]);
    }
    
    
     public function discussionAction()
    {
        return $this->render('BootstrapThemeBundle:Default:discussion.html.twig');
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
               array('tag' => $tagName)
//               array('date' => 'desc')
                );
              
        return $this->render('BootstrapThemeBundle:Default:sujets.html.twig',['listTopic'=>$listTopic]);
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
