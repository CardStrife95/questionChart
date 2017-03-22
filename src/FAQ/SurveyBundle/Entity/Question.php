<?php

namespace FAQ\SurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="FAQ\SurveyBundle\Repository\QuestionRepository")
 */
class Question
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

     /**
     *
     * @ORM\ManyToOne(targetEntity="FAQ\SurveyBundle\Entity\Survey")
     * @ORM\JoinColumn(nullable=false)
     */
    private $survey;   

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Question
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set survey
     *
     * @param \FAQ\SurveyBundle\Entity\Survey $survey
     *
     * @return Question
     */
    public function setSurvey(\FAQ\SurveyBundle\Entity\Survey $survey)
    {
        $this->survey = $survey;

        return $this;
    }

    /**
     * Get survey
     *
     * @return \FAQ\SurveyBundle\Entity\Survey
     */
    public function getSurvey()
    {
        return $this->survey;
    }
}
