<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\MisionVision;
use BackendBundle\Form\MisionVisionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * @Route("/admin")
 */
class BackendController extends Controller {

    /**
     * @Route("/", name="dashboard")
     * @Template()
     */
    public function dashboardAction() {

        return array();

    }

    /**
     * @Route("/mision_vision", name="_mision_vision")
     * @Template()
     */
    public function misionVisionAction() {

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:MisionVision");
        $entities = $repo->findAll();

        if(count($entities)>0)
        return $this->render("BackendBundle:MisionVision:misionVision.html.twig", array("entity" => $entities[0]));
        else
            return $this->render("BackendBundle:MisionVision:misionVision.html.twig");

    }

    /**
     * @Route("/mision_vision_create", name="_mision_vision_create")
     * @Method("POST")
     */
    public function misionVisionCreateAction(Request $request) {

        $document = new MisionVision();
        $form = $this->createForm(MisionVisionType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();

            return $this->render("BackendBundle:MisionVision:misionVision.html.twig", array("entity" => $document));
        }

        return $this->render("::error.html.twig");

    }

    /**
     * @Route("/mision_vision_new", name="_mision_vision_new")
     * @Template()
     */
    public function newAction() {
        $document = new MisionVision();
        $form = $this->createForm(MisionVisionType::class, $document);
        return $this->render("BackendBundle:MisionVision:new.html.twig", array(
            'entity' => $document,
            'form' => $form->createView()
        ));
    }



}
