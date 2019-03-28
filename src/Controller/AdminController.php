<?php
/**
 * Created by PhpStorm.
 * User: urlitzki
 * Date: 27.03.19
 * Time: 15:44
 */

namespace App\Controller;

use App\Entity\User;
use Facebook\WebDriver\Exception\ExpectedException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/admin/edit/{customer}", name="admin_edit")
     * @param User $customer
     * @param Request $request
     * @return Response
     */
    public function editAction(User $customer, Request $request)
    {
        $data = $customer->getCustomerPersonalData();

        $form = $this->createFormBuilder($data)
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('street', TextType::class)
            ->add('zip', TextType::class)
            ->add('city', TextType::class)
            ->add('phoneNumber', TextType::class)
            ->add('save', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $this->getDoctrine()->getManager()->persist($data);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash("success", "Customer successfully saved!");

            return $this->redirectToRoute('admin_edit', ['customer' => $customer->getId()]);
        }

        return $this->render("admin/edit.html.twig", ['form' => $form->createView()]);
    }
}