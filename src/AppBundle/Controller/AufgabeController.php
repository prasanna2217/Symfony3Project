<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Aufgabe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Aufgabe controller.
 *
 * @Route("/aufgabe")
 */
class AufgabeController extends Controller
{
    /**
     * Lists all aufgabe entities.
     *
     * @Route("/", name="aufgabe_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $aufgabes = $em->getRepository('AppBundle:Aufgabe')->findAll();

        return $this->render('aufgabe/index.html.twig', array(
            'aufgabes' => $aufgabes,
        ));
    }

    /**
     * Creates a new aufgabe entity.
     *
     * @Route("/new", name="aufgabe_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $aufgabe = new Aufgabe();
        $form = $this->createForm('AppBundle\Form\AufgabeType', $aufgabe);
        $form->handleRequest($request);
        //$aufgabe->setname('A');

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($aufgabe);
            $em->flush($aufgabe);

            return $this->redirectToRoute('aufgabe_show', array('id' => $aufgabe->getId()));
        }

        return $this->render('aufgabe/new.html.twig', array(
            'aufgabe' => $aufgabe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a aufgabe entity.
     *
     * @Route("/{id}", name="aufgabe_show")
     * @Method("GET")
     */
    public function showAction(Aufgabe $aufgabe)
    {
        $deleteForm = $this->createDeleteForm($aufgabe);

        return $this->render('aufgabe/show.html.twig', array(
            'aufgabe' => $aufgabe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing aufgabe entity.
     *
     * @Route("/{id}/edit", name="aufgabe_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Aufgabe $aufgabe)
    {
        $deleteForm = $this->createDeleteForm($aufgabe);
        $editForm = $this->createForm('AppBundle\Form\AufgabeType', $aufgabe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('aufgabe_edit', array('id' => $aufgabe->getId()));
        }

        return $this->render('aufgabe/edit.html.twig', array(
            'aufgabe' => $aufgabe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a aufgabe entity.
     *
     * @Route("/{id}", name="aufgabe_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Aufgabe $aufgabe)
    {
        $form = $this->createDeleteForm($aufgabe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($aufgabe);
            $em->flush($aufgabe);
        }

        return $this->redirectToRoute('aufgabe_index');
    }

    /**
     * Creates a form to delete a aufgabe entity.
     *
     * @param Aufgabe $aufgabe The aufgabe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Aufgabe $aufgabe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('aufgabe_delete', array('id' => $aufgabe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
