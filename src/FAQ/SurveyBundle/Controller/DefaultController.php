<?php

namespace FAQ\SurveyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FAQSurveyBundle:Default:index.html.twig');
    }

}
