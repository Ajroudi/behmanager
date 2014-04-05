<?php

namespace Manager\CommercialBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Manager\CommercialBundle\Entity\Ressource;
use Manager\CommercialBundle\Form\RessourceType;

/**
 * Ressource controller.
 *
 */
class RessourceController extends Controller
{

    /**
     * Lists all Ressource entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ManagerCommercialBundle:Ressource')->findAll();

        return $this->render('ManagerCommercialBundle:Ressource:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Ressource entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Ressource();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_ressource_show', array('id' => $entity->getId())));
        }

        return $this->render('ManagerCommercialBundle:Ressource:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Ressource entity.
    *
    * @param Ressource $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Ressource $entity)
    {
        $form = $this->createForm(new RessourceType(), $entity, array(
            'action' => $this->generateUrl('admin_ressource_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter une Ressource','attr' => array('class' => 'btn btn-primary btn-block')));

        return $form;
    }

    /**
     * Displays a form to create a new Ressource entity.
     *
     */
    public function newAction()
    {
        $entity = new Ressource();
        $form   = $this->createCreateForm($entity);

        return $this->render('ManagerCommercialBundle:Ressource:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Ressource entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ManagerCommercialBundle:Ressource')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ressource entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ManagerCommercialBundle:Ressource:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Ressource entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ManagerCommercialBundle:Ressource')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ressource entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ManagerCommercialBundle:Ressource:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Ressource entity.
    *
    * @param Ressource $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Ressource $entity)
    {
        $form = $this->createForm(new RessourceType(), $entity, array(
            'action' => $this->generateUrl('admin_ressource_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Editer la ressource','attr' => array('class' => 'btn btn-primary btn-block')));

        return $form;
    }
    /**
     * Edits an existing Ressource entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ManagerCommercialBundle:Ressource')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ressource entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_ressource_edit', array('id' => $id)));
        }

        return $this->render('ManagerCommercialBundle:Ressource:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Ressource entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ManagerCommercialBundle:Ressource')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Ressource entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_ressource'));
    }

    /**
     * Creates a form to delete a Ressource entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_ressource_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Editer Range','attr' => array('class' => 'btn btn-danger btn-block')))
            ->getForm()
        ;
    }
}
