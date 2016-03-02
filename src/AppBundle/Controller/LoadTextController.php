<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Entity\Document;
use AppBundle\Entity\Sentence;
use AppBundle\Entity\Token;

/**
 * Description of LoadTextController
 *
 * @author dinel
 */
class LoadTextController extends Controller 
{
    /**
     * 
     * @Route("/import", name="load_text")
     * 
     * @param \AppBundle\Controller\Request $request
     */
    public function loadTextAction(Request $request) {
        $xml_doc = simplexml_load_file("/home/dinel/PycharmProjects/imageAnnotation/out.xml");
        $em = $this->getDoctrine()->getManager();
        $doc = new Document();
        $doc->setTitle("this is a test");
        
        $list_terms = array();
        
        foreach($xml_doc->images->term as $xml_term) {
            $term = new \AppBundle\Entity\Term();
            $term->setTerm($xml_term["string"]->__toString());
            $list_terms[$term->getTerm()] = $term;
            
            foreach($xml_term->image as $xml_image) {
                $image = new \AppBundle\Entity\Image();
                $image->setSrc($xml_image["src"]);
                $term->addImage($image);
            }
            $em->persist($term);            
        }  
        
        foreach($xml_doc->s as $xml_sent) {
            $sent = new Sentence();
            $doc->addSentence($sent);
            foreach($xml_sent->children() as $node) {
                if($node->getName() === "w") {
                    $this->append_word($sent, $node, $list_terms);
                }
                
                if($node->getName() === "coref") {
                    $this->process_coref($sent, $node, $list_terms, $node["set-id"]);
                }
            }
        }
                
        $em->persist($doc);                                      
                
        $em->flush();
        
        return new Response("Done. Created document " . $doc->getId());
        
    }


    private function append_word(Sentence $sent, $xml_word, $list_terms, $coref_sets = "") {
        $token = new Token();
        $token->setContent($xml_word);
        $token->setXmlId($xml_word["ID"]);
        $token->setCorefSets($coref_sets);
        $sent->addToken($token);
        
        if(array_key_exists($xml_word->__toString(), $list_terms) && $list_terms[$xml_word->__toString()]) {
            $token->setTerm($list_terms[$xml_word->__toString()]);
        }
    }
    
    private function process_coref(Sentence $sent, $coref, $list_terms, $coref_sets = "") {
        foreach($coref->children() as $node) {
            if($node->getName() === "w") {
                $this->append_word($sent, $node, $list_terms, $coref_sets);
            }

            if($node->getName() === "coref") {
                $this->process_coref($sent, $node, $list_terms, $coref_sets . " " . $node["set-id"]);
            }
        }
    }
}
