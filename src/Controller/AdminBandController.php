<?php

namespace App\Controller;

use App\Model\AdminBandManager;
use App\Model\LocalisationManager;

class AdminBandController extends AbstractController
{
    private AdminBandManager $adminBandManager;

    public function __construct()
    {
        parent::__construct();
        $this->adminBandManager = new AdminBandManager();
    }

    public function createBand(): string
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $band = array_map('trim', $_POST);
            $errors = $this->validate($band);
            if (empty($errors)) {
                $this->adminBandManager->insert($band);
                header('Location: /');
            }
        }

        $localisationManager = new LocalisationManager();
        return $this->twig->render('Admin/admin_createband.html.twig', [
            'localisations' => $localisationManager->selectAll(),
            'errors' => $errors
        ]);
    }

    public function listBand(): string
    {
        return $this->twig->render('Admin/listBand.html.twig');
    }

    private function validate(array $band): array
    {
        $errors = [];
        if (empty($band['name'])) {
            $errors['name'] = 'Le champ name est obligatoire.';
        }
        if (empty($band['description'])) {
            $errors['description'] = 'Le champ description est obligatoire.';
        }
        // if (empty($band['picture'])) {
        //     $errors['picture'] = 'Le champ picture est obligatoire.';
        // }
        // a dé commenter une fois la verif upload terminé
        if (empty($band['localisation_id'])) {
            $errors['localisation_id'] = 'Le champ localisation est obligatoire.';
        }
        return $errors;
    }
}
