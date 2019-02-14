<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class WelcomeController
{
    public function home()
    {
        $content = app('twig')->render('welcome/home.html.twig', ['message' => 'Welcome!']);
        return new Response($content);
    }
}