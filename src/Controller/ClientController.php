<?php
// src/Controller/ClientController.php
namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Disponibilite;
use App\Entity\Rendezvous;
use App\Entity\User;
use App\Form\RendezvousType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/client')]
class ClientController extends AbstractController
{
    // Liste des vétérinaires disponibles
    #[Route('/veterinaires', name: 'client_vet_list')]
    public function listVets(EntityManagerInterface $em): Response
    {
        $vets = $em->getRepository(User::class)
            ->findBy(['role' => 'VETERINAIRE']);

        return $this->render('client/veterinaires.html.twig', ['vets' => $vets]);
    }

    // Voir les dispos d'un vétérinaire et prendre RDV
    #[Route('/veterinaire/{id}/rdv', name: 'client_prendre_rdv')]
    public function prendreRdv(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $vet    = $em->getRepository(User::class)->find($id);
        $client = $em->getRepository(User::class)->find(8); // client connecté

        $dispos = $em->getRepository(Disponibilite::class)
            ->findBy(['vet' => $vet, 'isAvailable' => true]);

        $rdv  = new Rendezvous();
        $rdv->setVet($vet);
        $rdv->setClient($client);
        $rdv->setStatus('pending');

        $form = $this->createForm(RendezvousType::class, $rdv, [
            'vet'    => $vet,
            'client' => $client,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($rdv);
            $em->flush();
            $this->addFlash('success', 'Rendez-vous demandé !');
            return $this->redirectToRoute('client_mes_rdv');
        }

        return $this->render('client/prendre_rdv.html.twig', [
            'form'   => $form,
            'vet'    => $vet,
            'dispos' => $dispos,
        ]);
    }

    // Mes rendez-vous
    #[Route('/mes-rendezvous', name: 'client_mes_rdv')]
    public function mesRdv(EntityManagerInterface $em): Response
    {
        $client = $em->getRepository(User::class)->find(8);
        $rdvs   = $em->getRepository(Rendezvous::class)->findBy(['client' => $client]);

        return $this->render('client/mes_rendezvous.html.twig', ['rdvs' => $rdvs]);
    }

    // Annuler un RDV
    #[Route('/rendezvous/{id}/annuler', name: 'client_rdv_annuler', methods: ['POST'])]
    public function annulerRdv(int $id, EntityManagerInterface $em): Response
    {
        $rdv = $em->getRepository(Rendezvous::class)->find($id);
        $rdv->setStatus('cancelled');
        $em->flush();
        $this->addFlash('info', 'Rendez-vous annulé.');
        return $this->redirectToRoute('client_mes_rdv');
    }
}