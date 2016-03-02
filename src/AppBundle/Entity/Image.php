<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Image
 *
 * @author dinel
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="image")
 */
class Image {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
        
    /**
     * @ORM\Column(type="text")
     */
    protected $src;
    
    /**
     * @ORM\ManyToOne(targetEntity="Term", inversedBy="images", cascade={"persist"})
     * @ORM\JoinColumn(name="term_id", referencedColumnName="id")
     */
    protected $term;

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
     * Set src
     *
     * @param string $src
     *
     * @return Image
     */
    public function setSrc($src)
    {
        $this->src = $src;

        return $this;
    }

    /**
     * Get src
     *
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * Set term
     *
     * @param \AppBundle\Entity\Term $term
     *
     * @return Image
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
}
