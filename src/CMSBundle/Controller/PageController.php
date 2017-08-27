<?php

namespace CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PageController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pages = $em->getRepository('CMSBundle\\Entity\\Page')->findAll();
        return $this->render('CMSBundle:Default:index.html.twig',array('pages' => $pages));
    }

    /**
     * Matches /blog/*
     *
     * @Route("/page/{slug}", name="_page_show")
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $page = $em->getRepository('CMSBundle\\Entity\\Page')->findOneBy(array('slug'=> $slug));

        $parameters['pages'] = $em->getRepository('CMSBundle\\Entity\\Page')->findAll();

        $parameters['title'] = $page->getTitle();
        $parameters['content'] = $page->getContent();


        return $this->render('CMSBundle:Page:show.html.twig', $parameters);
    }

}
