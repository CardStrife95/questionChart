<?php

namespace FAQ\SurveyBundle\Entity;

/**
 * Answer
 */
class Answer
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $content;

    /**
     * @var bool
     */
    private $isAnswer;


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
}

