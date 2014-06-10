<?php

namespace Devophp\Bundle\DockerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Devophp\Bundle\DockerBundle\Entity\DockerHost;
use Devophp\Bundle\DockerBundle\Form\DockerHostType;

/**
 * DockerHost controller.
 *
 * @Route("/dockerhostadmin")
 */
class DockerHostController extends Controller
{

    /**
     * Lists all DockerHost entities.
     *
     * @Route("/", name="dockerhostadmin")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DevophpDockerBundle:DockerHost')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new DockerHost entity.
     *
     * @Route("/", name="dockerhostadmin_create")
     * @Method("POST")
     * @Template("DevophpDockerBundle:DockerHost:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new DockerHost();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('dockerhostadmin_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a DockerHost entity.
    *
    * @param DockerHost $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(DockerHost $entity)
    {
        $form = $this->createForm(new DockerHostType(), $entity, array(
            'action' => $this->generateUrl('dockerhostadmin_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new DockerHost entity.
     *
     * @Route("/new", name="dockerhostadmin_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new DockerHost();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a DockerHost entity.
     *
     * @Route("/{id}", name="dockerhostadmin_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DevophpDockerBundle:DockerHost')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DockerHost entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing DockerHost entity.
     *
     * @Route("/{id}/edit", name="dockerhostadmin_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DevophpDockerBundle:DockerHost')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DockerHost entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a DockerHost entity.
    *
    * @param DockerHost $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(DockerHost $entity)
    {
        $form = $this->createForm(new DockerHostType(), $entity, array(
            'action' => $this->generateUrl('dockerhostadmin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing DockerHost entity.
     *
     * @Route("/{id}", name="dockerhostadmin_update")
     * @Method("PUT")
     * @Template("DevophpDockerBundle:DockerHost:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DevophpDockerBundle:DockerHost')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DockerHost entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('dockerhostadmin_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a DockerHost entity.
     *
     * @Route("/{id}", name="dockerhostadmin_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DevophpDockerBundle:DockerHost')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find DockerHost entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('dockerhostadmin'));
    }

    /**
     * Creates a form to delete a DockerHost entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dockerhostadmin_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
