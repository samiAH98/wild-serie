<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    private const EPISODES = [
        [
            'season' => 'season_1',
            'title' => 'Passé décomposé',
            'number' => 1,
            'synopsis' => "Rick part à la recherche de sa famille dans un monde 
            envahi de morts vivants. Morgan et Duane aident Rick en lui 
            apprenant de nouvelles règles cruciales pour sa survie."
        ],

        [
            'season' => 'season_1',
            'title' => 'Tripes',
            'number' => 2,
            'synopsis' => "IRick met involontairement en danger un groupe de 
            survivants en permettant aux rôdeurs de découvrir leur cachette. 
            Mais un ennemi encore plus dangereux se cache parmi eux."
        ],

        [
            'season' => 'season_1',
            'title' => 'T’as qu’à discuter avec les grenouilles',
            'number' => 3,
            'synopsis' => "Rick met involontairement en danger un groupe de 
            survivants en permettant aux rôdeurs de découvrir leur cachette. 
            Mais un ennemi encore plus dangereux se cache parmi eux."
        ],

        [
            'season' => 'season_2',
            'title' => 'Ce qui nous attend',
            'number' => 1,
            'synopsis' => "Rick parvient à conduire le groupe hors d'Atlanta. 
            Sur l'autoroute, les survivants doivent affronter une menace sans 
            précédent. L'un d'entre eux disparaît.."
        ],

        [
            'season' => 'season_2',
            'title' => 'Saignée',
            'number' => 2,
            'synopsis' => "Venant en aide à un homme, Rick découvre un lieu qui 
            pourra leur servir de refuge. Shane part pour une mission dangereuse
            à la recherche de matériel médical."
        ],

        [
            'season' => 'season_3',
            'title' => 'Graines',
            'number' => 1,
            'synopsis' => "Dans un monde toujours plus hostile, alors que la 
            grossesse de Lori arrive à terme, Rick est à la recherche d'un 
            endroit sûr où le groupe pourra trouver refuge."
        ],

        [
            'season' => 'season_3',
            'title' => 'Malade',
            'number' => 2,
            'synopsis' => "La situation ne fait qu'empirer avec la découverte de 
            nouveaux ennemis. Rick et le groupe doivent se battre pour assurer 
            la survie de l'un d'eux."
        ],

        [
            'season' => 'season_3',
            'title' => 'Marchez avec moi',
            'number' => 3,
            'synopsis' => "Après avoir été témoin d'un accident, Andrea et 
            Michonne tombent sur une nouvelle communauté de survivants. Une 
            rencontre peut-être moins positive qu'il n'y parait."
        ],

    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::EPISODES as $episodeDescription){
            $episode = new Episode();
            $episode->setNumber($episodeDescription['number']);
            $episode->setTitle($episodeDescription['title']);
            $episode->setSynopsis($episodeDescription['synopsis']);
            $episode->setSeason($this->getReference($episodeDescription['season']));
            $manager->persist($episode);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SeasonFixtures::class,
        ];
    }
}