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

    public function getOneAnimal(int $id): ?string
    {
        $entityManager = $this->getDoctrine()->getManager();
        $animal = $entityManager->getRepository(Animal::class)->find($id);

        if (!$animal) {
            throw $this->createNotFoundException(
                'No animal found for id ' . $id
            );
        }

        $single = [];
        $single["id"] = $animal->getId();
        $single["name"] = $animal->getName();
        return json_encode($single, JSON_UNESCAPED_UNICODE);
    }

    public function getAnimals(): ?string
    {

        $entityManager = $this->getDoctrine()->getManager();
        $animals = $entityManager->getRepository(Animal::class)->findAll();

        $result = [];
        foreach ($animals as $animal) {
            $result[] = [
                'id' => $animal->getId(),
                'name' => $animal->getName()
            ];
        }
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function deleteAnimal(int $id): ?string
    {
        $entityManager = $this->getDoctrine()->getManager();
        $animal = $entityManager->getRepository(Animal::class)->find($id);

        if (!$animal) {
            throw $this->createNotFoundException(
                'No animal found for id ' . $id
            );
        }

        $entityManager->remove($animal);
        $entityManager->flush();

        return $id . ' deleted';
    }

    public function updateAnimal($request, int $id): ?string
    {
        $data = $request->getContent();
        $data = json_decode($data);

        $entityManager = $this->getDoctrine()->getManager();
        $animal = $entityManager->getRepository(Animal::class)->find($id);

        if (!$animal) {
            throw $this->createNotFoundException(
                'No animal found for id ' . $id
            );
        }

        $animal->setName($data->name);

        $entityManager->persist($animal);
        $entityManager->flush();

        return $id . ' updated';
    }
}
