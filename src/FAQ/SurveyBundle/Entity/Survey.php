<?php

namespace FAQ\SurveyBundle\Entity;

/**
 * Survey
 */
class Survey
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $thema;


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
     * Set name
     *
     * @param string $name
     *
     * @return Survey
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set thema
     *
     * @param string $thema
     *
     * @return Survey
     */
    public function setThema($thema)
    {
        $this->thema = $thema;

        return $this;
    }

    /**
     * Get thema
     *
     * @return string
     */
    public function getThema()
    {
        return $this->thema;
    }
}

