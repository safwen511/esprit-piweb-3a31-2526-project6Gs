<?php

namespace App\Controller;

use App\Form\UserSearchType;
use App\Model\UserSearchData;
use App\Service\UserDirectory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class UserDirectoryController extends AbstractController
{
    #[Route('/dashboard/users', name: 'app_user_directory', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function index(Request $request, UserDirectory $userDirectory): Response
    {
        $searchData = new UserSearchData();
        $form = $this->createForm(UserSearchType::class, $searchData);
        $form->handleRequest($request);

        return $this->render('user_directory/index.html.twig', [
            'searchForm' => $form,
            'users' => $userDirectory->search($searchData),
            'hasFilters' => ($searchData->term ?? '') !== '' || $searchData->status !== UserSearchData::STATUS_ALL,
        ]);
    }
}
