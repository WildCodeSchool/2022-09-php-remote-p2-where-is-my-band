<?php

namespace App\Controller;

use App\Model\BandManager;
use App\Model\LocalisationManager;
use App\Model\InstrumentManager;

class BandController extends AbstractController
{
    // private BandManager $bandManager;

    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->bandManager = new BandManager();
    // }

    public function results(): string
    {
        $search = $_GET;
        $bandManager = new BandManager();
        $bands = $bandManager->selectAllByQuery($search);
        $instrumentManager = new InstrumentManager();
        $localisationManager = new LocalisationManager();
        return $this->twig->render('Band/results.html.twig', [
            'bands' => $bands,
            'localisations' => $localisationManager->selectAll(),
            'instrument' => $instrumentManager->selectAll()
        ]);
    }

    public function localisation(): string
    {
        $localisationManager = new LocalisationManager();
        return $this->twig->render('Include/_filterform.html.twig', [
            'localisations' => $localisationManager->selectAll()
        ]);
    }
}
