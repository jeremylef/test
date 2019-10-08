<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Identity;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\IdentityType;




class IdentityController extends AbstractController
{
    /**
     * @Route("/identity", name="identity")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Identity::class);
        $identities = $repo->findAll();

        return $this->render('identity/index.html.twig', [
            'controller_name' => 'IdentityController',
            'identities'=> $identities,
        ]);
    }
      /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('identity/home.html.twig');
    }
     
     /**
    * @Route("/new", name="create")
    
    */
   public function createPeople(Request $request,ObjectManager $manager)
   {
      
        $identity= new Identity();
       

    $form= $this->createForm(IdentityType ::class, $identity);
       
                    $form->handleRequest($request);

                    dump($identity);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($identity);
            $manager->flush();
           
            return $this->redirectToRoute('identity',['id'=> $identity->getId
            ()]);
        }

       return $this-> render('identity/create.html.twig', [
           'formIdentity'=> $form->createView()
       ]);
   }
    /**
     * @Route("/show", name="show")
     */
    public function show ()
    {
        $repo= $this->getDoctrine()->getRepository(Identity::class);
       
        $identity = $repo-> findAll();

        return $this->render('identity/show.html.twig', [
            'identity'=> $identity
         
        ]);
    }
    
}
