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

use AppBundle\Form\TodoType;
use AppBundle\Form\EditTodoType;



class todoController extends Controller{
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

        $todo = new Todo;
        $todo->setDueDate(new\DateTime('now'));
        $form = $this->createForm(TodoType::class, $todo);


        $form -> handleRequest($request);

        if ($form -> isSubmitted() && $form -> isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($todo);
            $em->flush();

            $this -> addFlash('notice', 'Todo Added');

            return $this->redirectToRoute('todo_list');
        }

        return $this->render('todo/create.html.twig', array('form' => $form->createView() ));

    }



    /**
     * @Route("/todo/edit/{todo}", name="todo_edit", requirements={"todo": "\d+"})
     */
    public function editAction(Request $request, Todo $todo){

                      //$todo = $this->getDoctrine()
                          //->getRepository('AppBundle:Todo')
                          //->find($id);
        
        
        $form = $this->createForm(TodoType::class, $todo);


        $form -> handleRequest($request);

        if ($form -> isSubmitted() && $form -> isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($todo);
            $em->flush();

            $this -> addFlash('notice', 'Todo Added');

            return $this->redirectToRoute('todo_list');
            }
             
        return $this->render('todo/edit.html.twig', array('form' => $form->createView(),'todo' => $todo));

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
