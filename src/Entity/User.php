<?php
/**
 * Created by PhpStorm.
 * User: urlitzki
 * Date: 27.03.19
 * Time: 12:37
 */

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\OneToOne(targetEntity="App\Entity\CustomerData", mappedBy="user", cascade={"all"})
     * @ORM\JoinColumn(nullable = true, unique = true)
     * @var CustomerData
     */
    protected $customerData;

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

}