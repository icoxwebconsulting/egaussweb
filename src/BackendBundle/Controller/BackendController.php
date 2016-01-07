<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin")
 */
class BackendController extends Controller {

    /**
     * @Route("/", name="dashboard")
     * @Template()
     */
    public function dashboardAction() {

    }



}
