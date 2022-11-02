<?php

namespace App\Controller;

class AdminController extends AbstractController
{
    public function createBand(): string
    {
        if (!empty($_POST)) {
            $formValues = array_map('trim', $_POST);
            $formValues = array_map('htmlentities', $formValues);
        }
        return $this->twig->render('Admin/admin_createband.html.twig');
    }

    public function listBand(): string
    {
        return $this->twig->render('Admin/listBand.html.twig');
    }
}
