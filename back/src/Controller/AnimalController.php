<?php

namespace App\Controller;

use App\Entity\Animal;
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
     * @Route("/api/animal", name="get_all_animals")
     */
    public function getAll(): ?Response
    {
        try {
            $animals = $this->getAnimals();
            $response = new Response($this->createResponse('success', 'get_all', $animals));
        } catch (\Exception $e) {
            $response = new Response($this->createResponse('error', 'exception', $this->stripSpecial($e->getMessage())));
        }
        return $response;
    }

    /**
     * @Route("/api/animal/single/{id}", name="get_one_animal")
     */
    public function getOne(int $id): ?Response
    {
        try {
            $singleJson = $this->getOneAnimal($id);
            $response = new Response($this->createResponse('success', 'get_one', $singleJson));
        } catch (\Exception $e) {
            $response = new Response($this->createResponse('error', 'exception', $this->stripSpecial($e->getMessage())));
        }
        return $response;
    }

    /**
     * @Route("/api/animal/update/{id}", name="update_animal")
     */
    public function update(Request $request, int $id): ?Response
    {
        try {
            $message = $this->updateAnimal($request, $id);
            $response = new Response($this->createResponse('success', 'get_one', $message));
        } catch (\Exception $e) {
            $response = new Response($this->createResponse('error', 'exception', $this->stripSpecial($e->getMessage())));
        }
        return $response;
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

    /**
     * @Route("/api/animal/delete/{id}", name="delete_one_animal")
     */
    public function delete(int $id): ?Response
    {
        try {
            $message = $this->deleteAnimal($id);
            $response = new Response($this->createResponse('success', 'delete', $message));
        } catch (\Exception $e) {
            $response = new Response($this->createResponse('error', 'exception', $this->stripSpecial($e->getMessage())));
        }
        return $response;
    }
}
