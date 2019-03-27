<?php
/**
 * Created by PhpStorm.
 * User: urlitzki
 * Date: 27.03.19
 * Time: 15:44
 */

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
*/
class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_index")
     * @return Response
     */
    public function indexAction()
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render("admin/index.html.twig", ['customers' => $user->getCustomers()]);
    }
}