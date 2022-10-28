<?php

namespace App\Controller;

class BandController extends AbstractController
{
    public function results(): string
    {
        return $this->twig->render('Band/results.html.twig');
    }
}
