<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    private const PROGRAMS = [
        [
            'title' => 'Walking dead',
            'synopsis' => "Après une apocalypse, ayant transformé la quasi-totalité 
            de la population en zombies, un groupe d'hommes et de femmes, mené par 
            le shérif adjoint Rick Grimes, tente de survivre... Ensemble, ils vont 
            devoir, tant bien que mal, faire face à ce nouveau monde, devenu 
            méconnaissable, à travers leur périple dans le Sud profond des 
            États-Unis.",
            'category' => 'category_Action',
            'country' => 'USA',
            'year' => 2010
        ],

        [
            'title' => 'Stranger Things',
            'synopsis' => "Quand un jeune garçon disparaît, une petite ville 
            découvre une affaire mystérieuse, des expériences secrètes, des 
            forces surnaturelles terrifiantes... et une fillette.",
            'category' => 'category_Science-Fiction',
            'country' => 'USA',
            'year' => 2016
        ],

        [
            'title' => 'Desperate Housewives',
            'synopsis' => "Wisteria Lane est un lieu paisible où les habitants 
             semblent mener une vie heureuse... en apparence seulement ! Car en y
             regardant de plus près, on découvre bien vite, dans l'intimité de 
             chacun, que le bonheur n'est pas toujours au rendez-vous. Et peu à 
             peu, les secrets remontent inévitablement à la surface, risquant de
             faire voler en éclat le vernis lisse de leur tranquille 
             existence...",
            'category' => 'category_Comédie',
            'country' => 'Etats-Unis',
            'year' => 2004
        ],

        [
            'title' => "Grey's Anatomy",
            'synopsis' => "Meredith Grey, fille d'un chirurgien très réputé, 
             commence son internat de première année en médecine chirurgicale
             dans un hôpital de Seattle. La jeune femme s'efforce de maintenir 
             de bonnes relations avec ses camarades internes, mais dans ce 
             métier difficile la compétition fait rage.",
            'category' => 'category_Drame',
            'country' => 'Etats-Unis',
            'year' => 2005
        ],

        [
            'title' => 'Pokemon',
            'synopsis' => "L'histoire suit les aventures d'un jeune garçon nommé
             Sacha dont le but est de devenir un jour Maître Pokémon. Pour cela,
             il va faire connaissance d'un Pikachu à très mauvais caractère au 
             début, mais qui va vite devenir par la suite son meilleur ami.",
            'category' => 'category_Animation',
            'country' => 'Japon',
            'year' => 1997
        ],

        [
            'title' => 'Game of Thrones',
            'synopsis' => "Il y a très longtemps, à une époque oubliée, une 
            force a détruit l'équilibre des saisons. Dans un pays où l'été peut 
            durer plusieurs années et l'hiver toute une vie, des forces 
            sinistres et surnaturelles se pressent aux portes du Royaume des 
            Sept Couronnes.",
            'category' => 'category_Aventure',
            'country' => 'Royaume-Uni',
            'year' => 2011
        ],

    ];

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $programDescription) {
            $program = new Program();
            $program->setTitle($programDescription['title']);
            $program->setSynopsis($programDescription['synopsis']);
            $program->setYear($programDescription['year']);
            $program->setCountry($programDescription['country']);
            $program->setCategory($this->getReference($programDescription['category']));
            $manager->persist($program);
            $this->addReference('program_' . $programDescription['title'], $program);
        }
        $manager->flush();
    }
}