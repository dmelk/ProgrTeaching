<?php

namespace Melk\ProgrTeach\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MelkProgrTeachMainBundle:Default:index.html.twig', array('name' => $name));
    }
}
