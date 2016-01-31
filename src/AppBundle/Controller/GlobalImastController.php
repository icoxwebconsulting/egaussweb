<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/global-imast")
 */
class GlobalImastController extends Controller
{


    /**
     * @Route("/", name="global-imast")
     */
    public function indexGlobalImasTAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:Video");
        $videos = $repo->findVideosGlobalLimit(4);

        $repo = $em->getRepository("BackendBundle:Noticia");
        //$noticias = $repo->findBy(array(),array(),0,10);
        $noticias = $repo->findNoticiasGlobalLimit(4);

        $repo = $em->getRepository("BackendBundle:Banner");
        //$noticias = $repo->findBy(array(),array(),0,10);
        $banners = $repo->findBannersLimitGlobal(4);

        $repo = $em->getRepository("BackendBundle:Colaborador");
        //$noticias = $repo->findBy(array(),array(),0,10);
        $colaboradores = $repo->findColaboradoresLimit(4);

        $repo = $em->getRepository("BackendBundle:Global2016");
        $global2016 = $repo->findAll();


        return $this->render("AppBundle:Global:index.html.twig", array("videos"=> $videos, "noticias"=> $noticias, "banners"=> $banners, "colaboradores"=> $colaboradores , "global2016"=> $global2016[0] ));
    }



    /**
     * @Route("/que_es_global", name="globalimast_que_es_global")
     */
    public function queEsGlobalAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:QueEsGlobal");
        $page = $repo->findAll();

        $colaboradores= $em->getRepository('BackendBundle:Colaborador')->findAll();

        return $this->render("AppBundle:Global:queEsGlobal.html.twig", array("entity"=> $page[0], "colaboradores"=>$colaboradores ));
    }

    /**
     * @Route("/global2016", name="globalimast_global2016")
     */
    public function global2016Action()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:Global2016");
        $page = $repo->findAll();
        $colaboradores= $em->getRepository('BackendBundle:Colaborador')->findAll();
        return $this->render("AppBundle:Global:Global2016.html.twig", array("entity"=> $page[0],"colaboradores"=>$colaboradores ));
    }



    /**
     * @Route("/noticiasglobal/{owner}", name="globalimast_noticiasglobal")
     */
    public function globalImastNoticiasAction(Request $request, $owner)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:Noticia");
        $noticias = $repo->findBy(array("owner"=> $owner));
        $colaboradores= $em->getRepository('BackendBundle:Colaborador')->findAll();
        return $this->render("AppBundle:Global:noticiasglobal.html.twig", array("entities"=> $noticias,"colaboradores"=>$colaboradores  ));
    }

    /**
     * @Route("/noticiasglobal/noticia/{slug}", name="globalimast_noticiaglobal")
     */
    public function globalImastNoticiaAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:Noticia");
        $noticias = $repo->findOneBy(array("slug"=> $slug));
        $colaboradores= $em->getRepository('BackendBundle:Colaborador')->findAll();
        return $this->render("AppBundle:Global:noticiaglobal.html.twig", array("entity"=> $noticias, "colaboradores"=>$colaboradores  ));
    }


    /**
     * @Route("/colaboradores/", name="globalimast_colaboradores")
     */
    public function colaboradoresAction(Request $request)
    {
        $dm = $this->getDoctrine()->getManager();
        $colaboradores= $dm->getRepository('BackendBundle:Colaborador')->findAll();
        return $this->render("AppBundle:Global:colaboradores.html.twig", array(  "colaboradores"=> $colaboradores, "entity"=> $colaboradores[0]));
    }

    /**
     * @Route("/colaborador/{slug}", name="globalimast_colaborador")
     */
    public function colaboradorAction(Request $request, $slug)
    {
        $dm = $this->getDoctrine()->getManager();
        $entity= $dm->getRepository('BackendBundle:Colaborador')->findOneBy(array("slug"=>$slug));
        $colaboradores= $dm->getRepository('BackendBundle:Colaborador')->findAll();
        return $this->render("AppBundle:Global:colaborador.html.twig", array("entity"=> $entity, "colaboradores"=> $colaboradores));
    }

    /**
     * @Route("/colaborador/informacion/{slug}", name="globalimast_colaboradorinfo")
     */
    public function colaboradorInfoAction(Request $request, $slug)
    {
        $dm = $this->getDoctrine()->getManager();
        $entity= $dm->getRepository('BackendBundle:Colaborador')->findOneBy(array("slug"=>$slug));
        $colaboradores= $dm->getRepository('BackendBundle:Colaborador')->findAll();
        return $this->render("AppBundle:Global:colaboradores.html.twig", array("entity"=> $entity, "colaboradores"=> $colaboradores));
    }

    /**
     * @Route("/evento/{owner}", name="globalimast_evento")
     * @return array
     */
    public function eventoAction($owner)
    {
        $dm = $this->getDoctrine()->getManager();
        $miembros= $dm->getRepository('BackendBundle:Evento')->findBy(array("owner"=> $owner));
        return $this->render('AppBundle:Global:eventos.html.twig', array("entities" => $miembros, "owner"=> $owner));
    }

    /**
     * @Route("/videocolaborador/{owner}", name="globalimast_videocolaborador")
     * @return array
     */
    public function videoColaboradorAction($owner)
    {
        $dm = $this->getDoctrine()->getManager();
        $miembros= $dm->getRepository('BackendBundle:VideoColaborador')->findBy(array("owner"=> $owner));
        return $this->render('AppBundle:Global:videoscolaborador.html.twig', array("entities" => $miembros, "owner"=> $owner));
    }

    /**
     * @Route("/edicion-anterior/{anio}", name="globalimast_edicionanterior")
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
            return $this->render('AppBundle:Global:edicionanterior.html.twig', array("entity" => $edicion, "imagenes"=> $imagenes, "colaboradores"=> $colaboradores, "anio"=> $anio));
        }
        else
            return $this->render('AppBundle:Global:edicionanterior.html.twig', array("colaboradores"=> $colaboradores, "anio"=> $anio));
    }



}
