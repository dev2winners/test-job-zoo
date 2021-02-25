<?php

namespace App\Controller;

use App\Entity\Animal;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AnimalController extends AbstractController
{
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
            $request_data = json_decode($request->getContent());
            $animal = new Animal();
            $animal->setName($request_data->name);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($animal);
            $entityManager->flush();
            $response = new Response('{"result":"success","type":"create","data": {"id":"' . $animal->getId() . '"}}');
        } catch (\Exception $e) {
            $response = new Response('{"result":"error","type":"exception","data": {"message":"' . str_replace(['"', '\'', "\n", "\r", '[', ']'], '', $e->getMessage()) . '"}}');
        }
        return $response;
    }
}
