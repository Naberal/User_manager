<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\User\Domain\Entities\User;
use App\User\Domain\VO\Login;
use App\User\Domain\VO\Password;
use App\User\Domain\VO\Phone;
use App\User\Domain\VO\UserId;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $manager->persist(new User(
                    UserId::generate(),
                    new Login("user$i"),
                    new Phone(10000 + $i),
                    new Password("pass$i")
                )
            );
        }
        $manager->flush();
    }
}
