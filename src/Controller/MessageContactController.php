<?php

namespace App\Controller;

use App\Model\MessageContactManager;

class MessageContactController extends AbstractController
{
    private MessageContactManager $messContactManager;

    public function __construct()
    {
        parent::__construct();
        $this->messContactManager = new MessageContactManager();
    }

    /**
     * Add a new message
     */
    public function insertMessageContact(): string
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $messageContact = array_map('trim', $_POST);
            $errors = $this->validate($messageContact);
            if (empty($errors)) {
                $this->messContactManager->insert($messageContact);
                header('Location: /validation');
            }
        }

        return $this->twig->render('Home/contact.html.twig', [
            'errors' => $errors
        ]);
    }

    public function listMessageContact(): string
    {
        return $this->twig->render('Admin/listmessage.html.twig');
    }

    private function validate(array $messageContact): array
    {
        $errors = [];
        if (empty($messageContact['lastname'])) {
            $errors['lastname'] = 'Le champ nom est obligatoire.';
        }
        if (empty($messageContact['firstname'])) {
            $errors['firstname'] = 'Le champ prénom est obligatoire.';
        }
        if (empty($messageContact['email'])) {
            $errors['email'] = 'Le champ email est obligatoire.';
        }
        if (empty($messageContact['phone'])) {
            $errors['phone'] = 'Le champ téléphone est obligatoire.';
        }
        if (empty($messageContact['message'])) {
            $errors['message'] = 'Le champ message est obligatoire.';
        }
        return $errors;
    }
}
