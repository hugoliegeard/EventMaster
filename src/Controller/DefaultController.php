<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Event;
use App\Repository\CategoryRepository;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{

    /**
     * Page d'accueil
     * @return Response
     */
    #[Route('/', name: 'default_home', methods: ['GET'])]
    public function home(EventRepository $eventRepository)
    {
        # Récupérer les 3 derniers évènements
        $events = $eventRepository->findBy([], [], 3);

        return $this->render('default/home.html.twig', [
            'events' => $events, # Je passe la variable events à Twig
        ]);
        # return new Response('<h1>Hello World!</h1>');
    }

    /**
     * Page catégorie des évènements
     * ex. https://localhost:8000/categorie/1
     * ex. https://localhost:8000/categorie/2
     * ex. https://localhost:8000/categorie/3
     * @return Response
     */
    #[Route('/categorie/{id}', name: 'default_category', methods: ['GET'])]
    public function category($id, CategoryRepository $categoryRepository): Response
    {

        $category = $categoryRepository->find($id);
        // dd($category);

        # return new Response("<h1>Catégorie : $id</h1>");
        return $this->render('default/category.html.twig', [
            'category' => $category,
        ]);
    }

    /**
     * Page pour afficher un évènement
     * ex. https://localhost:8000/{param:category}/{param:titre}_{param:id}
     * ex. https://localhost:8000/spectacle/week-end-raclette-a-baggersee_1
     * @return Response
     */
    #[Route('/{category}/{title}_{id:event}', name: 'default_event', methods: ['GET'])]
    public function event(Event $event): Response
    {
        dd($event);

        return new Response("
            <h1>
                Catégorie : $category
                <br> Titre : $title,
                <br> ID : $id,
            </h1>
        ");
    }



}
