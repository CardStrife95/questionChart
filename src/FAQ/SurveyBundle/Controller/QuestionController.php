<?php

namespace FAQ\SurveyBundle\Controller;

use FAQ\SurveyBundle\Entity\Question;
use FAQ\SurveyBundle\Entity\Survey;
use FAQ\SurveyBundle\Entity\Answer;
use FAQ\SurveyBundle\Form\AnswerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Question controller.
 *
 * @Route("question")
 */
class QuestionController extends Controller
{
    /**
     * Lists all question entities.
     *
     * @Route("/", name="question_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $questions = $em->getRepository('FAQSurveyBundle:Question')->findAll();
        $answers = $em->getRepository('FAQSurveyBundle:Answer')->findAll();  
        return $this->render('question/index.html.twig', array(
            'questions' => $questions,
            'answers' => $answers,
        ));
    }

    /**
     * Creates a new question entity.
     *
     * @Route("/new", name="question_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $question = new Question();
        $answer = new Answer();

        $form = $this->createForm('FAQ\SurveyBundle\Form\QuestionType', $question);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $id = $request->get('id');
            
            $em = $this->getDoctrine()->getManager();
            $survey = $em->getRepository('FAQSurveyBundle:Survey')->find($id);
            if(!$survey)
            {
                throw $this->createNotFoundException("No Id Found :".$id);
            }

            $question->setSurvey($survey);
            
            $em->persist($question);
            $em->flush($question);

            return $this->redirectToRoute('question_show', array('id' => $question->getId()));
        }

        return $this->render('question/new.html.twig', array(
            'question' => $question,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a question entity.
     *
     * @Route("/{id}", name="question_show")
     * @Method("GET")
     */
    public function showAction(Question $question)
    {
        $deleteForm = $this->createDeleteForm($question);
        $em = $this->getDoctrine()->getManager();

        $answers = $em->getRepository('FAQSurveyBundle:Answer')->findAll($question);
        return $this->render('question/show.html.twig', array(
            'question' => $question,
            'answers' => $answers,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing question entity.
     *
     * @Route("/{id}/edit", name="question_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Question $question)
    {
        $deleteForm = $this->createDeleteForm($question);
        $editForm = $this->createForm('FAQ\SurveyBundle\Form\QuestionType', $question);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('question_edit', array('id' => $question->getId()));
        }

        return $this->render('question/edit.html.twig', array(
            'question' => $question,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a question entity.
     *
     * @Route("/{id}", name="question_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Question $question)
    {
        $form = $this->createDeleteForm($question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($question);
            $em->flush($question);
        }

        return $this->redirectToRoute('question_index');
    }

    /**
     * Creates a form to delete a question entity.
     *
     * @param Question $question The question entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Question $question)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('question_delete', array('id' => $question->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
