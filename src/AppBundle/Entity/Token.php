<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Token
 *
 * @author dinel
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="token")
 */
class Token 
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * Field that is used to match to the original ID in the XML doc
     * 
     * @ORM\Column(type="integer")     
     */
    protected $xml_id;
    
    /**
     * @ORM\Column(type="string", length=256)
     */
    protected $content;
            
    /**
     * @ORM\ManyToOne(targetEntity="Sentence", inversedBy="tokens", cascade={"persist"})
     * @ORM\JoinColumn(name="sentence_id", referencedColumnName="id")
     */
    protected $sentence;
    
    /**
     * @ORM\ManyToOne(targetEntity="Term")
     * @ORM\JoinColumn(name="term_id", referencedColumnName="id")
     */
    protected $term;
    
    /**
     * @ORM\ManyToOne(targetEntity="Image")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    protected $selected_image;    
    
    /**
     * @ORM\Column(type="string", length=256)
     */
    protected $coref_sets;

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
     * Set content
     *
     * @param string $content
     *
     * @return Token
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
     * Set sentence
     *
     * @param \AppBundle\Entity\Sentence $sentence
     *
     * @return Token
     */
    public function setSentence(\AppBundle\Entity\Sentence $sentence = null)
    {
        $this->sentence = $sentence;

        return $this;
    }

    /**
     * Get sentence
     *
     * @return \AppBundle\Entity\Sentence
     */
    public function getSentence()
    {
        return $this->sentence;
    }

    /**
     * Set xmlId
     *
     * @param integer $xmlId
     *
     * @return Token
     */
    public function setXmlId($xmlId)
    {
        $this->xml_id = $xmlId;

        return $this;
    }

    /**
     * Get xmlId
     *
     * @return integer
     */
    public function getXmlId()
    {
        return $this->xml_id;
    }

    /**
     * Set corefSets
     *
     * @param string $corefSets
     *
     * @return Token
     */
    public function setCorefSets($corefSets)
    {
        $this->coref_sets = $corefSets;

        return $this;
    }

    /**
     * Get corefSets
     *
     * @return string
     */
    public function getCorefSets()
    {
        return $this->coref_sets;
    }

    /**
     * Set term
     *
     * @param \AppBundle\Entity\Term $term
     *
     * @return Token
     */
    public function setTerm(\AppBundle\Entity\Term $term = null)
    {
        $this->term = $term;

        return $this;
    }

    /**
     * Get term
     *
     * @return \AppBundle\Entity\Term
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * Set selectedImage
     *
     * @param \AppBundle\Entity\Image $selectedImage
     *
     * @return Token
     */
    public function setSelectedImage(\AppBundle\Entity\Image $selectedImage = null)
    {
        $this->selected_image = $selectedImage;

        return $this;
    }

    /**
     * Get selectedImage
     *
     * @return \AppBundle\Entity\Image
     */
    public function getSelectedImage()
    {
        return $this->selected_image;
    }
}
