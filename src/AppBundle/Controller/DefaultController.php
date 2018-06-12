<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Department;
use AppBundle\Entity\Employee;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="PublicUI")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        /*return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);*/

        $repo = $this->getDoctrine()->getRepository(Employee::class);
        $names = $repo->findAll();

        return $this->render("default/nametable.html.twig", array("names" => $names));
    }

    /**
     * @Route("/admin", name="AdminUI")
     * @Method({"POST", "GET"})
     */
    public function admAction(Request $request) {
        $post = new Employee();
        $form = $this->createForm(PostType::class, $post);
        $form->add("submit", SubmitType::class, array(
           "label" => "Add Employee",
           "attr" => array("class" => "btn btn-success")
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute("PublicUI");
        }

        $dep = new Department();
        $depForm = $this->createForm(DepartmentType::class, $dep);
        $depForm->add("submit", SubmitType::class, array(
            "label" => "Add Department"
        ));

        $depForm->handleRequest($request);
        if ($depForm->isSubmitted() && $depForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dep);
            $em->flush();

            return $this->redirectToRoute("PublicUI");
        }

        return $this->render("default/admin.html.twig", array(
            "form" => $form->createView(),
            "depForm" => $depForm->createView()
            )
        );
    }
}
