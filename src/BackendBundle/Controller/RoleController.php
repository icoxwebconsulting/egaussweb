<?php

namespace BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Prodi\BackendBundle\Entity\Role;
use Prodi\BackendBundle\Form\RoleType;

/**
 * Role controller.
 *
 * @Route("/admin/admin_role")
 */
class RoleController extends Controller
{
    
    /**
     * @Route("/grid", name="admin_role_grid")
     * @Template()
     */
    public function gridAction() {
        return $this->_datatable()->execute();
    }

    /**
     * @Route("/", name="admin_role")
     * @Template()
     * @return array
     */
    public function indexAction() {
        $this->_datatable();
        return $this->render('BackendBundle:Role:index.html.twig');
    }    
    private function _datatable() {
    return $this->get('datatable')
        ->setEntity("BackendBundle:Role", "entity")
        ->setFields(array(                                          'Name' => 'entity.name',
                                          'Description' => 'entity.description',
                         '_identifier_' => 'entity.id'
        ))
        //->setOrder("entity.value", "desc")
        ->setSearch(true)
        ->setHasAction(true)
        ->setMultiple(
                array(
                    'delete' => array(
                        'title' => 'Delete',
                        'route' => 'admin_role_batch_delete'
                )
            )
    );
}    /**
     * Creates a new Tag document.
     *
     * @Route("/create", name="admin_role_create")
     * @Method("POST")
     */
    public function createAction(Request $request) {
        $document = new Role();
        $form = $this->createForm(new RoleType(), $document);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();

            return $this->render("::success.html.twig", array("entity" => "Role", "action" => "creado"));
        }

        return $this->render("::error.html.twig");
    }    
/**
 * @Route("/new", name="admin_role_new")
 * @Template()
 */
public function newAction() {
    $document = new Role();
    $form = $this->createForm(new RoleType(), $document);

    return array(
        'document' => $document,
        'form' => $form->createView()
    );
}
/**
 * @Route("/{id}/show", name="admin_role_show")
 * @Template()
 */
public function showAction($id) {
    $dm =  $this->getDoctrine()->getManager();

    $document = $dm->getRepository('BackendBundle:Role')->find($id);

    if (!$document) {
        throw $this->createNotFoundException('Unable to find Role document.');
    }

    $deleteForm = $this->createDeleteForm($id);

    return array(
        'entity' => $document,
        'delete_form' => $deleteForm->createView(),
    );
}
/**
 * @Route("/{id}/edit", name="admin_role_edit")
 * @Template()
 */
public function editAction($id) {
    $dm =  $this->getDoctrine()->getManager();

    $document = $dm->getRepository('BackendBundle:Role')->find($id);

    if (!$document) {
        throw $this->createNotFoundException('Unable to find Role document.');
    }

    $editForm = $this->createForm(new RoleType(), $document);
    $deleteForm = $this->createDeleteForm($id);

    return array(
        'entity' => $document,
        'edit_form' => $editForm->createView(),
        'delete_form' => $deleteForm->createView(),
    );
}
    /**
     * @Route("/{id}/update", name="admin_role_update")
     * @Method("POST")
     */
    public function updateAction(Request $request, $id) {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('BackendBundle:Role')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Role document.');
        }
        
        $editForm = $this->createForm(new RoleType(), $document);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $dm->persist($document);
            $dm->flush();

            return $this->render("::success.html.twig", array("entity" => "Role", "action" => "editado"));
        }
        return $this->render("::error.html.twig");

    }      
/**
 * @Route("/{id}/delete", name="admin_role_delete")
 * @Method("POST")
 */
public function deleteAction(Request $request, $id) {

    $em = $this->getDoctrine()->getManager();

    $document = $em->getRepository('BackendBundle:Role')->find($id);
    $result = array("success" => false, "message" => "Ocurrio un error al eliminar");

    if ($document) {
        try {
            $em->remove($document);
            $em->flush();
            $result = array("id" => $id, "success" => true, "message" => "Successfully removed");
        } catch (Exception $ex) {
            $result["message"] = $ex->getMessage();
        }
    }

    return new \Symfony\Component\HttpFoundation\Response(json_encode($result));
}

private function createDeleteForm($id) {
    return $this->createFormBuilder(array('id' => $id))
                    ->add('id', 'hidden')
                    ->getForm()
    ;
}        /**
     * @Route("/batch_delete", name="admin_role_batch_delete")
     * @Template()
     */
    public function batchAction() {
        $request = $this->getRequest();
        $array_ids = $request->get('dataTables');
        $ids = $array_ids['actions'];
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("BackendBundle:Role");
        
        foreach ($ids as $id) {
            $entity = $repo->find($id);
            if($entity!=null){
                try{
                    $em->remove($entity);
                } catch (Exception $ex) {
                    //TODO
                }
            }
        }
        
        try {
            $em->flush();
            return $this->render("::success.html.twig", array("entity" => "Role", "action" => "elimanadas"));
        } catch (Exception $exc) {
            return $this->render("::error.html.twig");
        }

    }    }
