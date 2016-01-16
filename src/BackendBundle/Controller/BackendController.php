<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\DondeEstamos;
use BackendBundle\Entity\MiembroConsejo;
use BackendBundle\Entity\MisionVision;
use BackendBundle\Entity\Noticia;
use BackendBundle\Entity\Video;
use BackendBundle\Form\DondeEstamosEditType;
use BackendBundle\Form\DondeEstamosType;
use BackendBundle\Form\MiembroConsejoEditType;
use BackendBundle\Form\MiembroConsejoType;
use BackendBundle\Form\MisionVisionEditType;
use BackendBundle\Form\MisionVisionType;
use BackendBundle\Form\NoticiaEditType;
use BackendBundle\Form\NoticiaType;
use BackendBundle\Form\VideoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * @Route("/admin")
 */
class BackendController extends Controller
{

    /**
     * @Route("/", name="dashboard")
     * @Template()
     */
    public function dashboardAction()
    {

        return array();

    }

    /**
     * @Route("/mision_vision", name="_mision_vision")
     * @Template()
     */
    public function misionVisionAction()
    {

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:MisionVision");
        $entities = $repo->findAll();

        if (count($entities) > 0)
            return $this->render("BackendBundle:MisionVision:index.html.twig", array("entity" => $entities[0]));
        else
            return $this->render("BackendBundle:MisionVision:index.html.twig");

    }

    /**
     * @Route("/mision_vision_create", name="_mision_vision_create")
     * @Method("POST")
     */
    public function misionVisionCreateAction(Request $request)
    {

        $document = new MisionVision();
        $form = $this->createForm(MisionVisionType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();

            echo json_encode(array("status" => true, "message" => "Página modificada satisfactoriamente."));
            die;
        } else {
            echo json_encode(array("status" => false, "message" => "Los datos que envía son incorrectos."));
            die;

        }

    }

    /**
     * @Route("/mision_vision_new", name="_mision_vision_new")
     * @Template()
     */
    public function newMisionVisionAction()
    {
        $document = new MisionVision();
        $form = $this->createForm(MisionVisionType::class, $document);
        return $this->render("BackendBundle:MisionVision:new.html.twig", array(
            'entity' => $document,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/mision_vision_edit/{id}", name="_mision_vision_edit")
     * @Template()
     */
    public function editMisionVisionAction($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:MisionVision')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la página.');
        }

        $form = $this->createForm(MisionVisionEditType::class, $document);

        return $this->render("BackendBundle:MisionVision:edit.html.twig", array(
            'entity' => $document,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/mision_vision_update/{id}", name="_mision_vision_update")
     * @Method("POST")
     */
    public function updateMisionVisionAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:MisionVision')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Operation document.');
        }

        $editForm = $this->createForm(MisionVisionEditType::class, $document);
        $editForm->handleRequest($request);
        try {
            $dm->persist($document);
            $dm->flush();
            echo json_encode(array("status" => true, "message" => "Pagina modificada satisfactoriamente."));
            die;

        } catch (\Exception $e) {
            echo json_encode(array("status" => false, "message" => $e->getMessage()));
            die;

        }


    }



    /*
     * Donde Estamos
     */
    /**
     * @Route("/donde_estamos", name="_donde_estamos")
     * @Template()
     */
    public function dondeEstamosAction()
    {

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:DondeEstamos");
        $entities = $repo->findAll();

        if (count($entities) > 0)
            return $this->render("BackendBundle:DondeEstamos:index.html.twig", array("entity" => $entities[0]));
        else
            return $this->render("BackendBundle:DondeEstamos:index.html.twig");

    }

    /**
     * @Route("/donde_estamos_create", name="_donde_estamos_create")
     * @Method("POST")
     */
    public function dondeEstamosCreateAction(Request $request)
    {
        $document = new DondeEstamos();
        $form = $this->createForm(DondeEstamosType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();
            echo json_encode(array("status" => true, "message" => "Pagina modificada satisfactoriamente."));
            die;

        } else {
            echo json_encode(array("status" => false, "message" => "Los datos que envía son incorrectos."));
            die;

        }


    }

    /**
     * @Route("/donde_estamos_new", name="_donde_estamos_new")
     * @Template()
     */
    public function newDondeEstamosAction()
    {
        $document = new DondeEstamos();
        $form = $this->createForm(DondeEstamosType::class, $document);
        return $this->render("BackendBundle:DondeEstamos:new.html.twig", array(
            'entity' => $document,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/donde_estamos_edit/{id}", name="_donde_estamos_edit")
     * @Template()
     */
    public function editDondeEstamosAction($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:DondeEstamos')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la página.');
        }

        $form = $this->createForm(DondeEstamosEditType::class, $document);

        return $this->render("BackendBundle:DondeEstamos:edit.html.twig", array(
            'entity' => $document,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/donde_estamos_update/{id}", name="_donde_estamos_update")
     * @Method("POST")
     */
    public function updateDondeEstamosAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:DondeEstamos')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Operation document.');
        }

        $editForm = $this->createForm(DondeEstamosEditType::class, $document);
        $editForm->handleRequest($request);
        try {
            $dm->persist($document);
            $dm->flush();
            echo json_encode(array("status" => true, "message" => "Página modificada satisfactoriamente."));
            die;

        } catch (\Exception $e) {
            echo json_encode(array("status" => false, "message" => $e->getMessage()));
            die;

        }

    }


    /**
     * @Route("/videos", name="_videos")
     * @Template()
     * @return array
     */
    public function videosAction()
    {
        $dm = $this->getDoctrine()->getManager();
        $videos = $dm->getRepository('BackendBundle:Video')->findAll();
        return $this->render('BackendBundle:Videos:index.html.twig', array("entities" => $videos));
    }

    /**
     * @Route("/videos_new", name="_videos_new")
     * @Template()
     * @return array
     */
    public function videosNewAction()
    {
        $document = new Video();
        $form = $this->createForm(VideoType::class, $document);
        return $this->render("BackendBundle:Videos:new.html.twig", array(
            'entity' => $document,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/videos_create", name="_videos_create")
     * @Method("POST")
     */
    public function videosCreateAction(Request $request)
    {
        $document = new Video();
        $form = $this->createForm(VideoType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();
            echo json_encode(array("status"=> true, "message"=> "Video registrado satisfactoriamente."));
            die;

        } else {
            echo json_encode(array("status"=> false, "message"=> "Los datos que envía son incorrectos."));
            die;

        }


    }


    /**
     * @Route("/videos_delete/{id}", name="_videos_delete")
     * @Template()
     */
    public function videosDeleteAction($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Video')->find($id);

        if (!$document) {
            echo json_encode(array("status"=> false, "message"=> "No se encontró el Video que quiere eliminar."));
            die;
        }
        try {
            $dm->remove($document);
            $dm->flush();
            echo json_encode(array("status"=> true, "message"=> "Video eliminado satisfactoriamente."));
            die;
        } catch (Exception $e) {
            echo json_encode(array("status"=> false, "message"=> $e->getMessage()));
            die;

        }


    }


    /**
     * @Route("/videos_edit/{id}", name="_videos_edit")
     * @Template()
     */
    public function editVideosAction($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Video')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar el Video.');
        }

        $form = $this->createForm(VideoType::class, $document);

        return $this->render("BackendBundle:Videos:edit.html.twig", array(
            'entity' => $document,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/videos_update/{id}", name="_videos_update")
     * @Method("POST")
     */
    public function updateVideosAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Video')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar el Video.');
        }

        $editForm = $this->createForm(VideoType::class, $document);
        $editForm->handleRequest($request);


        try {
            $dm->persist($document);
            $dm->flush();
            echo json_encode(array("status"=> true, "message"=> "Video modificado satisfactoriamente."));
            die;
        } catch (Exception $e) {
           echo json_encode(array("status"=> false, "message"=> $e->getMessage()));
            die;
        }


    }

    /*Consejo de Administración*/


    /**
     * @Route("/consejo_administracion", name="_consejo_administracion")
     * @Template()
     * @return array
     */
    public function consejoAdministracionAction()
    {
        $dm = $this->getDoctrine()->getManager();
        $miembros= $dm->getRepository('BackendBundle:MiembroConsejo')->findAll();
        return $this->render('BackendBundle:MiembroConsejo:index.html.twig', array("entities" => $miembros));
    }


    /**
     * @Route("/consejo_administracion_new", name="_consejo_administracion_new")
     * @Template()
     * @return array
     */
    public function consejoAdministracionNewAction()
    {
        $document = new MiembroConsejo();
        $form = $this->createForm(MiembroConsejoType::class, $document);
        return $this->render("BackendBundle:MiembroConsejo:new.html.twig", array(
            'entity' => $document,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/consejo_administracion_create", name="_consejo_administracion_create")
     * @Method("POST")
     */
    public function consejoAdministracionCreateAction(Request $request)
    {
        $document = new MiembroConsejo();
        $form = $this->createForm(MiembroConsejoType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();
            echo json_encode(array("status"=> true, "message"=> "Miembro del Consejo registrado satisfactoriamente."));
            die;

        } else {
            echo json_encode(array("status"=> false, "message"=> "Los datos que envía son incorrectos."));
            die;

        }


    }


    /**
     * @Route("/consejo_administracion_delete/{id}", name="_consejo_administracion_delete")
     * @Template()
     */
    public function consejoAdministracionDeleteAction($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:MiembroConsejo')->find($id);

        if (!$document) {
            echo json_encode(array("status"=> false, "message"=> "No se encontró el Miembro del Consejo que quiere eliminar."));
            die;
        }
        try {
            $dm->remove($document);
            $dm->flush();
            echo json_encode(array("status"=> true, "message"=> "Miembro del Consejo eliminado satisfactoriamente."));
            die;
        } catch (Exception $e) {
            echo json_encode(array("status"=> false, "message"=> $e->getMessage()));
            die;

        }


    }


    /**
     * @Route("/consejo_administracion_edit/{id}", name="_consejo_administracion_edit")
     * @Template()
     */
    public function editconsejoAdministracionAction($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:MiembroConsejo')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar el Video.');
        }

        $form = $this->createForm(MiembroConsejoEditType::class, $document);

        return $this->render("BackendBundle:MiembroConsejo:edit.html.twig", array(
            'entity' => $document,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/consejo_administracion_update/{id}", name="_consejo_administracion_update")
     * @Method("POST")
     */
    public function updateconsejoAdministracionAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:MiembroConsejo')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar el Video.');
        }

        $editForm = $this->createForm(MiembroConsejoEditType::class, $document);
        $editForm->handleRequest($request);


        try {
            $dm->persist($document);
            $dm->flush();
            echo json_encode(array("status"=> true, "message"=> "Miembro de Consejo modificado satisfactoriamente."));
            die;
        } catch (Exception $e) {
            echo json_encode(array("status"=> false, "message"=> $e->getMessage()));
            die;
        }


    }
    /**
     * @Route("/consejo_administracion_show/{id}", name="_consejo_administracion_show")
     */
    public function showconsejoAdministracionAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:MiembroConsejo')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar el Miembro del Consejo.');
        }

        return $this->render('BackendBundle:MiembroConsejo:show.html.twig', array("entity" => $document));


    }
    /**
     * @Route("/noticia/{owner}", name="_noticia")
     * @Template()
     * @return array
     */
    public function noticiaAction($owner)
    {
        $dm = $this->getDoctrine()->getManager();
        $miembros= $dm->getRepository('BackendBundle:Noticia')->findBy(array("owner"=> $owner));
        return $this->render('BackendBundle:Noticia:index.html.twig', array("entities" => $miembros, "owner"=> $owner));
    }


    /**
     * @Route("/noticia_new/{owner}", name="_noticia_new")
     * @Template()
     * @return array
     */
    public function noticiaNewAction($owner)
    {
        $document = new Noticia();
        $form = $this->createForm(NoticiaType::class, $document);
        return $this->render("BackendBundle:Noticia:new.html.twig", array(
            'entity' => $document,
            'form' => $form->createView(),
            'owner' => $owner
        ));
    }

    /**
     * @Route("/noticia_create/{owner}", name="_noticia_create")
     * @Method("POST")
     */
    public function noticiaCreateAction(Request $request, $owner)
    {
        $document = new Noticia();
        $form = $this->createForm(NoticiaType::class, $document);
        $form->handleRequest($request);


            $document->setOwner($owner);
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();
            echo json_encode(array("status"=> true, "message"=> "Noticia registrada satisfactoriamente."));
            die;




    }


    /**
     * @Route("/noticia_delete/{id}", name="_noticia_delete")
     * @Template()
     */
    public function noticiaDeleteAction($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Noticia')->find($id);

        if (!$document) {
            echo json_encode(array("status"=> false, "message"=> "No se encontró la Noticia que quiere eliminar."));
            die;
        }
        try {
            $dm->remove($document);
            $dm->flush();
            echo json_encode(array("status"=> true, "message"=> "Noticia eliminada satisfactoriamente."));
            die;
        } catch (Exception $e) {
            echo json_encode(array("status"=> false, "message"=> $e->getMessage()));
            die;

        }


    }


    /**
     * @Route("/noticia_edit/{id}/{owner}", name="_noticia_edit")
     * @Template()
     */
    public function editnoticiaAction($id, $owner)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Noticia')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la Noticia.');
        }

        $form = $this->createForm(NoticiaEditType::class, $document);

        return $this->render("BackendBundle:Noticia:edit.html.twig", array(
            'entity' => $document,
            'form' => $form->createView(),
            "owner"=> $owner
        ));
    }

    /**
     * @Route("/noticia_update/{id}", name="_noticia_update")
     * @Method("POST")
     */
    public function updatenoticiaAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Noticia')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la Noticia.');
        }

        $editForm = $this->createForm(NoticiaEditType::class, $document);
        $editForm->handleRequest($request);


        try {
            $dm->persist($document);
            $dm->flush();
            echo json_encode(array("status"=> true, "message"=> "Noticia modificada satisfactoriamente."));
            die;
        } catch (Exception $e) {
            echo json_encode(array("status"=> false, "message"=> $e->getMessage()));
            die;
        }


    }
    /**
     * @Route("/noticia_show/{id}", name="_noticia_show")
     */
    public function shownoticiaAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Noticia')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la Noticia.');
        }

        return $this->render('BackendBundle:Noticia:show.html.twig', array("entity" => $document));


    }

}
