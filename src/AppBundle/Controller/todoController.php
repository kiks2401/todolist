<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Todo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Form\CreateTodoType;

class todoController extends Controller
{
    /**
     * @Route("/", name="todo_list")
     */
    public function listAction(){
            $todos = $this->getDoctrine()
                          ->getRepository('AppBundle:Todo')
                          ->findAll();

        return $this->render('todo/index.html.twig', array('todos' => $todos));
    }




    /**
     * @Route("/todo/create", name="todo_create")
     */
    public function createAction(Request $request){

    /**
     * @Route("/todo/edit/{id}", name="todo_edit")
     */
    public function editAction($id, Request $request){

            $form = $this->createForm(CreateTodoType::class, $postfixInstance);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $postfixInstance->createFolderStructure();
            $em = $this->getDoctrine()->getManager();
            $em->persist($postfixInstance);
            $em->flush();
            return $this->redirect($this->generateUrl('postfix_homepage'));
        }
        return $this->render('todo/edit.html.twig', array('form' => $form->createView()));

      }
    }

   




    /**
     * @Route("/todo/details/{id}", name="todo_details")
     */
    public function detailsAction($id){

             $todo = $this->getDoctrine()
                          ->getRepository('AppBundle:Todo')
                          ->find($id);

        return $this->render('todo/details.html.twig', array('todo' => $todo));
    }






 /**
     * @Route("/todo/delete/{id}", name="todo_delete")
     */
    public function deleteAction($id){

              $em = $this->getDoctrine()->getManager();
              $todo = $em->getRepository('AppBundle:Todo')->find($id);

              $em->remove($todo);
              $em->flush();
              
              $this->addFlash('notice', 'Todo Removed');

              return $this->redirectToRoute('todo_list');
    }


}
