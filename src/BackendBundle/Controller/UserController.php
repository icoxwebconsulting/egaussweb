<?php

namespace BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Prodi\LaborBundle\Entity\User;
use Prodi\LaborBundle\Form\UserType;

/**
 * User controller.
 *
 * @Route("/admin/admin_user")
 */
class UserController extends Controller {

    /**
     * @Route("/grid", name="admin_user_grid")
     * @Template()
     */
    public function gridAction() {
        return $this->_datatable()->execute();
    }

    /**
     * @Route("/", name="admin_user")
     * @Template()
     * @return array
     */
    public function indexAction() {
        $this->_datatable();
        return $this->render('LaborBundle:User:index.html.twig');
    }

    private function _datatable() {
        return $this->get('datatable')
                        ->setEntity("LaborBundle:User", "entity")
                        ->setFields(array('Username' => 'entity.username',
                            'Name' => 'entity.name',
                            'Email' => 'entity.email',
                            'Enabled' => 'entity.enabled',
                            '_identifier_' => 'entity.id'
                        ))
                        //->setOrder("entity.value", "desc")
                        ->setSearch(true)
                        ->setHasAction(true)
                        ->setMultiple(
                                array(
                                    'delete' => array(
                                        'title' => 'Delete',
                                        'route' => 'admin_user_batch_delete'
                                    )
                                )
        );
    }

/**
     * Creates a new Tag document.
     *
     * @Route("/create", name="admin_user_create")
     * @Method("POST")
     */

    public function createAction(Request $request) {
        $document = new User();
        $form = $this->createForm(new UserType(), $document);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();

            return $this->render("::success.html.twig", array("entity" => "User", "action" => "creado"));
        }

        return $this->render("::error.html.twig");
    }

    /**
     * @Route("/new", name="admin_user_new")
     * @Template()
     */
    public function newAction() {
        $document = new User();
        $form = $this->createForm(new UserType(), $document);

        return array(
            'document' => $document,
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/{id}/show", name="admin_user_show")
     * @Template()
     */
    public function showAction($id) {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('LaborBundle:User')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find User document.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $document,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * @Route("/{id}/edit", name="admin_user_edit")
     * @Template()
     */
    public function editAction($id) {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('LaborBundle:User')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find User document.');
        }

        $editForm = $this->createForm(new UserType(), $document);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $document,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * @Route("/{id}/update", name="admin_user_update")
     * @Method("POST")
     */
    public function updateAction(Request $request, $id) {
        $dm = $this->getDoctrine()->getManager();

        $document = $dm->getRepository('LaborBundle:User')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find User document.');
        }

        $editForm = $this->createForm(new UserType(), $document);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $dm->persist($document);
            $dm->flush();

            return $this->render("::success.html.twig", array("entity" => "User", "action" => "editado"));
        }
        return $this->render("::error.html.twig");
    }

    /**
     * @Route("/{id}/delete", name="admin_user_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();

        $document = $em->getRepository('LaborBundle:User')->find($id);
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
    }

/**
     * @Route("/batch_delete", name="admin_user_batch_delete")
     * @Template()
     */

    public function batchAction() {
        $request = $this->getRequest();
        $array_ids = $request->get('dataTables');
        $ids = $array_ids['actions'];
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("LaborBundle:User");

        foreach ($ids as $id) {
            $entity = $repo->find($id);
            if ($entity != null) {
                try {
                    $em->remove($entity);
                } catch (Exception $ex) {
                    //TODO
                }
            }
        }

        try {
            $em->flush();
            return $this->render("::success.html.twig", array("entity" => "User", "action" => "elimanadas"));
        } catch (Exception $exc) {
            return $this->render("::error.html.twig");
        }
    }

}
