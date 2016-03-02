<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Sentence
 *
 * @author dinel
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="sentence")
 */
class Sentence 
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Token", mappedBy="sentence", cascade={"persist"})
     */
    protected $tokens;
    
    /**
     * @ORM\ManyToOne(targetEntity="Document", inversedBy="sentences", cascade={"persist"})
     * @ORM\JoinColumn(name="doc_id", referencedColumnName="id")
     */
    protected $document;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $complexity;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tokens = new \Doctrine\Common\Collections\ArrayCollection();
        $this->complexity = rand(0,3);
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
     * Add token
     *
     * @param \AppBundle\Entity\Token $token
     *
     * @return Sentence
     */
    public function addToken(\AppBundle\Entity\Token $token)
    {
        $this->tokens[] = $token;
        $token->setSentence($this);

        return $this;
    }

    /**
     * Remove token
     *
     * @param \AppBundle\Entity\Token $token
     */
    public function removeToken(\AppBundle\Entity\Token $token)
    {
        $this->tokens->removeElement($token);
    }

    /**
     * Get tokens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTokens()
    {
        return $this->tokens;
    }

    /**
     * Set document
     *
     * @param \AppBundle\Entity\Document $document
     *
     * @return Sentence
     */
    public function setDocument(\AppBundle\Entity\Document $document = null)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get document
     *
     * @return \AppBundle\Entity\Document
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set complexity
     *
     * @param integer $complexity
     *
     * @return Sentence
     */
    public function setComplexity($complexity)
    {
        $this->complexity = $complexity;

        return $this;
    }

    /**
     * Get complexity
     *
     * @return integer
     */
    public function getComplexity()
    {
        return $this->complexity;
    }
}
