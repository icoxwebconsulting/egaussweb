<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Banner;
use BackendBundle\Entity\Colaborador;
use BackendBundle\Entity\DondeEstamos;
use BackendBundle\Entity\Ecosistema;
use BackendBundle\Entity\Estructura;
use BackendBundle\Entity\Evento;
use BackendBundle\Entity\Global2016;
use BackendBundle\Entity\MiembroConsejo;
use BackendBundle\Entity\MisionVision;
use BackendBundle\Entity\Noticia;
use BackendBundle\Entity\QueEsGlobal;
use BackendBundle\Entity\QuienesSomos;
use BackendBundle\Entity\Servicio;
use BackendBundle\Entity\Solucion;
use BackendBundle\Entity\Video;
use BackendBundle\Entity\VideoColaborador;
use BackendBundle\Form\BannerEditType;
use BackendBundle\Form\BannerType;
use BackendBundle\Form\ColaboradorEditType;
use BackendBundle\Form\ColaboradorType;
use BackendBundle\Form\DondeEstamosEditType;
use BackendBundle\Form\DondeEstamosType;
use BackendBundle\Form\EcosistemaEditType;
use BackendBundle\Form\EcosistemaType;
use BackendBundle\Form\EstructuraEditType;
use BackendBundle\Form\EstructuraType;
use BackendBundle\Form\EventoEditType;
use BackendBundle\Form\EventoType;
use BackendBundle\Form\Global2016Type;
use BackendBundle\Form\MiembroConsejoEditType;
use BackendBundle\Form\MiembroConsejoType;
use BackendBundle\Form\MisionVisionEditType;
use BackendBundle\Form\MisionVisionType;
use BackendBundle\Form\NoticiaEditType;
use BackendBundle\Form\NoticiaType;
use BackendBundle\Form\QueEsGlobalType;
use BackendBundle\Form\QuienesSomosEditType;
use BackendBundle\Form\QuienesSomosType;
use BackendBundle\Form\ServicioEditType;
use BackendBundle\Form\ServicioType;
use BackendBundle\Form\SolucionEditType;
use BackendBundle\Form\SolucionType;
use BackendBundle\Form\VideoColaboradorType;
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
     * @Route("/videos_show/{id}", name="_videos_show")
     * @Template()
     */
    public function showVideosAction($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Video')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar el Video.');
        }


        return $this->render("BackendBundle:Videos:show.html.twig", array(
            'entity' => $document
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
    
    /*Noticias*/
    
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
            $document->setSlug($document->slugify($document->getTitular()));
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
        $document->setSlug($document->slugify($document->getTitular()));

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


    /*
     * Quienes Somos
     */
    /**
     * @Route("/quienes_somos", name="_quienes_somos")
     * @Template()
     */
    public function quienesSomosAction()
    {

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:QuienesSomos");
        $entities = $repo->findAll();

        if (count($entities) > 0)
            return $this->render("BackendBundle:QuienesSomos:index.html.twig", array("entity" => $entities[0]));
        else
            return $this->render("BackendBundle:QuienesSomos:index.html.twig");

    }

    /**
     * @Route("/quienes_somos_create", name="_quienes_somos_create")
     * @Method("POST")
     */
    public function quienesSomosCreateAction(Request $request)
    {
        $document = new QuienesSomos();
        $form = $this->createForm(QuienesSomosType::class, $document);
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
     * @Route("/quienes_somos_new", name="_quienes_somos_new")
     * @Template()
     */
    public function newQuienesSomosAction()
    {
        $document = new QuienesSomos();
        $form = $this->createForm(QuienesSomosType::class, $document);
        return $this->render("BackendBundle:QuienesSomos:new.html.twig", array(
            'entity' => $document,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/quienes_somos_edit/{id}", name="_quienes_somos_edit")
     * @Template()
     */
    public function editQuienesSomosAction($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:QuienesSomos')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la página.');
        }

        $form = $this->createForm(QuienesSomosEditType::class, $document);

        return $this->render("BackendBundle:QuienesSomos:edit.html.twig", array(
            'entity' => $document,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/quienes_somos_update/{id}", name="_quienes_somos_update")
     * @Method("POST")
     */
    public function updateQuienesSomosAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:QuienesSomos')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Operation document.');
        }

        $editForm = $this->createForm(QuienesSomosEditType::class, $document);
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

/*Que es Gobal*/

    /**
     * @Route("/que_es_global", name="_que_es_global")
     * @Template()
     */
    public function queEsGlobalAction()
    {

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:QueEsGlobal");
        $entities = $repo->findAll();

        if (count($entities) > 0)
            return $this->render("BackendBundle:QueEsGlobal:index.html.twig", array("entity" => $entities[0]));
        else
            return $this->render("BackendBundle:QueEsGlobal:index.html.twig");

    }

    /**
     * @Route("/que_es_global_create", name="_que_es_global_create")
     * @Method("POST")
     */
    public function queEsGlobalCreateAction(Request $request)
    {

        $document = new QueEsGlobal();
        $form = $this->createForm(QueEsGlobalType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();

            echo json_encode(array("status" => true, "message" => "Página creada satisfactoriamente."));
            die;
        } else {
            echo json_encode(array("status" => false, "message" => "Los datos que envía son incorrectos."));
            die;

        }

    }

    /**
     * @Route("/que_es_global_new", name="_que_es_global_new")
     * @Template()
     */
    public function newQueEsGlobalAction()
    {
        $document = new QueEsGlobal();
        $form = $this->createForm(QueEsGlobalType::class, $document);
        return $this->render("BackendBundle:QueEsGlobal:new.html.twig", array(
            'entity' => $document,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/que_es_global_edit/{id}", name="_que_es_global_edit")
     * @Template()
     */
    public function editQueEsGlobalAction($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:QueEsGlobal')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la página.');
        }

        $form = $this->createForm(QueEsGlobalType::class, $document);

        return $this->render("BackendBundle:QueEsGlobal:edit.html.twig", array(
            'entity' => $document,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/que_es_global_update/{id}", name="_que_es_global_update")
     * @Method("POST")
     */
    public function updateQueEsGlobalAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:QueEsGlobal')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la pagina solicitada.');
        }

        $editForm = $this->createForm(QueEsGlobalType::class, $document);
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
    
    
    
    /*Global 2016*/

    /**
     * @Route("/global2016", name="_global2016")
     * @Template()
     */
    public function global2016Action()
    {

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:Global2016");
        $entities = $repo->findAll();

        if (count($entities) > 0)
            return $this->render("BackendBundle:Global2016:index.html.twig", array("entity" => $entities[0]));
        else
            return $this->render("BackendBundle:Global2016:index.html.twig");

    }

    /**
     * @Route("/global2016_create", name="_global2016_create")
     * @Method("POST")
     */
    public function global2016CreateAction(Request $request)
    {

        $document = new Global2016();
        $form = $this->createForm(Global2016Type::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();

            echo json_encode(array("status" => true, "message" => "Página creada satisfactoriamente."));
            die;
        } else {
            echo json_encode(array("status" => false, "message" => "Los datos que envía son incorrectos."));
            die;

        }

    }

    /**
     * @Route("/global2016_new", name="_global2016_new")
     * @Template()
     */
    public function newGlobal2016Action()
    {
        $document = new Global2016();
        $form = $this->createForm(Global2016Type::class, $document);
        return $this->render("BackendBundle:Global2016:new.html.twig", array(
            'entity' => $document,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/global2016_edit/{id}", name="_global2016_edit")
     * @Template()
     */
    public function editGlobal2016Action($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Global2016')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la página.');
        }

        $form = $this->createForm(Global2016Type::class, $document);

        return $this->render("BackendBundle:Global2016:edit.html.twig", array(
            'entity' => $document,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/global2016_update/{id}", name="_global2016_update")
     * @Method("POST")
     */
    public function updateGlobal2016Action(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Global2016')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la pagina solicitada.');
        }

        $editForm = $this->createForm(Global2016Type::class, $document);
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




    /*Colaboradores*/


    /**
     * @Route("/colaboradores", name="_colaboradores")
     * @Template()
     * @return array
     */
    public function colaboradoresAction()
    {
        $dm = $this->getDoctrine()->getManager();
        $miembros= $dm->getRepository('BackendBundle:Colaborador')->findAll();
        return $this->render('BackendBundle:Colaborador:index.html.twig', array("entities" => $miembros));
    }


    /**
     * @Route("/colaboradores_new", name="_colaboradores_new")
     * @Template()
     * @return array
     */
    public function colaboradoresNewAction()
    {
        $document = new Colaborador();
        $form = $this->createForm(ColaboradorType::class, $document);
        return $this->render("BackendBundle:Colaborador:new.html.twig", array(
            'entity' => $document,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/colaboradores_create", name="_colaboradores_create")
     * @Method("POST")
     */
    public function colaboradoresCreateAction(Request $request)
    {
        $document = new Colaborador();
        $form = $this->createForm(ColaboradorType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $document->setSlug($document->slugify($document->getName()));
            $em->persist($document);
            $em->flush();
            echo json_encode(array("status"=> true, "message"=> "Colaborador registrado satisfactoriamente."));
            die;

        } else {
            echo json_encode(array("status"=> false, "message"=> "Los datos que envía son incorrectos."));
            die;

        }


    }


    /**
     * @Route("/colaboradores_delete/{id}", name="_colaboradores_delete")
     * @Template()
     */
    public function colaboradoresDeleteAction($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Colaborador')->find($id);

        if (!$document) {
            echo json_encode(array("status"=> false, "message"=> "No se encontró el Colaborador que quiere eliminar."));
            die;
        }
        try {
            $dm->remove($document);
            $dm->flush();
            echo json_encode(array("status"=> true, "message"=> "Colaborador eliminado satisfactoriamente."));
            die;
        } catch (Exception $e) {
            echo json_encode(array("status"=> false, "message"=> $e->getMessage()));
            die;

        }


    }


    /**
     * @Route("/colaboradores_edit/{id}", name="_colaboradores_edit")
     * @Template()
     */
    public function editcolaboradoresAction($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Colaborador')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar el Video.');
        }

        $form = $this->createForm(ColaboradorEditType::class, $document);

        return $this->render("BackendBundle:Colaborador:edit.html.twig", array(
            'entity' => $document,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/colaboradores_update/{id}", name="_colaboradores_update")
     * @Method("POST")
     */
    public function updatecolaboradoresAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Colaborador')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar el Video.');
        }

        $editForm = $this->createForm(ColaboradorEditType::class, $document);
        $editForm->handleRequest($request);
        $document->setSlug($document->slugify($document->getName()));

        try {
            $dm->persist($document);
            $dm->flush();
            echo json_encode(array("status"=> true, "message"=> "Colaborador modificado satisfactoriamente."));
            die;
        } catch (Exception $e) {
            echo json_encode(array("status"=> false, "message"=> $e->getMessage()));
            die;
        }


    }
    /**
     * @Route("/colaboradores_show/{id}", name="_colaboradores_show")
     */
    public function showcolaboradoresAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Colaborador')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar el Colaborador.');
        }

        return $this->render('BackendBundle:Colaborador:show.html.twig', array("entity" => $document));


    }



    /*Eventos*/

    /**
     * @Route("/evento/{owner}", name="_evento")
     * @Template()
     * @return array
     */
    public function eventoAction($owner)
    {
        $dm = $this->getDoctrine()->getManager();
        $miembros= $dm->getRepository('BackendBundle:Evento')->findBy(array("owner"=> $owner));
        return $this->render('BackendBundle:Evento:index.html.twig', array("entities" => $miembros, "owner"=> $owner));
    }


    /**
     * @Route("/evento_new/{owner}", name="_evento_new")
     * @Template()
     * @return array
     */
    public function eventoNewAction($owner)
    {
        $document = new Evento();
        $form = $this->createForm(EventoType::class, $document);
        return $this->render("BackendBundle:Evento:new.html.twig", array(
            'entity' => $document,
            'form' => $form->createView(),
            'owner' => $owner
        ));
    }

    /**
     * @Route("/evento_create/{owner}", name="_evento_create")
     * @Method("POST")
     */
    public function eventoCreateAction(Request $request, $owner)
    {
        $document = new Evento();
        $form = $this->createForm(EventoType::class, $document);
        $form->handleRequest($request);


        $document->setOwner($owner);
        $em = $this->getDoctrine()->getManager();
        $em->persist($document);
        $em->flush();
        echo json_encode(array("status"=> true, "message"=> "Evento registrado satisfactoriamente."));
        die;




    }


    /**
     * @Route("/evento_delete/{id}", name="_evento_delete")
     * @Template()
     */
    public function eventoDeleteAction($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Evento')->find($id);

        if (!$document) {
            echo json_encode(array("status"=> false, "message"=> "No se encontró la Evento que quiere eliminar."));
            die;
        }
        try {
            $dm->remove($document);
            $dm->flush();
            echo json_encode(array("status"=> true, "message"=> "Evento eliminado satisfactoriamente."));
            die;
        } catch (Exception $e) {
            echo json_encode(array("status"=> false, "message"=> $e->getMessage()));
            die;

        }


    }


    /**
     * @Route("/evento_edit/{id}/{owner}", name="_evento_edit")
     * @Template()
     */
    public function editeventoAction($id, $owner)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Evento')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la Evento.');
        }

        $form = $this->createForm(EventoEditType::class, $document);

        return $this->render("BackendBundle:Evento:edit.html.twig", array(
            'entity' => $document,
            'form' => $form->createView(),
            "owner"=> $owner
        ));
    }

    /**
     * @Route("/evento_update/{id}", name="_evento_update")
     * @Method("POST")
     */
    public function updateeventoAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Evento')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la Evento.');
        }

        $editForm = $this->createForm(EventoEditType::class, $document);
        $editForm->handleRequest($request);


        try {
            $dm->persist($document);
            $dm->flush();
            echo json_encode(array("status"=> true, "message"=> "Evento modificado satisfactoriamente."));
            die;
        } catch (Exception $e) {
            echo json_encode(array("status"=> false, "message"=> $e->getMessage()));
            die;
        }


    }
    /**
     * @Route("/evento_show/{id}", name="_evento_show")
     */
    public function showeventoAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Evento')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la Evento.');
        }

        return $this->render('BackendBundle:Evento:show.html.twig', array("entity" => $document));


    }


    /*VideoColaboradors*/

    /**
     * @Route("/video_colaborador/{owner}", name="_video_colaborador")
     * @Template()
     * @return array
     */
    public function video_colaboradorAction($owner)
    {
        $dm = $this->getDoctrine()->getManager();
        $miembros= $dm->getRepository('BackendBundle:VideoColaborador')->findBy(array("owner"=> $owner));
        return $this->render('BackendBundle:VideoColaborador:index.html.twig', array("entities" => $miembros, "owner"=> $owner));
    }


    /**
     * @Route("/video_colaborador_new/{owner}", name="_video_colaborador_new")
     * @Template()
     * @return array
     */
    public function video_colaboradorNewAction($owner)
    {
        $document = new VideoColaborador();
        $form = $this->createForm(VideoColaboradorType::class, $document);
        return $this->render("BackendBundle:VideoColaborador:new.html.twig", array(
            'entity' => $document,
            'form' => $form->createView(),
            'owner' => $owner
        ));
    }

    /**
     * @Route("/video_colaborador_create/{owner}", name="_video_colaborador_create")
     * @Method("POST")
     */
    public function video_colaboradorCreateAction(Request $request, $owner)
    {
        $document = new VideoColaborador();
        $form = $this->createForm(VideoColaboradorType::class, $document);
        $form->handleRequest($request);

        $document->setOwner($owner);
        $em = $this->getDoctrine()->getManager();
        $em->persist($document);
        $em->flush();
        echo json_encode(array("status"=> true, "message"=> "Video registrado satisfactoriamente."));
        die;
    }


    /**
     * @Route("/video_colaborador_delete/{id}", name="_video_colaborador_delete")
     * @Template()
     */
    public function video_colaboradorDeleteAction($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:VideoColaborador')->find($id);

        if (!$document) {
            echo json_encode(array("status"=> false, "message"=> "No se encontró la VideoColaborador que quiere eliminar."));
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
     * @Route("/video_colaborador_edit/{id}/{owner}", name="_video_colaborador_edit")
     * @Template()
     */
    public function editvideo_colaboradorAction($id, $owner)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:VideoColaborador')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar el Video.');
        }

        $form = $this->createForm(VideoColaboradorType::class, $document);

        return $this->render("BackendBundle:VideoColaborador:edit.html.twig", array(
            'entity' => $document,
            'form' => $form->createView(),
            "owner"=> $owner
        ));
    }

    /**
     * @Route("/video_colaborador_update/{id}", name="_video_colaborador_update")
     * @Method("POST")
     */
    public function updatevideo_colaboradorAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:VideoColaborador')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar el Video.');
        }

        $editForm = $this->createForm(VideoColaboradorType::class, $document);
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
    /**
     * @Route("/video_colaborador_show/{id}", name="_video_colaborador_show")
     */
    public function showvideo_colaboradorAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:VideoColaborador')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar el Video.');
        }

        return $this->render('BackendBundle:VideoColaborador:show.html.twig', array("entity" => $document));


    }



    /**
     * @Route("/banner", name="_banner")
     * @Template()
     */
    public function bannerAction()
    {

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:Banner");
        $entities = $repo->findAll();
            return $this->render("BackendBundle:Banner:index.html.twig", array("entities" => $entities));


    }

    /**
     * @Route("/banner_create", name="_banner_create")
     * @Method("POST")
     */
    public function bannerCreateAction(Request $request)
    {

        $document = new Banner();
        $form = $this->createForm(BannerType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();

            echo json_encode(array("status" => true, "message" => "Banner registrado satisfactoriamente."));
            die;
        } else {
            echo json_encode(array("status" => false, "message" => "Los datos que envía son incorrectos."));
            die;

        }

    }

    /**
     * @Route("/banner_new", name="_banner_new")
     * @Template()
     */
    public function newBannerAction()
    {
        $document = new Banner();
        $form = $this->createForm(BannerType::class, $document);
        return $this->render("BackendBundle:Banner:new.html.twig", array(
            'entity' => $document,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/banner_edit/{id}", name="_banner_edit")
     * @Template()
     */
    public function editBannerAction($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Banner')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar el Banner.');
        }

        $form = $this->createForm(BannerEditType::class, $document);

        return $this->render("BackendBundle:Banner:edit.html.twig", array(
            'entity' => $document,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/banner_update/{id}", name="_banner_update")
     * @Method("POST")
     */
    public function updateBannerAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Banner')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Operation document.');
        }

        $editForm = $this->createForm(BannerEditType::class, $document);
        $editForm->handleRequest($request);
        try {
            $dm->persist($document);
            $dm->flush();
            echo json_encode(array("status" => true, "message" => "Banner modificado satisfactoriamente."));
            die;

        } catch (\Exception $e) {
            echo json_encode(array("status" => false, "message" => $e->getMessage()));
            die;

        }


    }

    /**
     * @Route("/banner_delete/{id}", name="_banner_delete")
     * @Template()
     */
    public function bannerDeleteAction($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Banner')->find($id);

        if (!$document) {
            echo json_encode(array("status"=> false, "message"=> "No se encontró el Banner que quiere eliminar."));
            die;
        }
        try {
            $dm->remove($document);
            $dm->flush();
            echo json_encode(array("status"=> true, "message"=> "Banner eliminado satisfactoriamente."));
            die;
        } catch (Exception $e) {
            echo json_encode(array("status"=> false, "message"=> $e->getMessage()));
            die;

        }


    }

    /**
     * @Route("/banner_show/{id}", name="_banner_show")
     * @Template()
     */
    public function showBannersAction($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Banner')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar el Banner.');
        }


        return $this->render("BackendBundle:Banner:show.html.twig", array(
            'entity' => $document
        ));
    }


    /*
     * Ecosistema
     */
    /**
     * @Route("/ecosistema", name="_ecosistema")
     * @Template()
     */
    public function ecosistemaAction()
    {

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:Ecosistema");
        $entities = $repo->findAll();

        if (count($entities) > 0)
            return $this->render("BackendBundle:Ecosistema:index.html.twig", array("entity" => $entities[0]));
        else
            return $this->render("BackendBundle:Ecosistema:index.html.twig");

    }

    /**
     * @Route("/ecosistema_create", name="_ecosistema_create")
     * @Method("POST")
     */
    public function ecosistemaCreateAction(Request $request)
    {
        $document = new Ecosistema();
        $form = $this->createForm(EcosistemaType::class, $document);
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
     * @Route("/ecosistema_new", name="_ecosistema_new")
     * @Template()
     */
    public function newEcosistemaAction()
    {
        $document = new Ecosistema();
        $form = $this->createForm(EcosistemaType::class, $document);
        return $this->render("BackendBundle:Ecosistema:new.html.twig", array(
            'entity' => $document,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/ecosistema_edit/{id}", name="_ecosistema_edit")
     * @Template()
     */
    public function editEcosistemaAction($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Ecosistema')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la página.');
        }

        $form = $this->createForm(EcosistemaEditType::class, $document);

        return $this->render("BackendBundle:Ecosistema:edit.html.twig", array(
            'entity' => $document,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/ecosistema_update/{id}", name="_ecosistema_update")
     * @Method("POST")
     */
    public function updateEcosistemaAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Ecosistema')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Operation document.');
        }

        $editForm = $this->createForm(EcosistemaEditType::class, $document);
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


    /*Servicios*/

    /**
     * @Route("/servicio/{owner}", name="_servicio")
     * @Template()
     * @return array
     */
    public function servicioAction($owner)
    {
        $dm = $this->getDoctrine()->getManager();
        $miembros= $dm->getRepository('BackendBundle:Servicio')->findBy(array("owner"=> $owner));
        return $this->render('BackendBundle:Servicio:index.html.twig', array("entities" => $miembros, "owner"=> $owner));
    }


    /**
     * @Route("/servicio_new/{owner}", name="_servicio_new")
     * @Template()
     * @return array
     */
    public function servicioNewAction($owner)
    {
        $document = new Servicio();
        $form = $this->createForm(ServicioType::class, $document);
        return $this->render("BackendBundle:Servicio:new.html.twig", array(
            'entity' => $document,
            'form' => $form->createView(),
            'owner' => $owner
        ));
    }

    /**
     * @Route("/servicio_create/{owner}", name="_servicio_create")
     * @Method("POST")
     */
    public function servicioCreateAction(Request $request, $owner)
    {
        $document = new Servicio();
        $form = $this->createForm(ServicioType::class, $document);
        $form->handleRequest($request);


        $document->setOwner($owner);
        $document->setSlug($document->slugify($document->getTitular()));
        $em = $this->getDoctrine()->getManager();
        $em->persist($document);
        $em->flush();
        echo json_encode(array("status"=> true, "message"=> "Servicio registrado satisfactoriamente."));
        die;




    }


    /**
     * @Route("/servicio_delete/{id}", name="_servicio_delete")
     * @Template()
     */
    public function servicioDeleteAction($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Servicio')->find($id);

        if (!$document) {
            echo json_encode(array("status"=> false, "message"=> "No se encontró la Servicio que quiere eliminar."));
            die;
        }
        try {
            $dm->remove($document);
            $dm->flush();
            echo json_encode(array("status"=> true, "message"=> "Servicio eliminado satisfactoriamente."));
            die;
        } catch (Exception $e) {
            echo json_encode(array("status"=> false, "message"=> $e->getMessage()));
            die;

        }


    }


    /**
     * @Route("/servicio_edit/{id}/{owner}", name="_servicio_edit")
     * @Template()
     */
    public function editservicioAction($id, $owner)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Servicio')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la Servicio.');
        }

        $form = $this->createForm(ServicioEditType::class, $document);

        return $this->render("BackendBundle:Servicio:edit.html.twig", array(
            'entity' => $document,
            'form' => $form->createView(),
            "owner"=> $owner
        ));
    }

    /**
     * @Route("/servicio_update/{id}", name="_servicio_update")
     * @Method("POST")
     */
    public function updateservicioAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Servicio')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la Servicio.');
        }

        $editForm = $this->createForm(ServicioEditType::class, $document);
        $editForm->handleRequest($request);
        $document->setSlug($document->slugify($document->getTitular()));

        try {
            $dm->persist($document);
            $dm->flush();
            echo json_encode(array("status"=> true, "message"=> "Servicio modificado satisfactoriamente."));
            die;
        } catch (Exception $e) {
            echo json_encode(array("status"=> false, "message"=> $e->getMessage()));
            die;
        }


    }
    /**
     * @Route("/servicio_show/{id}", name="_servicio_show")
     */
    public function showservicioAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Servicio')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la Servicio.');
        }

        return $this->render('BackendBundle:Servicio:show.html.twig', array("entity" => $document));


    }




    /*Solucions*/

    /**
     * @Route("/solucion/{owner}", name="_solucion")
     * @Template()
     * @return array
     */
    public function solucionAction($owner)
    {
        $dm = $this->getDoctrine()->getManager();
        $miembros= $dm->getRepository('BackendBundle:Solucion')->findBy(array("owner"=> $owner));
        return $this->render('BackendBundle:Solucion:index.html.twig', array("entities" => $miembros, "owner"=> $owner));
    }


    /**
     * @Route("/solucion_new/{owner}", name="_solucion_new")
     * @Template()
     * @return array
     */
    public function solucionNewAction($owner)
    {
        $document = new Solucion();
        $form = $this->createForm(SolucionType::class, $document);
        return $this->render("BackendBundle:Solucion:new.html.twig", array(
            'entity' => $document,
            'form' => $form->createView(),
            'owner' => $owner
        ));
    }

    /**
     * @Route("/solucion_create/{owner}", name="_solucion_create")
     * @Method("POST")
     */
    public function solucionCreateAction(Request $request, $owner)
    {
        $document = new Solucion();
        $form = $this->createForm(SolucionType::class, $document);
        $form->handleRequest($request);


        $document->setOwner($owner);
        $document->setSlug($document->slugify($document->getTitular()));
        $em = $this->getDoctrine()->getManager();
        $em->persist($document);
        $em->flush();
        echo json_encode(array("status"=> true, "message"=> "Solucion registrado satisfactoriamente."));
        die;




    }


    /**
     * @Route("/solucion_delete/{id}", name="_solucion_delete")
     * @Template()
     */
    public function solucionDeleteAction($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Solucion')->find($id);

        if (!$document) {
            echo json_encode(array("status"=> false, "message"=> "No se encontró la Solucion que quiere eliminar."));
            die;
        }
        try {
            $dm->remove($document);
            $dm->flush();
            echo json_encode(array("status"=> true, "message"=> "Solucion eliminado satisfactoriamente."));
            die;
        } catch (Exception $e) {
            echo json_encode(array("status"=> false, "message"=> $e->getMessage()));
            die;

        }


    }


    /**
     * @Route("/solucion_edit/{id}/{owner}", name="_solucion_edit")
     * @Template()
     */
    public function editsolucionAction($id, $owner)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Solucion')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la Solucion.');
        }

        $form = $this->createForm(SolucionEditType::class, $document);

        return $this->render("BackendBundle:Solucion:edit.html.twig", array(
            'entity' => $document,
            'form' => $form->createView(),
            "owner"=> $owner
        ));
    }

    /**
     * @Route("/solucion_update/{id}", name="_solucion_update")
     * @Method("POST")
     */
    public function updatesolucionAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Solucion')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la Solucion.');
        }

        $editForm = $this->createForm(SolucionEditType::class, $document);
        $editForm->handleRequest($request);
        $document->setSlug($document->slugify($document->getTitular()));

        try {
            $dm->persist($document);
            $dm->flush();
            echo json_encode(array("status"=> true, "message"=> "Solucion modificado satisfactoriamente."));
            die;
        } catch (Exception $e) {
            echo json_encode(array("status"=> false, "message"=> $e->getMessage()));
            die;
        }


    }
    /**
     * @Route("/solucion_show/{id}", name="_solucion_show")
     */
    public function showsolucionAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Solucion')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la Solucion.');
        }

        return $this->render('BackendBundle:Solucion:show.html.twig', array("entity" => $document));


    }
    /*Estructuras*/

    /**
     * @Route("/estructura/{owner}", name="_estructura")
     * @Template()
     * @return array
     */
    public function estructuraAction($owner)
    {

        $dm = $this->getDoctrine()->getManager();
        $miembros= $dm->getRepository('BackendBundle:Estructura')->findBy(array("owner"=> $owner));
        if (count($miembros) > 0)
            return $this->render("BackendBundle:Estructura:index.html.twig", array("entity" => $miembros[0], "owner"=>$owner));
        else
            return $this->render("BackendBundle:Estructura:index.html.twig", array( "owner"=>$owner));
    }


    /**
     * @Route("/estructura_new/{owner}", name="_estructura_new")
     * @Template()
     * @return array
     */
    public function estructuraNewAction($owner)
    {
        $document = new Estructura();
        $form = $this->createForm(EstructuraType::class, $document);
        return $this->render("BackendBundle:Estructura:new.html.twig", array(
            'entity' => $document,
            'form' => $form->createView(),
            'owner' => $owner
        ));
    }

    /**
     * @Route("/estructura_create/{owner}", name="_estructura_create")
     * @Method("POST")
     */
    public function estructuraCreateAction(Request $request, $owner)
    {
        $document = new Estructura();
        $form = $this->createForm(EstructuraType::class, $document);
        $form->handleRequest($request);


        $document->setOwner($owner);
        $document->setSlug($document->slugify($document->getTitular()));
        $em = $this->getDoctrine()->getManager();
        $em->persist($document);
        $em->flush();
        echo json_encode(array("status"=> true, "message"=> "Estructura registrada satisfactoriamente."));
        die;




    }


    /**
     * @Route("/estructura_delete/{id}", name="_estructura_delete")
     * @Template()
     */
    public function estructuraDeleteAction($id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Estructura')->find($id);

        if (!$document) {
            echo json_encode(array("status"=> false, "message"=> "No se encontró la Estructura que quiere eliminar."));
            die;
        }
        try {
            $dm->remove($document);
            $dm->flush();
            echo json_encode(array("status"=> true, "message"=> "Estructura eliminada satisfactoriamente."));
            die;
        } catch (Exception $e) {
            echo json_encode(array("status"=> false, "message"=> $e->getMessage()));
            die;

        }


    }


    /**
     * @Route("/estructura_edit/{id}/{owner}", name="_estructura_edit")
     * @Template()
     */
    public function editestructuraAction($id, $owner)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Estructura')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la Estructura.');
        }

        $form = $this->createForm(EstructuraEditType::class, $document);

        return $this->render("BackendBundle:Estructura:edit.html.twig", array(
            'entity' => $document,
            'form' => $form->createView(),
            "owner"=> $owner
        ));
    }

    /**
     * @Route("/estructura_update/{id}", name="_estructura_update")
     * @Method("POST")
     */
    public function updateestructuraAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Estructura')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la Estructura.');
        }

        $editForm = $this->createForm(EstructuraEditType::class, $document);
        $editForm->handleRequest($request);
        $document->setSlug($document->slugify($document->getTitular()));

        try {
            $dm->persist($document);
            $dm->flush();
            echo json_encode(array("status"=> true, "message"=> "Estructura modificada satisfactoriamente."));
            die;
        } catch (Exception $e) {
            echo json_encode(array("status"=> false, "message"=> $e->getMessage()));
            die;
        }


    }
    /**
     * @Route("/estructura_show/{id}", name="_estructura_show")
     */
    public function showestructuraAction(Request $request, $id)
    {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Estructura')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('No se pudo encontrar la Estructura.');
        }

        return $this->render('BackendBundle:Estructura:show.html.twig', array("entity" => $document));


    }
    
    
    
    
    
    
    
    

}
