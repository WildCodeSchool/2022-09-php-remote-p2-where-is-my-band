<?php

namespace App\Controller;

use App\Model\MessageBandManager;
use App\Model\LocalisationManager;
use App\Model\InstrumentManager;
use App\Model\BandManager;

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
        /**
         * Initialisation du tableau d'erreur
         */
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $messageBand = array_map('trim', $_POST);
            // $errors = $this->validate($messageBand);
            $this->validateByField($messageBand, 'lastname', 'nom', $errors);
            $this->validateByField($messageBand, 'firstname', 'prénom', $errors);
            $this->validateByField($messageBand, 'instrument', 'instrument', $errors);
            $this->validateByField($messageBand, 'level', 'niveau', $errors);
            $this->validateByField($messageBand, 'style', 'style', $errors);
            $this->validateByField($messageBand, 'localisation', 'région', $errors);
            $this->validateByField($messageBand, 'email', 'email', $errors);
            $this->validateByField($messageBand, 'phone', 'téléphone', $errors);
            $this->validateByField($messageBand, 'message', 'message', $errors);
            $errors[] = $this->validate($messageBand, "email");
            $errors[] = $this->validate($messageBand, "phone");
            if (empty($errors[0]) && empty($errors[1])) {
                $this->messageBandManager->insert($messageBand);
                header('Location: /validationband');
            }
        }

        $localisationManager = new LocalisationManager();
        $instrumentManager = new InstrumentManager();
        $bandManager = new BandManager();
        return $this->twig->render('Band/contactband.html.twig', [
            'localisations' => $localisationManager->selectAll(),
            'instruments' => $instrumentManager->selectAll(),
            'errors' => $errors,
            'bands' => $bandManager->selectAll()
        ]);
    }

    private function validateByField(
        array $messageBand,
        string $field,
        string $filedName,
        array &$errors,
    ): void {
        if (empty($messageBand[$field])) {
            $errors[$field] = 'Le champ ' . $filedName . ' est obligatoire.';
        }
    }

    private function validate(array $messageBand, string $field): array
    {
        $errors = [];
        if (empty(filter_var($messageBand[$field], FILTER_VALIDATE_EMAIL)) && $field == "email") {
            $errors['emailFormat'] = 'Le champ email est au mauvais format.';
        }
        if (empty(preg_match("/^[0-9 ]*$/", $messageBand[$field])) && $field == "phone") {
            $errors['phoneFormat'] = 'Le champ téléphone est au mauvais format.';
        }
        return $errors;
    }
}
