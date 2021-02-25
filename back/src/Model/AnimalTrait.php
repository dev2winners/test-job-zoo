<?php

namespace App\Model;

use App\Entity\Animal;

trait AnimalTrait
{
    public function createAnimal($request): ?Animal
    {
        $request_data = json_decode($request->getContent());
        $animal = new Animal();
        $animal->setName($request_data->name);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($animal);
        $entityManager->flush();
        return $animal;
    }
}
