<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
        $videos = $repo->findVideosLimit(4);

        $repo = $em->getRepository("BackendBundle:Noticia");
        $noticias = $repo->findNoticiasLimit(3);

        $repo = $em->getRepository("BackendBundle:Banner");
        $banners = $repo->findBannersLimit(4);

        $repo = $em->getRepository("BackendBundle:Colaborador");
        $colaboradores = $repo->findColaboradoresLimit((int) 3);

        $repo = $em->getRepository("BackendBundle:Global2016");
        $global2016 = $repo->findAll();


        return $this->render("AppBundle:App:index.html.twig", array("videos"=> $videos, "noticias"=> $noticias, "banners"=> $banners, "colaboradores"=> $colaboradores, "global2016"=> $global2016[0] ));
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

        $colaboradores= $em->getRepository('BackendBundle:Colaborador')->findAll();

        return $this->render("AppBundle:App:queEsGlobal.html.twig", array("entity"=> $page[0], "colaboradores"=>$colaboradores ));
    }

    /**
     * @Route("/global2016", name="global2016")
     */
    public function global2016Action()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:Global2016");
        $page = $repo->findAll();
        $colaboradores= $em->getRepository('BackendBundle:Colaborador')->findAll();
        return $this->render("AppBundle:App:Global2016.html.twig", array("entity"=> $page[0],"colaboradores"=>$colaboradores ));
    }

    /**
     * @Route("/ecosistema-egauss", name="ecosistemaegauss")
     */
    public function ecosistemaEgaussAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:Ecosistema");
        $page = $repo->findAll();
        return $this->render("AppBundle:App:ecosistemaEgauss.html.twig", array("entity"=> $page[0] ));
    }

    /**
     * @Route("/noticiasglobal/{owner}", name="noticiasglobal")
     */
    public function globalImastNoticiasAction(Request $request, $owner)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:Noticia");
        $noticias = $repo->findBy(array("owner"=> $owner));
        $colaboradores= $em->getRepository('BackendBundle:Colaborador')->findAll();
        return $this->render("AppBundle:App:noticiasglobal.html.twig", array("entities"=> $noticias,"colaboradores"=>$colaboradores  ));
    }

    /**
     * @Route("/noticiasglobal/noticia/{slug}", name="noticiaglobal")
     */
    public function globalImastNoticiaAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:Noticia");
        $noticias = $repo->findOneBy(array("slug"=> $slug));
        $colaboradores= $em->getRepository('BackendBundle:Colaborador')->findAll();
        return $this->render("AppBundle:App:noticiaglobal.html.twig", array("entity"=> $noticias, "colaboradores"=>$colaboradores  ));
    }

    /**
     * @Route("/noticias/{owner}", name="noticias")
     */
    public function noticiasAction(Request $request, $owner)
    {

        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM BackendBundle:Noticia a WHERE a.owner='$owner'";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render("AppBundle:App:noticias.html.twig", array('pagination' => $pagination, "owner"=>$owner ));
    }

    /**
     * @Route("/noticias/{owner}/busqueda", name="noticiasfilter")
     * @Method("POST")
     */
    public function noticiasFilterAction(Request $request, $owner)
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM BackendBundle:Noticia a WHERE a.owner='$owner'";
        $empresa=null;
        $cientifico=null;
        $universidad=null;
        $tecnologia=null;
        $ciudad=null;
        $fecha=null;

        $filtros = null;
        if($request->get("empresa") != null){
            $value = $request->get("empresa");
            $filtros.=" a.empresa like '$value%'";
        }
        if($request->get("ciudad") != null){
            $ciudad = $request->get("ciudad");
            if($filtros != null)
            $filtros.=" or a.ciudad like '$ciudad%'";
            else
                $filtros.=" a.ciudad like '$ciudad%'";
        }
        if($request->get("universidad") != null){
            $universidad = $request->get("universidad");
            if($filtros != null)
            $filtros.=" or a.universidad like '$universidad%'";
            else
                $filtros.=" a.universidad like '$universidad%'";
        }
        if($request->get("tecnologia") != null){
            $tecnologia = $request->get("tecnologia");
            if($filtros != null)
            $filtros.=" or a.tecnologia like '$tecnologia%'";
            else
                $filtros.=" a.tecnologia like '$tecnologia%'";
        }
        if($request->get("cientifico") != null){
            $cientifico = $request->get("cientifico");
            if($filtros != null)
            $filtros.=" or a.cientifico like '$cientifico%'";
            else
                $filtros.=" a.cientifico like '$cientifico%'";

        }
        if($request->get("fecha") != null){
            $fecha = $request->get("fecha");
            if($filtros != null)
            $filtros.=" or a.fecha = '$fecha'";
            else
                $filtros.=" a.fecha = '$fecha'";
        }

        if($filtros!= null){
            $dql.= "and ($filtros)";
        }

        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render("AppBundle:App:noticias.html.twig", array('pagination' => $pagination, "owner"=>$owner, "filtroempresa"=> $empresa, "filtrociudad"=>$ciudad, "filtrocientifico"=> $cientifico, "filtrotecnologia"=> $tecnologia, "filtrofecha"=> $fecha, "filtrouniversidad"=> $universidad ));
    }
    /**
     * @Route("/noticia/{slug}", name="noticia")
     */
    public function noticiaAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:Noticia");
        $noticia = $repo->findOneBy(array("slug"=>$slug));

        return $this->render("AppBundle:App:noticia.html.twig", array("entity"=> $noticia, "owner"=>$noticia->getOwner() ));
    }

    /**
     * @Route("/servicios/{owner}", name="servicios")
     */
    public function serviciosAction(Request $request, $owner)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:Servicio");
        $noticias = $repo->findBy(array("owner"=> $owner));

        return $this->render("AppBundle:App:servicios.html.twig", array("entities"=> $noticias, "owner"=>$owner ));
    }

    /**
     * @Route("/servicio/{slug}", name="servicio")
     */
    public function servicioAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:Servicio");
        $noticia = $repo->findOneBy(array("slug"=>$slug));

        return $this->render("AppBundle:App:servicio.html.twig", array("entity"=> $noticia, "owner"=>$noticia->getOwner() ));
    }

    /**
     * @Route("/soluciones/{owner}", name="soluciones")
     */
    public function solucionesAction(Request $request, $owner)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:Solucion");
        $noticias = $repo->findBy(array("owner"=> $owner));

        return $this->render("AppBundle:App:soluciones.html.twig", array("entities"=> $noticias, "owner"=>$owner ));
    }

    /**
     * @Route("/solucion/{slug}", name="solucion")
     */
    public function solucionAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:Solucion");
        $noticia = $repo->findOneBy(array("slug"=>$slug));

        return $this->render("AppBundle:App:solucion.html.twig", array("entity"=> $noticia, "owner"=>$noticia->getOwner() ));
    }

    /**
     * @Route("/estructura/{owner}", name="estructura")
     */
    public function estructuraAction(Request $request, $owner)
    {
        $dm = $this->getDoctrine()->getManager();
        $entity= $dm->getRepository('BackendBundle:Estructura')->findBy(array("owner"=> $owner));
        return $this->render("AppBundle:App:estructura.html.twig", array("entities"=> $entity, "owner"=>$owner ));
    }

    /**
     * @Route("/estructura_detalle/{slug}", name="estructura_detalle")
     */
    public function estructuraDetalleAction(Request $request, $slug)
    {
        $dm = $this->getDoctrine()->getManager();
        $entity= $dm->getRepository('BackendBundle:Estructura')->findOneBy(array("slug"=> $slug));
        return $this->render("AppBundle:App:estructura_detail.html.twig", array("entity"=> $entity, "owner"=>$entity->getOwner()));
    }

    /**
     * @Route("/colaboradores/", name="colaboradores")
     */
    public function colaboradoresAction(Request $request)
    {
        $dm = $this->getDoctrine()->getManager();
        $colaboradores= $dm->getRepository('BackendBundle:Colaborador')->findAll();
        return $this->render("AppBundle:App:colaboradores.html.twig", array(  "colaboradores"=> $colaboradores, "entity"=> $colaboradores[0]));
    }

    /**
     * @Route("/colaborador/{slug}", name="colaborador")
     */
    public function colaboradorAction(Request $request, $slug)
    {
        $dm = $this->getDoctrine()->getManager();
        $entity= $dm->getRepository('BackendBundle:Colaborador')->findOneBy(array("slug"=>$slug));
        $colaboradores= $dm->getRepository('BackendBundle:Colaborador')->findAll();
        return $this->render("AppBundle:App:colaborador.html.twig", array("entity"=> $entity, "colaboradores"=> $colaboradores));
    }

    /**
     * @Route("/colaborador/informacion/{slug}", name="colaboradorinfo")
     */
    public function colaboradorInfoAction(Request $request, $slug)
    {
        $dm = $this->getDoctrine()->getManager();
        $entity= $dm->getRepository('BackendBundle:Colaborador')->findOneBy(array("slug"=>$slug));
        $colaboradores= $dm->getRepository('BackendBundle:Colaborador')->findAll();
        return $this->render("AppBundle:App:colaboradores.html.twig", array("entity"=> $entity, "colaboradores"=> $colaboradores));
    }

    /**
     * @Route("/evento/{owner}", name="evento")
     * @return array
     */
    public function eventoAction($owner)
    {
        $dm = $this->getDoctrine()->getManager();
        $miembros= $dm->getRepository('BackendBundle:Evento')->findBy(array("owner"=> $owner));
        return $this->render('AppBundle:App:eventos.html.twig', array("entities" => $miembros, "owner"=> $owner));
    }

    /**
     * @Route("/videocolaborador/{owner}", name="videocolaborador")
     * @return array
     */
    public function videoColaboradorAction($owner)
    {
        $dm = $this->getDoctrine()->getManager();
        $miembros= $dm->getRepository('BackendBundle:VideoColaborador')->findBy(array("owner"=> $owner));
        return $this->render('AppBundle:App:videoscolaborador.html.twig', array("entities" => $miembros, "owner"=> $owner));
    }


    /**
     * @Route("/edicion-anterior/{anio}", name="edicionanterior")
     * @return array
     */
    public function edicionAnteriorAction($anio)
    {
        $dm = $this->getDoctrine()->getManager();
        $imagenes = null;
        $edicion= $dm->getRepository('BackendBundle:EdicionAnterior')->findOneBy(array("anio"=> $anio));
        $colaboradores= $dm->getRepository('BackendBundle:Colaborador')->findAll();

        if($edicion != null){
        $imagenes= $dm->getRepository('BackendBundle:Imagen')->findBy(array("owner"=> $edicion->generaOwner()));
        return $this->render('AppBundle:App:edicionanterior.html.twig', array("entity" => $edicion, "imagenes"=> $imagenes, "colaboradores"=> $colaboradores, "anio"=> $anio));
        }
        else
            return $this->render('AppBundle:App:edicionanterior.html.twig', array("colaboradores"=> $colaboradores, "anio"=> $anio));
    }


    /**
     * @Route("/listnoticias", name="listnoticias")
     * @return array
     */
    public function listAction(Request $request)
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM BackendBundle:Noticia a";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        // parameters to template
        return $this->render('AppBundle:App:list.html.twig', array('pagination' => $pagination));
    }

    /**
     * @Route("/archivos/{owner}", name="archivos")
     * @return array
     */
    public function archivosAction($owner)
    {
        $dm = $this->getDoctrine()->getManager();
        $miembros= $dm->getRepository('BackendBundle:File')->findBy(array("owner"=> $owner));
        return $this->render('AppBundle:App:archivos.html.twig', array("entities" => $miembros));
    }
}
