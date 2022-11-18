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
}
