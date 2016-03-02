<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ]);
    }
    
    /**
     * @Route("/document/{id}", name="display_document")
     */
    public function displayDocumentAction(Request $request, $id) {
        $doc = $this->getDoctrine()
                ->getRepository('AppBundle:Document')
                ->find($id);
        
        return $this->render('default/display.html.twig', array(
            'doc' => $doc,
        ));        
    }
    
    /**
     * @Route("/retrieve_images/{id}") {
     */
    public function retrieveImagesAction($id) {
        $token = $this->getDoctrine()
                ->getRepository('AppBundle:Token')
                ->find($id);
        $images = $token->getTerm()->getImages();
        $a_images = array();
        foreach ($images as $image) {
            $a_images[] = $image->getSrc();
        }
        
        return new \Symfony\Component\HttpFoundation\JsonResponse(array(
                'images' => $a_images,
            ));
        
    }
}
