<?php

namespace FAQ\SurveyBundle\Controller;

use FAQ\SurveyBundle\Entity\Answer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Answer controller.
 *
 * @Route("answer")
 */
class AnswerController extends Controller
{
    /**
     * Lists all answer entities.
     *
     * @Route("/", name="answer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $answers = $em->getRepository('FAQSurveyBundle:Answer')->findAll();

        return $this->render('answer/index.html.twig', array(
            'answers' => $answers,
        ));
    }

    /**
     * Creates a new answer entity.
     *
     * @Route("/new", name="answer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $answer = new Answer();
        $form = $this->createForm('FAQ\SurveyBundle\Form\AnswerType', $answer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $id = $request->get('id');

            $em = $this->getDoctrine()->getManager();
            $question = $em->getRepository('FAQSurveyBundle:Question')->findOneById($id);
            $answer->setQuestion($question);
            
            $em->persist($answer);
            $em->flush($answer);

            return $this->redirectToRoute('answer_show', array('id' => $answer->getId()));
        }

        return $this->render('answer/new.html.twig', array(
            'answer' => $answer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a answer entity.
     *
     * @Route("/{id}", name="answer_show")
     * @Method("GET")
     */
    public function showAction(Answer $answer)
    {
        $deleteForm = $this->createDeleteForm($answer);

        return $this->render('answer/show.html.twig', array(
            'answer' => $answer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing answer entity.
     *
     * @Route("/{id}/edit", name="answer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Answer $answer)
    {
        $deleteForm = $this->createDeleteForm($answer);
        $editForm = $this->createForm('FAQ\SurveyBundle\Form\AnswerType', $answer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('answer_edit', array('id' => $answer->getId()));
        }

        return $this->render('answer/edit.html.twig', array(
            'answer' => $answer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a answer entity.
     *
     * @Route("/{id}", name="answer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Answer $answer)
    {
        $form = $this->createDeleteForm($answer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($answer);
            $em->flush($answer);
        }

        return $this->redirectToRoute('answer_index');
    }

    /**
     * Creates a form to delete a answer entity.
     *
     * @param Answer $answer The answer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Answer $answer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('answer_delete', array('id' => $answer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
