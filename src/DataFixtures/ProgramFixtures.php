<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;


class ProgramFixtures extends Fixture implements DependentFixtureInterface
{   

    private const PROGRAMS = [
            ['title' => 'Walking dead', 'synopsis' => 'Des zombies envahissent la terre', 'category' => 'category_Horreur', 'country' => 'USA', 'year' => '2010'],
            ['title' => 'The Big Bang Theory', 'synopsis' => 'Des rires fous à Pasadena', 'category' => 'category_Comedie', 'country' => 'USA', 'year' => '2007'],
            ['title' => 'Trotro', 'synopsis' => 'Les anes en France', 'category' => 'category_Animation', 'country' => 'France', 'year' => '2004'],
            ['title' => 'Fast & Furious 10', 'synopsis' => 'Les Espions dans la course', 'category' => 'category_Action', 'country' => 'USA', 'year' => '2023'],
            ['title' => 'Les bronzés font du ski', 'synopsis' => 'Vancances aux skis', 'category' => 'category_Comedie', 'country' => 'France', 'year' => '1979'],
    ];

    private $slugger;

    public function getDependencies(): array
    {
        return [
          CategoryFixtures::class,
        ];
    }

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $i = 0;
        foreach (self::PROGRAMS as $programDescription){
            $program = new Program();
            $program->setTitle($programDescription['title']);
            $program->setSynopsis($programDescription['synopsis']);
            $program->setSynopsis($programDescription['country']);
            $program->setSynopsis($programDescription['year']);
            $program->setCategory($this->getReference($programDescription['category']));
            $slug = $this->slugger->slug($program->getTitle());
            $program->setSlug($slug);
            $manager->persist($program);
            $this->addReference('program_' . $i++, $program);
        }
        $manager->flush();
    }
    
    static function getTitles(): array
    {
        return array_map(fn ($arr) => $arr['title'], self::PROGRAMS);
    }

}