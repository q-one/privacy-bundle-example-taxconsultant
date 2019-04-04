<?php
/**
 * Created by PhpStorm.
 * User: urlitzki
 * Date: 27.03.19
 * Time: 14:42
 */

namespace App\Controller;

use App\Entity\CustomerPersonalData;
use App\Entity\User;

use QOne\PrivacyBundle\Manager\CollectorInterface;
use QOne\PrivacyBundle\Survey\SurveyRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PersonalDataController extends AbstractController
{
    /**
     * @var CollectorInterface
     */
    protected $collector;

    public function __construct(CollectorInterface $collector)
    {
        $this->collector = $collector;
    }

    /**
     * @Route("/customer/", name="app_customer")
     * @throws \Exception
     */
    public function indexAction()
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin_index');
        } else {
            /** @var User $user */
            $user = $this->getUser();

            $survey = $this->collector->createSurvey(
                new SurveyRequest(User::class, ['id' => $user->getId()])
            );

            $dataReference = $survey->getFiles()->get(0)->getObject();
            $financeReference = $survey->getFiles()->get(1)->getObject();

            $data = $this->getDoctrine()->getRepository($dataReference->getClassName())->findOneBy($dataReference->getIdentifier());
            $finance = $this->getDoctrine()->getRepository($financeReference->getClassName())->findOneBy($financeReference->getIdentifier());

            return $this->render('customer/index.html.twig', [
                'data' => $data,
                'financeData' => $finance
            ]);
        }
    }
}