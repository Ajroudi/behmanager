<?php

namespace Manager\CommercialBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Manager\CommercialBundle\Entity\Famille;
use Manager\CommercialBundle\Form\FamilleType;

/**
 * Famille controller.
 *
 */
class FamilleController extends Controller
{

    /**
     * Lists all Famille entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ManagerCommercialBundle:Famille')->findAll();

        return $this->render('ManagerCommercialBundle:Famille:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Famille entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Famille();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
           // $entity->upload(); // puisque j'utilise callBacks
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_famille_show', array('id' => $entity->getId())));
        }

        return $this->render('ManagerCommercialBundle:Famille:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

 
    
    /**
    * Creates a form to create a Famille entity.
    *
    * @param Famille $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Famille $entity)
    {
        $form = $this->createForm(new FamilleType(), $entity, array(
            'action' => $this->generateUrl('admin_famille_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Famille entity.
     *
     */
    public function newAction()
    {
        $entity = new Famille();
        $form   = $this->createCreateForm($entity);

        return $this->render('ManagerCommercialBundle:Famille:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Famille entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ManagerCommercialBundle:Famille')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Famille entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ManagerCommercialBundle:Famille:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Famille entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ManagerCommercialBundle:Famille')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Famille entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ManagerCommercialBundle:Famille:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Famille entity.
    *
    * @param Famille $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Famille $entity)
    {
        $form = $this->createForm(new FamilleType(), $entity, array(
            'action' => $this->generateUrl('admin_famille_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Famille entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ManagerCommercialBundle:Famille')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Famille entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_famille_edit', array('id' => $id)));
        }

        return $this->render('ManagerCommercialBundle:Famille:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Famille entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ManagerCommercialBundle:Famille')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Famille entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_famille'));
    }

    /**
     * Creates a form to delete a Famille entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_famille_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
