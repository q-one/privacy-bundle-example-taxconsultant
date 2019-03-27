<?php
/**
 * Created by PhpStorm.
 * User: urlitzki
 * Date: 27.03.19
 * Time: 14:42
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PersonalDataController extends AbstractController
{
    /**
     * @Route("/customer/", name="app_customer")
     */
    public function indexAction()
    {
        return $this->render('customer/index.html.twig');
    }
}