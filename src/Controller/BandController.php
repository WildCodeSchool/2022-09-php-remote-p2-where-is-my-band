<?php

namespace App\Controller;

use App\Model\BandManager;
use App\Model\LocalisationManager;
use App\Model\InstrumentManager;

class BandController extends AbstractController
{
    public function results(): string
    {
        $search = array_map('trim', $_GET);
        $bandManager = new BandManager();
        $bands = $bandManager->selectAllByQuery($search);
        $instrumentManager = new InstrumentManager();
        $localisationManager = new LocalisationManager();
        return $this->twig->render('Band/results.html.twig', [
            'bands' => $bands,
            'localisations' => $localisationManager->selectAll(),
            'instruments' => $instrumentManager->selectAll(),
            'search' => $search

        ]);
    }

    public function localisation(): string
    {
        $localisationManager = new LocalisationManager();
        return $this->twig->render('Include/_filterform.html.twig', [
            'localisations' => $localisationManager->selectAll()
        ]);
    }

    public function validationband(): string
    {
        return $this->twig->render('Band/validationband.html.twig');
    }
}
