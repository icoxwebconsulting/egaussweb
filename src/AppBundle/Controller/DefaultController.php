<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:Video");
        $videos = $repo->findBy(array("inhomepage"=> true));
        return $this->render("AppBundle:App:index.html.twig", array("videos"=> $videos ));
    }

    /**
     * @Route("/mision_vision", name="mision_vision")
     */
    public function misionVisionAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:MisionVision");
        $page = $repo->findAll();
        return $this->render("AppBundle:App:misionVision.html.twig", array("entity"=> $page[0] ));
    }

    /**
     * @Route("/donde_estamos", name="donde_estamos")
     */
    public function dondeEstamosAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:DondeEstamos");
        $page = $repo->findAll();
        return $this->render("AppBundle:App:dondeEstamos.html.twig", array("entity"=> $page[0] ));
    }

    /**
     * @Route("/quienes_somos", name="quienes_somos")
     */
    public function quienesSomosAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:QuienesSomos");
        $page = $repo->findAll();
        $repoconsejo = $em->getRepository("BackendBundle:MiembroConsejo");
        $members = $repoconsejo->findAll();
        return $this->render("AppBundle:App:quienesSomos.html.twig", array("entity"=> $page[0], 'members'=> $members ));
    }

    /**
     * @Route("/que_es_global", name="que_es_global")
     */
    public function queEsGlobalAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:QueEsGlobal");
        $page = $repo->findAll();

        return $this->render("AppBundle:App:queEsGlobal.html.twig", array("entity"=> $page[0] ));
    }

    /**
     * @Route("/global2016", name="global2016")
     */
    public function global2016Action()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:Global2016");
        $page = $repo->findAll();

        return $this->render("AppBundle:App:Global2016.html.twig", array("entity"=> $page[0] ));
    }
}
