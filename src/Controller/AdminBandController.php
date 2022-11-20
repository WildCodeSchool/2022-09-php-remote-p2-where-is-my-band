<?php

namespace App\Controller;

use App\Model\AdminBandManager;
use App\Model\LocalisationManager;
use App\Model\BandManager;
use App\Model\InstrumentManager;

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
            $band['file'] = '';
            $errors = $this->validate($band);
            if (empty($errors)) {
                // upload file
                if (isset($_FILES['file'])) {
                    $tmpName = $_FILES['file']['tmp_name'];
                    $name = $_FILES['file']['name'];
                    $size = $_FILES['file']['size'];

                    // TEST //
                    $uploadDir = '/../../public/uploads/';
                    $extension = pathinfo($name, PATHINFO_EXTENSION);
                    $fileName = pathinfo($name, PATHINFO_FILENAME) . '-' . uniqid() . "." . $extension;
                    $uploadFile = $uploadDir . $fileName;
                    $authorizedExtensions = ['jpg', 'gif', 'png', 'webp'];
                    $maxFileSize = 5000000;

                    if ((!in_array($extension, $authorizedExtensions))) {
                        $errors['file_extension'] = 'Veuillez sélectionner une image de type JPG, PNG, GIF ou WEBP';
                    }

                    if (file_exists($tmpName) && filesize($tmpName) > $maxFileSize) {
                        $errors[$size] = "Veuillez choisir un fichier de moins de 5Mo !";
                    }

                    if (empty($errors)) {
                        $band['file'] = $fileName;
                        if (move_uploaded_file($tmpName, __DIR__ . $uploadFile)) {
                            $this->adminBandManager->insert($band);
                            header('Location: /createband');
                        }
                    }
                }
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
        $localisationManager = new LocalisationManager();
        $instrumentManager = new InstrumentManager();
        $bandManager = new BandManager();
        return $this->twig->render('Admin/admin_listband.html.twig', [
            'localisations' => $localisationManager->selectAll(),
            'instruments' => $instrumentManager->selectAll(),
            'bands' => $bandManager->selectAll(),

        ]);
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = trim($_GET['id']);
            $bandManager = new AdminBandManager();
            $bandManager->delete((int)$id);
            header('Location:/listband');
        }
    }

    /**
     * Edit a specific item
     */
    public function edit(int $id): ?string
    {
        $bandManager = new AdminBandManager();
        $localisationManager = new LocalisationManager();
        $band = $bandManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $band = array_map('trim', $_POST);
            // var_dump($band);
            // die();
            // TODO validations (length, format...)
            // if validation is ok, update and redirection
            $bandManager->updateBand($band);
            header('Location: /listband');
            return null;
        }
        var_dump($band);
        return $this->twig->render('Admin/admin_editband.html.twig', [
            'localisations' => $localisationManager->selectAll(),
            'band' => $band
        ]);
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
        if (empty($band['picture'])) {
            $errors['picture'] = 'Le champ picture est obligatoire.';
        }
        if (empty($band['localisation_id'])) {
            $errors['localisation_id'] = 'Le champ localisation est obligatoire.';
        }
        return $errors;
    }
}
