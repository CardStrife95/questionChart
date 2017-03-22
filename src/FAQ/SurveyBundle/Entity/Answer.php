<?php

namespace FAQ\SurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Answer
 *
 * @ORM\Table(name="answer")
 * @ORM\Entity(repositoryClass="FAQ\SurveyBundle\Repository\AnswerRepository")
 */
class Answer
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
     * @var bool
     *
     * @ORM\Column(name="isAnswer", type="boolean")
     */
    private $isAnswer;


    /**
     *
     * @ORM\ManyToOne(targetEntity="FAQ\SurveyBundle\Entity\Question")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

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
     * @return Answer
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
     * Set isAnswer
     *
     * @param boolean $isAnswer
     *
     * @return Answer
     */
    public function setIsAnswer($isAnswer)
    {
        $this->isAnswer = $isAnswer;

        return $this;
    }

    /**
     * Get isAnswer
     *
     * @return bool
     */
    public function getIsAnswer()
    {
        return $this->isAnswer;
    }

    /**
     * Set question
     *
     * @param \FAQ\SurveyBundle\Entity\Question $question
     *
     * @return Answer
     */
    public function setQuestion(\FAQ\SurveyBundle\Entity\Question $question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \FAQ\SurveyBundle\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }
}
