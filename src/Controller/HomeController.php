<?php

namespace App\Controller;

use App\Model\LocalisationManager;
use App\Model\InstrumentManager;

class HomeController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {
        $localisationManager = new LocalisationManager();
        $instrumentManager= new InstrumentManager();
        return $this->twig->render('Home/index.html.twig', [
            'localisations' => $localisationManager->selectAll(),
            'instruments' => $instrumentManager->selectAll(),
        ]);
    }

    public function mentions(): string
    {
        return $this->twig->render('Home/mentions.html.twig');
    }

    public function aboutus(): string
    {
        return $this->twig->render('Home/about_us.html.twig');
    }

    public function contact(): string
    {
        return $this->twig->render('Home/contact.html.twig');
    }

    public function validation(): string
    {
        return $this->twig->render('Home/validation.html.twig');
    }
}
