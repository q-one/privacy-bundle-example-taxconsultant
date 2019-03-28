<?php
/**
 * Created by PhpStorm.
 * User: urlitzki
 * Date: 27.03.19
 * Time: 14:42
 */

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PersonalDataController extends AbstractController
{
    public function __construct()
    {
    }

    /**
     * @Route("/customer/", name="app_customer")
     */
    public function indexAction()
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin_index');
        } else {
            /** @var User $user */
            $user = $this->getUser();

            return $this->render('customer/index.html.twig', [
                'data' => $user->getCustomerPersonalData(),
                'financeData' => $user->getCustomerFinanceData()
            ]);
        }
    }
}