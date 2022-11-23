<?php

namespace App\Controller;

use App\Model\MessageContactManager;
use App\Model\MessageBandManager;

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
        $messContactManager = new MessageContactManager();
        $messageBandManager = new MessageBandManager();
        return $this->twig->render('Admin/admin_listmessage.html.twig', [
            'messagesContact' => $messContactManager->selectAll(),
            'messagesBand' => $messageBandManager->selectAll(),
        ]);
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
        if (empty(filter_var($messageContact['email'], FILTER_VALIDATE_EMAIL))) {
            $errors['emailFormat'] = 'Le champ email est au mauvais format.';
        }
        if (empty($messageContact['phone'])) {
            $errors['phone'] = 'Le champ téléphone est obligatoire.';
        }
        if (empty(preg_match("/^[0-9 ]*$/", $messageContact['phone']))) {
            $errors['phoneFormat'] = 'Le champ téléphone est au mauvais format.';
        }
        if (empty($messageContact['message'])) {
            $errors['message'] = 'Le champ message est obligatoire.';
        }
        return $errors;
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = trim($_GET['id']);
            $messContactManager = new MessageContactManager();
            $messContactManager->delete((int)$id);
            header('Location:/listmessage');
        }
    }
}
