<?php
namespace App\Controller;

use App\Entity\Disponibilite;
use App\Entity\Rendezvous;
use App\Entity\User;
use App\Form\DisponibiliteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/vet')]
class VetController extends AbstractController
{
    #[Route('/disponibilites', name: 'vet_dispos')]
    public function mesDispos(EntityManagerInterface $em): Response
    {
        $vet = $em->getRepository(User::class)->find(10);
        $dispos = $em->getRepository(Disponibilite::class)->findBy(['vet' => $vet]);

        return $this->render('vet/disponibilites.html.twig', [
            'dispos' => $dispos,
            'vet'    => $vet,
        ]);
    }

    #[Route('/disponibilite/new', name: 'vet_dispo_new')]
    public function newDispo(Request $request, EntityManagerInterface $em): Response
    {
        $vet   = $em->getRepository(User::class)->find(10);
        $dispo = new Disponibilite();
        $dispo->setVet($vet);

        $form = $this->createForm(DisponibiliteType::class, $dispo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($dispo);
            $em->flush();
            $this->addFlash('success', 'Disponibilité ajoutée !');
            return $this->redirectToRoute('vet_dispos');
        }

        return $this->render('vet/dispo_form.html.twig', ['form' => $form]);
    }

    #[Route('/disponibilite/{id}/edit', name: 'vet_dispo_edit')]
    public function editDispo(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $dispo = $em->getRepository(Disponibilite::class)->find($id);

        if (!$dispo) {
            $this->addFlash('danger', 'Disponibilité introuvable !');
            return $this->redirectToRoute('vet_dispos');
        }

        $form = $this->createForm(DisponibiliteType::class, $dispo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Disponibilité modifiée !');
            return $this->redirectToRoute('vet_dispos');
        }

        return $this->render('vet/dispo_form.html.twig', ['form' => $form]);
    }

    #[Route('/disponibilite/{id}/delete', name: 'vet_dispo_delete', methods: ['POST'])]
    public function deleteDispo(int $id, EntityManagerInterface $em): Response
    {
        $dispo = $em->getRepository(Disponibilite::class)->find($id);

        if (!$dispo) {
            $this->addFlash('danger', 'Disponibilité introuvable !');
            return $this->redirectToRoute('vet_dispos');
        }

        // Vérifier si des rendez-vous sont liés
        $rdvs = $em->getRepository(Rendezvous::class)->findBy(['disponibilite' => $dispo]);

        if (count($rdvs) > 0) {
            $this->addFlash('danger', 'Impossible de supprimer : des rendez-vous sont liés à cette disponibilité !');
            return $this->redirectToRoute('vet_dispos');
        }

        $em->remove($dispo);
        $em->flush();
        $this->addFlash('success', 'Disponibilité supprimée !');
        return $this->redirectToRoute('vet_dispos');
    }

 #[Route('/rendezvous', name: 'vet_rdv_list')]
public function mesRdv(Request $request, EntityManagerInterface $em): Response
{
    $vet    = $em->getRepository(User::class)->find(10);
    $status = $request->query->get('status', ''); // filtre
    $search = $request->query->get('search', ''); // recherche
    $page   = max(1, $request->query->getInt('page', 1));
    $limit  = 3; // nombre par page

    $qb = $em->createQueryBuilder()
        ->select('r')
        ->from(Rendezvous::class, 'r')
        ->join('r.client', 'c')
        ->join('r.animal', 'a')
        ->where('r.vet = :vet')
        ->setParameter('vet', $vet)
        ->orderBy('r.appointmentDate', 'DESC');

    if ($status) {
        $qb->andWhere('r.status = :status')
           ->setParameter('status', $status);
    }

    if ($search) {
        $qb->andWhere('c.firstName LIKE :search OR c.lastName LIKE :search OR a.name LIKE :search')
           ->setParameter('search', '%' . $search . '%');
    }

    $total = count($qb->getQuery()->getResult());
    $totalPages = ceil($total / $limit);

    $rdvs = $qb->setFirstResult(($page - 1) * $limit)
               ->setMaxResults($limit)
               ->getQuery()
               ->getResult();

    return $this->render('vet/rendezvous.html.twig', [
        'rdvs'       => $rdvs,
        'status'     => $status,
        'search'     => $search,
        'page'       => $page,
        'totalPages' => $totalPages,
        'total'      => $total,
    ]);
}

    #[Route('/rendezvous/{id}/accept', name: 'vet_rdv_accept', methods: ['POST'])]
    public function acceptRdv(int $id, EntityManagerInterface $em): Response
    {
        $rdv = $em->getRepository(Rendezvous::class)->find($id);

        if (!$rdv) {
            $this->addFlash('danger', 'Rendez-vous introuvable !');
            return $this->redirectToRoute('vet_rdv_list');
        }

        if ($rdv->getStatus() === 'cancelled') {
            $this->addFlash('danger', 'Impossible d\'accepter un rendez-vous annulé !');
            return $this->redirectToRoute('vet_rdv_list');
        }

        $rdv->setStatus('confirmed');
        $em->flush();
        $this->addFlash('success', 'Rendez-vous accepté !');
        return $this->redirectToRoute('vet_rdv_list');
    }

    #[Route('/rendezvous/{id}/refuse', name: 'vet_rdv_refuse', methods: ['POST'])]
    public function refuseRdv(int $id, EntityManagerInterface $em): Response
    {
        $rdv = $em->getRepository(Rendezvous::class)->find($id);

        if (!$rdv) {
            $this->addFlash('danger', 'Rendez-vous introuvable !');
            return $this->redirectToRoute('vet_rdv_list');
        }

        if ($rdv->getStatus() === 'confirmed') {
            $this->addFlash('danger', 'Impossible de refuser un rendez-vous déjà confirmé !');
            return $this->redirectToRoute('vet_rdv_list');
        }

        $rdv->setStatus('cancelled');
        $em->flush();
        $this->addFlash('success', 'Rendez-vous refusé.');
        return $this->redirectToRoute('vet_rdv_list');
    }
}