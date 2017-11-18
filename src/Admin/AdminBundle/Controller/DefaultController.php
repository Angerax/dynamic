<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
    
    
    public function categoryAction()
    {
        return $this->render('AdminAdminBundle:Default:category.html.twig');
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
