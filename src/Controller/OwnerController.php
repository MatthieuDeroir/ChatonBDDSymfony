<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Chaton;
use App\Entity\Owner;
use App\Form\OwnerSupprimerType;
use App\Form\ModifierchatonsType;
use App\Form\OwnerType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class   OwnerController extends AbstractController
{
    /**
     * @Route("/owners/", name="voir_owners")
     */
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        $owner = new Owner();

        $form=$this->createForm(OwnerType::class, $owner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($owner);
            $em->flush();

        }
        $repo=$doctrine->getRepository(Owner::class);
        $owner=$repo->findAll();

        return $this->render('owner/index.html.twig', [
            'owner'=>$owner,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/owners/ajouter/", name="ajouter_owner")
     */
    public function ajouterOwner(ManagerRegistry $doctrine, Request $request)
    {
        $owner = new Owner();

        $form = $this->createForm(OwnerType::class, $owner);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($owner);
            $em->flush();

            return $this->redirectToRoute("voir_owners");
        }

        return $this->render("owner/ajouter.html.twig",[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/owners/supprimer/{id}", name="supprimer_owner")
     */
    public function deleteOwner($id, ManagerRegistry $doctrine, Request $request)
    {
        $owner = $doctrine->getRepository(Owner::class)->find($id);

        //si on n'a rien trouvé -> 404
        if (!$owner) {
            throw $this->createNotFoundException("The Owner id : $id doesn't exist");
        }

        $form = $this->createForm(OwnerSupprimerType::class, $owner);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $doctrine->getManager();
            $em->remove($owner);

            $em->flush();
            return $this->redirectToRoute("voir_owners");

        }

        return $this->render("owner/supprimer.html.twig", [
            'owners' => $owner,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route ("/owners/modifier/{id}", name="modifier_owner")
     */

    public function ownerModify($id, ManagerRegistry $doctrine, Request $request) {
        $owner = $doctrine->getRepository(Owner::class)->find($id);

        if (!$owner) {
            throw $this->createNotFoundException("id : $id doesn't match with anything");
        }
        $form=$this->createForm(OwnerType::class, $owner);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em=$doctrine->getManager();
            $em->persist($owner);
            $em->flush();
            return $this->redirectToRoute("voir_owners");

        }
        return $this->render("owner/modifier.html.twig", [
            'owners'=>$owner,
            'form'=>$form->createView()
        ]);
    }

}
