<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Document
 *
 * @author dinel
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="document")
 */
class Document 
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=256)
     */
    protected $title;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;
        
    /**
     * @ORM\OneToMany(targetEntity="Sentence", mappedBy="document", cascade={"persist"})
     */
    protected $sentences;
        
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sentences = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Document
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Document
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add sentence
     *
     * @param \AppBundle\Entity\Sentence $sentence
     *
     * @return Document
     */
    public function addSentence(\AppBundle\Entity\Sentence $sentence)
    {
        $this->sentences[] = $sentence;
        $sentence->setDocument($this);

        return $this;
    }

    /**
     * Remove sentence
     *
     * @param \AppBundle\Entity\Sentence $sentence
     */
    public function removeSentence(\AppBundle\Entity\Sentence $sentence)
    {
        $this->sentences->removeElement($sentence);
    }

    /**
     * Get sentences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSentences()
    {
        return $this->sentences;
    }
}
