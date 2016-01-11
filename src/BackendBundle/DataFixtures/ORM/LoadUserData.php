<?php
/**
 * Created by IntelliJ IDEA.
 * User: diole
 * Date: 09/01/16
 * Time: 01:54 PM
 */

namespace BackendBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BackendBundle\Entity\User;
use BackendBundle\Entity\Role;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\ORM\EntityManager;

class LoadUserData implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param EntityManager $manager
     */
    public function load(ObjectManager $manager) {
        $role = new Role();
        $role->setName('ROLE_USER');
        $role->setDescription('Usuarios');
        $manager->persist($role);

        $role2 = new Role();
        $role2->setName('ROLE_ADMIN');
        $role2->setDescription('Administrador');
        $manager->persist($role2);

        // Crear el usuario para la administración
        $admin = new User();
        $admin->setUsername('admin');
        $admin->setName('Administrador del Sistema');
        $admin->setEmail('admin@egaussweb.com');
        $admin->setPassword('adminpass');
        $admin->addRole($role2);
        $manager->persist($admin);

        $manager->flush();
    }
}