<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 *
 * This controller just renders the home page.
 */
class DefaultController extends AbstractController
{
    /**
     * @param Request $request
     * @Route("/", name="app_index")
     * @return Response
     */
    public function indexAction(Request $request)
    {
        return $this->render("default/index.html.twig");
    }
}