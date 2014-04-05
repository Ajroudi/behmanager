<?php

namespace Manager\CommercialBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Manager\CommercialBundle\Entity\Spec;
use Manager\CommercialBundle\Form\SpecType;

/**
 * Spec controller.
 *
 */
class SpecController extends Controller
{

    /**
     * Lists all Spec entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ManagerCommercialBundle:Spec')->findAll();

        return $this->render('ManagerCommercialBundle:Spec:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Spec entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Spec();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_spec_show', array('id' => $entity->getId())));
        }

        return $this->render('ManagerCommercialBundle:Spec:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Spec entity.
    *
    * @param Spec $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Spec $entity)
    {
        $form = $this->createForm(new SpecType(), $entity, array(
            'action' => $this->generateUrl('admin_spec_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter une spécification','attr' => array('class' => 'btn btn-primary btn-block')));

        return $form;
    }

    /**
     * Displays a form to create a new Spec entity.
     *
     */
    public function newAction()
    {
        $entity = new Spec();
        $form   = $this->createCreateForm($entity);

        return $this->render('ManagerCommercialBundle:Spec:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Spec entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ManagerCommercialBundle:Spec')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Spec entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ManagerCommercialBundle:Spec:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Spec entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ManagerCommercialBundle:Spec')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Spec entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ManagerCommercialBundle:Spec:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Spec entity.
    *
    * @param Spec $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Spec $entity)
    {
        $form = $this->createForm(new SpecType(), $entity, array(
            'action' => $this->generateUrl('admin_spec_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Editer la spec','attr' => array('class' => 'btn btn-primary btn-block')));

        return $form;
    }
    /**
     * Edits an existing Spec entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ManagerCommercialBundle:Spec')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Spec entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_spec_edit', array('id' => $id)));
        }

        return $this->render('ManagerCommercialBundle:Spec:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Spec entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ManagerCommercialBundle:Spec')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Spec entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_spec'));
    }

    /**
     * Creates a form to delete a Spec entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_spec_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer la spec','attr' => array('class' => 'btn btn-danger btn-block')))
            ->getForm()
        ;
    }
}
