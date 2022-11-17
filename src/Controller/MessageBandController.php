<?php

namespace App\Controller;

use App\Model\MessageBandManager;
use App\Model\LocalisationManager;
use App\Model\InstrumentManager;

class MessageBandController extends AbstractController
{
    private MessageBandManager $messageBandManager;

    public function __construct()
    {
        parent::__construct();
        $this->messageBandManager = new MessageBandManager();
    }

    /**
     * Add a new message
     */
    public function insertMessageBand(): string
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $messageBand = array_map('trim', $_POST);
            $errors = $this->validate($messageBand);

            if (empty($errors)) {
                $this->messageBandManager->insert($messageBand);
                header('Location: /validationband');
            }
        }

        $localisationManager = new LocalisationManager();
        $instrumentManager = new InstrumentManager();
        return $this->twig->render('Band/contactband.html.twig', [
            'localisations' => $localisationManager->selectAll(),
            'instruments' => $instrumentManager->selectAll(),
            'errors' => $errors
        ]);
    }

    public function listMessageBand(): string
    {
        return $this->twig->render('Admin/listmessage.html.twig');
    }

    private function validate(array $messageBand): array
    {
        $errors = [];
        if (empty($messageBand['lastname'])) {
            $errors['lastname'] = 'Le champ nom est obligatoire.';
        }
        if (empty($messageBand['firstname'])) {
            $errors['firstname'] = 'Le champ prénom est obligatoire.';
        }
        if (empty($messageBand['instrument'])) {
            $errors['instrument'] = 'Le champ instrument est obligatoire.';
        }
        if (empty($messageBand['level'])) {
            $errors['level'] = 'Le champ niveau est obligatoire.';
        }
        if (empty($messageBand['style'])) {
            $errors['style'] = 'Le champ style est obligatoire.';
        }
        if (empty($messageBand['localisation'])) {
            $errors['localisation'] = 'Le champ localisation est obligatoire.';
        }
        if (empty($messageBand['email'])) {
            $errors['email'] = 'Le champ email est obligatoire.';
        }
        if (empty($messageBand['phone'])) {
            $errors['phone'] = 'Le champ téléphone est obligatoire.';
        }
        if (empty($messageBand['message'])) {
            $errors['message'] = 'Le champ message est obligatoire.';
        }
        return $errors;
    }
}
