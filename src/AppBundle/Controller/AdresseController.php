<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Adresse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Adresse controller.
 *
 * @Route("admin/adresse")
 */
class AdresseController extends Controller
{
    /**
     * Lists all adresse entities.
     *
     * @Route("/", name="admin_adresse_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $adresses = $em->getRepository('AppBundle:Adresse')->findAll();

        return $this->render('adresse/index.html.twig', array(
            'adresses' => $adresses,
        ));
    }

    /**
     * Creates a new adresse entity.
     *
     * @Route("/new", name="admin_adresse_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $adresse = new Adresse();
        $form = $this->createForm('AppBundle\Form\AdresseType', $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($adresse);
            $em->flush();

            return $this->redirectToRoute('admin_adresse_show', array('id' => $adresse->getId()));
        }

        return $this->render('adresse/new.html.twig', array(
            'adresse' => $adresse,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a adresse entity.
     *
     * @Route("/{id}", name="admin_adresse_show")
     * @Method("GET")
     */
    public function showAction(Adresse $adresse)
    {
        $deleteForm = $this->createDeleteForm($adresse);

        return $this->render('adresse/show.html.twig', array(
            'adresse' => $adresse,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing adresse entity.
     *
     * @Route("/{id}/edit", name="admin_adresse_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Adresse $adresse)
    {
        $deleteForm = $this->createDeleteForm($adresse);
        $editForm = $this->createForm('AppBundle\Form\AdresseType', $adresse);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_adresse_edit', array('id' => $adresse->getId()));
        }

        return $this->render('adresse/edit.html.twig', array(
            'adresse' => $adresse,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a adresse entity.
     *
     * @Route("/{id}", name="admin_adresse_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Adresse $adresse)
    {
        $form = $this->createDeleteForm($adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($adresse);
            $em->flush();
        }

        return $this->redirectToRoute('admin_adresse_index');
    }

    /**
     * Creates a form to delete a adresse entity.
     *
     * @param Adresse $adresse The adresse entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Adresse $adresse)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_adresse_delete', array('id' => $adresse->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
