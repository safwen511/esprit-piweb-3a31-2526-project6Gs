<?php
namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    public function __construct(
        private RequestStack $requestStack,
        private EntityManagerInterface $em
    ) {}

    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_dashboard');
        }

        return $this->render('security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error'         => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    #[Route('/dashboard', name: 'app_dashboard')]
    public function dashboard(): Response
    {
        $user = $this->getUser();

        if (!$user || !method_exists($user, 'getRole')) {
            return $this->redirectToRoute('app_login');
        }

        if ($user->getRole() === 'VETERINAIRE') {
            $session = $this->requestStack->getSession();

            if (!$session->get('signature_ok')) {
                return $this->redirectToRoute('vet_signature');
            }

            return $this->redirectToRoute('vet_dashboard');
        }

        if ($user->getRole() === 'CLIENT') {
            return $this->redirectToRoute('client_vet_list');
        }

        return $this->redirectToRoute('app_login');
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void {}

    #[Route('/vet/signature', name: 'vet_signature')]
    public function signature(): Response
    {
        return $this->render('security/signature.html.twig');
    }

    #[Route('/verify-signature', name: 'verify_signature', methods: ['POST'])]
    public function verifySignature(Request $request): JsonResponse
    {
        $points = json_decode($request->getContent(), true);
        $user   = $this->getUser();
        $session = $this->requestStack->getSession();

        if (!$points || count($points) < 50) {
            return new JsonResponse(['message' => 'Signature invalide'], 401);
        }

        // Aucune signature enregistrée → on enregistre
        if (!$user->getSignature()) {
            $user->setSignature(json_encode($points));
            $this->em->flush();

            $session->set('signature_ok', true);

            return new JsonResponse([
                'message'  => 'Signature enregistrée',
                'redirect' => '/dashboard'
            ]);
        }

        // Signature existante → comparer
        $saved = json_decode($user->getSignature(), true);

        if ($this->compareSignatures($saved, $points)) {
            $session->set('signature_ok', true);

            return new JsonResponse([
                'message'  => 'Signature reconnue',
                'redirect' => '/dashboard'
            ]);
        }

        return new JsonResponse(['message' => 'Signature incorrecte'], 401);
    }

    private function compareSignatures(array $saved, array $input): bool
    {
        // Exemple simple : comparer le nombre de points (à affiner selon ta logique)
        $diff = abs(count($saved) - count($input));
        return $diff < 20; // tolérance de 20 points
    }
}