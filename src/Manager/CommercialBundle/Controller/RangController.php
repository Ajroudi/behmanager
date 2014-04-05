<?php

namespace Manager\CommercialBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Manager\CommercialBundle\Entity\Rang;
use Manager\CommercialBundle\Form\RangType;

/**
 * Rang controller.
 *
 */
class RangController extends Controller
{

    /**
     * Lists all Rang entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ManagerCommercialBundle:Rang')->findAll();

        return $this->render('ManagerCommercialBundle:Rang:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Rang entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Rang();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_range_show', array('id' => $entity->getId())));
        }

        return $this->render('ManagerCommercialBundle:Rang:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Rang entity.
    *
    * @param Rang $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Rang $entity)
    {
        $form = $this->createForm(new RangType(), $entity, array(
            'action' => $this->generateUrl('admin_range_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter Range','attr' => array('class' => 'btn btn-primary btn-block')));

        return $form;
    }

    /**
     * Displays a form to create a new Rang entity.
     *
     */
    public function newAction()
    {
        $entity = new Rang();
        $form   = $this->createCreateForm($entity);

        return $this->render('ManagerCommercialBundle:Rang:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Rang entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ManagerCommercialBundle:Rang')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rang entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ManagerCommercialBundle:Rang:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Rang entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ManagerCommercialBundle:Rang')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rang entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ManagerCommercialBundle:Rang:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Rang entity.
    *
    * @param Rang $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Rang $entity)
    {
        $form = $this->createForm(new RangType(), $entity, array(
            'action' => $this->generateUrl('admin_range_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Editer Range','attr' => array('class' => 'btn btn-primary btn-block')));

        return $form;
    }
    /**
     * Edits an existing Rang entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ManagerCommercialBundle:Rang')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rang entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_range_edit', array('id' => $id)));
        }

        return $this->render('ManagerCommercialBundle:Rang:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Rang entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ManagerCommercialBundle:Rang')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Rang entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_range'));
    }

    /**
     * Creates a form to delete a Rang entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_range_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer Range','attr' => array('class' => 'btn btn-danger btn-block')))
            ->getForm()
        ;
    }
}
