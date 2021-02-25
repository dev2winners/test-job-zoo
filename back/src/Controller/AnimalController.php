<?php

namespace App\Controller;

use App\Model\AnimalTrait;
use App\Utilities\CommonUtilities;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AnimalController extends AbstractController
{
    use CommonUtilities;
    use AnimalTrait;

    /**
     * @Route("/api/animal/{$id}", name="get_one_animal")
     */
    public function getOne(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AnimalController.php',
        ]);
    }

    /**
     * @Route("/api/animal/create", name="create_animal")
     */
    public function create(Request $request): ?Response
    {
        try {
            $animal = $this->createAnimal($request);
            $response = new Response($this->createResponse('success', 'create', $animal->getId()));
        } catch (\Exception $e) {
            $response = new Response($this->createResponse('error', 'exception', $this->stripSpecial($e->getMessage())));
        }
        return $response;
    }
}
