<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;

class ReportingController extends Controller
{
    /**
     * @Route("/courses")
     */
    public function coursesAction( Request $request)
    {
        //$chauffeurSearch = $request->query->get('chauffeurSearch');

        $form = $this->createFormBuilder()
        ->add('chauffeurSearch', SearchType::class)
        ->add('submit', SubmitType::class, array('label' => 'Rechercher'))
        ->getForm();

        $form->handleRequest($request);

        
        $chauffeurSearch = "";
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $chauffeurSearch = $data['chauffeurSearch'];
        } 
           
        $em = $this->getDoctrine()->getManager();
        $courses = $em->getRepository('AppBundle:Course')->findByChauffeur($chauffeurSearch);

        return $this->render('AppBundle:Reporting:courses.html.twig', array(
            'chauffeurSearch' => $chauffeurSearch,
            'courses' => $courses,
            'form' => $form->createView(),
        ));
    }

}
