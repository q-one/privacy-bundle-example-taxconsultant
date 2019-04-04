<?php
/**
 * Created by PhpStorm.
 * User: urlitzki
 * Date: 27.03.19
 * Time: 12:37
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @ORM\Entity()
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="CustomerPersonalData", mappedBy="user", cascade={"all"})
     * @var CustomerPersonalData
     */
    protected $customerPersonalData;

    /**
     * @ORM\OneToMany(targetEntity="CustomerFinanceData", mappedBy="user", cascade={"all"})
     * @var CustomerFinanceData
     */
    protected $customerFinanceData;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="accountant", cascade={"all"})
     * @var UserInterface[]|ArrayCollection
     */
    protected $customers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="customers")
     * @var UserInterface
     */
    protected $accountant;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return CustomerPersonalData
     */
    public function getCustomerPersonalData(): CustomerPersonalData
    {
        return $this->customerPersonalData;
    }

    /**
     * @param CustomerPersonalData $customerPersonalData
     */
    public function setCustomerPersonalData(CustomerPersonalData $customerPersonalData): void
    {
        $this->customerPersonalData = $customerPersonalData;
    }

    /**
     * @return CustomerFinanceData
     */
    public function getCustomerFinanceData(): CustomerFinanceData
    {
        return $this->customerFinanceData;
    }

    /**
     * @param CustomerFinanceData $customerFinanceData
     */
    public function setCustomerFinanceData(CustomerFinanceData $customerFinanceData): void
    {
        $this->customerFinanceData = $customerFinanceData;
    }

    /**
     * @return UserInterface[]|ArrayCollection
     */
    public function getCustomers(): Collection
    {
        return $this->customers;
    }

    /**
     * @param UserInterface $customer
     */
    public function addCustomer(UserInterface $customer): void
    {
        $this->customers[] = $customer;
    }

    /**
     * @return UserInterface
     */
    public function getAccountant(): UserInterface
    {
        return $this->accountant;
    }

    /**
     * @param UserInterface $accountant
     */
    public function setAccountant(UserInterface $accountant): void
    {
        $this->accountant = $accountant;
    }

}