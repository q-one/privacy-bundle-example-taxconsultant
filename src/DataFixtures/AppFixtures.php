<?php

namespace App\DataFixtures;

use App\Entity\CustomerFinanceData;
use App\Entity\CustomerPersonalData;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Create a normal User = Customer
        $customer = new User();
        $customer->setUsername('herbert');
        $customer->setPlainPassword('Herbert1234');
        $customer->addRole('ROLE_USER');
        $customer->setEmail('herbert@exmaple.org');
        $customer->setEnabled(true);

        // Create personal data for Customer
        $data = new CustomerPersonalData();
        $data->setFirstName('Herbert');
        $data->setLastName('Glocke');
        $data->setStreet('Bahnhofstr. 1');
        $data->setZip('12345');
        $data->setCity('Wohnhausen');
        $data->setPhoneNumber('+49 175 1234 5678');
        $data->setActive(true);
        $data->setUser($customer);

        // Create personal data for Customer
        $finance = new CustomerFinanceData();
        $finance->setComment('Stammkunde.');
        $finance->setExpenses(3000);
        $finance->setIncome(150000);
        $finance->setTaxBurden(40000);
        $finance->setYear(2018);
        $finance->setUser($customer);

        $customer->setCustomerPersonalData($data);
        $customer->setCustomerFinanceData($finance);

        $manager->persist($customer);

        // Create an admin User
        $admin = new User();
        $admin->setUsername('admin');
        $admin->setPlainPassword('Admin1234');
        $admin->addRole('ROLE_ADMIN');
        $admin->setEmail('admin@exmaple.org');
        $admin->addCustomer($customer);
        $admin->setEnabled(true);

        $manager->persist($admin);

        $manager->flush();
    }
}
