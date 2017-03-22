<?php

namespace UIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use FAQ\SurveyBundle\Entity\Survey;
use FAQ\SurveyBundle\Entity\Answer;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UIBundle:Default:index.html.twig');
    }

    public function questionnaireAction()
    {
        $em = $this->getDoctrine()->getManager();
        $surveys = $em->getRepository('FAQSurveyBundle:Survey')->findAll();    
        return $this->render('UIBundle:Default:questionnaire.html.twig',array("surveys"=>$surveys));
    }

    public function doSurveyAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $survey = $em->getRepository('FAQSurveyBundle:Survey')->findOneById(array('id'=>$id));
        $questions = $em->getRepository('FAQSurveyBundle:Question')->findBySurvey($survey);

        $answers = $em->getRepository('FAQSurveyBundle:Answer')->findAll($questions);

        return $this->render('UIBundle:Default:doSurvey.html.twig',
            array("id"=>$id,
                  "survey"=>$survey,
                  "questions"=>$questions,
                  "answers"=>$answers,
        ));    
    }
}
