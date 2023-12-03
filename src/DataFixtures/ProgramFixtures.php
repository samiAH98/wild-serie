<?php
namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    
    public function load(ObjectManager $manager) :void
    {

        $categoryAction = $this->getReference('category_Action'); 
        $categoryAdventure = $this->getReference('category_Aventure');
        $categoryAnimation = $this->getReference('category_Animation'); 
        $categoryRomance = $this->getReference('category_Romance');
        $categoryComedy = $this->getReference('category_Comedie'); 
        $categorySF = $this->getReference('category_Science-fiction'); 
        $categoryFantastic = $this->getReference('category_Fantastique'); 
        $categoryHorror = $this->getReference('category_Horreur');


        $program1 = new Program();
        $program1->setTitle('The Last Of Us');
        $program1->setSynopsis('20 ans après la destruction de la civilisation moderne par un virus, Joël (Pedro Pascal), un survivant aguerri est embauché pour aider Ellie (Bella Ramsey), une jeune fille de 14 ans, pour rejoindre une autre communauté. Le chemin sera un long road-trip où ils vont croiser de nombreux résistants qui ont leurs propres règles, des paysages désolants et des infectés extrêmement violents. Mais le plus important sera que la relation entre Joël et Ellie changera du tout au tout');
        $program1->setPoster('https://www.lacremedugaming.fr/wp-content/uploads/creme-gaming/2022/12/the-last-of-us-1-729x410.jpg');
        $program1->setCategory($categorySF);
        $manager->persist($program1);

        $program2 = new Program();
        $program2->setTitle('Lupin');
        $program2->setSynopsis("En 1995, le jeune Assane Diop est bouleversé par le suicide de son père, accusé d'un vol qu'il n'a pas commis. Vingt-cinq ans plus tard, Assane (Omar Sy) organise le vol d'un collier ayant appartenu à Marie-Antoinette d'Autriche. Le bijou, aujourd'hui exposé au musée du Louvre, appartenait à la riche famille Pellegrini. Il veut se venger de cette famille ayant accusé à tort son père, en s'inspirant de son personnage fétiche : le « gentleman cambrioleur » Arsène Lupin. En parallèle de ses activités illégales, Assane tente également de s'occuper davantage de son fils Raoul, qui vit aujourd'hui avec son ex-petite amie Claire (Ludivine Sagnier).");
        $program2->setPoster('https://bocir-prod-bucket.s3.amazonaws.com/medias/Vsj0LZpM34/image/AAAABQhFFW_tbpg3RISB2IOFXruk5DQxejckJecw5HZycFnZodxl67TekY2mcBdZv8zTlLpiZE1LvILSAQAVRD9jRvjz5Fft3BcSRMah_BtkiDPj_pKvEL_uoW7U0aEJEeotY3JELw1696596437779.jpg');
        $program2->setCategory($categoryAction);
        $manager->persist($program2);

        $program3 = new Program();
        $program3->setTitle('Pat Patrouille');
        $program3->setSynopsis('Ryder, un jeune garçon de 10 ans, est toujours prêt à venir en aide aux gens de la Grande Vallée. Pour cela, il peut compter sur la Pat’Patrouille pour solutionner n’importe quelle mission de sauvetage.');
        $program3->setPoster('https://static.wikia.nocookie.net/heros/images/e/e2/Paw_Patrol.jpg/revision/latest/scale-to-width-down/1200?cb=20210203210230&path-prefix=fr');
        $program3->setCategory($categoryAnimation);
        $manager->persist($program3);

        $program4 = new Program();
        $program4->setTitle('One Piece');
        $program4->setSynopsis("Cette série en prises de vues réelles raconte les aventures d'un pirate peu ordinaire, d'après le célèbre manga d'Eiichiro Oda.");
        $program4->setPoster('https://www.google.com/url?sa=i&url=https%3A%2F%2Factu.fr%2Floisirs-culture%2Fone-piece-netflix-devoile-une-nouvelle-bande-annonce-de-l-adaptation-du-celebre-manga_59886287.html&psig=AOvVaw0PSJ6MOXAWMm5_k9EsufES&ust=1701644312668000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCOi8nZjt8YIDFQAAAAAdAAAAABAE');
        $program4->setCategory($categoryAdventure);
        $manager->persist($program4);


        $program5 = new Program();
        $program5->setTitle('Sex Education');
        $program5->setSynopsis("Le jeune Otis Milburn (Asa Butterfield), dont la mère est thérapeute / sexologue (Gillian Anderson), refuse qu’elle lui apprenne les rudiments de l’éveil sexuel, alors qu'il est vierge et qu'il ne parvient pas à se masturber. Par un concours de circonstances, Otis se retrouve à aider la terreur du lycée, Adam (Connor Swindells), qui a pour sa part des problèmes d'éjaculation. Témoin de cette thérapie improvisée, Maeve Wiley (Emma Mackey), une jeune rebelle qui vit sans parents et a des problèmes d'argent, propose à Otis de créer un « cabinet de sexologie » au sein du lycée avec l’aide d’Eric (Ncuti Gatwa).");
        $program5->setPoster('https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.gqmagazine.fr%2Fpop-culture%2Farticle%2Fsex-education-on-connait-la-date-de-sortie-de-la-saison-2&psig=AOvVaw0761OhoT1VRaGrFpak2cmC&ust=1701644414882000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCIDEgsnt8YIDFQAAAAAdAAAAABAJ');
        $program5->setCategory($categoryComedy);
        $manager->persist($program5);

        $program6 = new Program();
        $program6->setTitle('Gossip Girl');
        $program6->setSynopsis("Le blog Gossip Girl est un carton chez les étudiants huppés des écoles privées de Constance Billard, pour les filles, et de St Jude, pour les garçons, dans l'Upper East Side, quartier de Manhattan à New York.
        Sur ce site, une mystérieuse blogueuse dévoile tous les derniers potins et rumeurs sur cette jeunesse dorée.");
        $program6->setPoster('https://assets.afcdn.com/story/20130224/16683_w1200h630c1.jpg');
        $program6->setCategory($categoryRomance);
        $manager->persist($program6);

        
        $program7 = new Program();
        $program7->setTitle('Locke & Key');
        $program7->setSynopsis("Après le meurtre horrible de leur père à Seattle tué par balle par un de ses étudiants, les trois enfants Tyler (Connor Jessup), Kinsey (Emilia Jones) et Bode Locke (Jackson Robert Scott) emménagent avec leur mère Nina (Darby Stanchfield) à Matheson, une ville fictive du Massachusetts. Ils vont désormais vivre dans la demeure ancestrale de leur famille, Keyhouse. Tyler est le plus fragile, car il se sent très affecté par la mort de son père dont il se sent responsable. Kinsey est la cadette. Timide et réservée, elle déteste sa mère alcoolique. Bode est le benjamin de la famille, il est assez dissipé, mais très imaginatif.");
        $program7->setPoster('https://www.google.com/url?sa=i&url=https%3A%2F%2Ffreakingeek.com%2Flocke-and-key-le-comics-de-joe-hill-adaptee-sur-netflix%2F&psig=AOvVaw3Q2ib_a0y-6HJ0K5ZM1yQa&ust=1701644748700000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCLjSnOju8YIDFQAAAAAdAAAAABAE');
        $program7->setCategory($categoryFantastic);
        $manager->persist($program7);


        $program8 = new Program();
        $program8->setTitle('The walking dead');
        $program8->setSynopsis("Rick Grimes (Andrew Lincoln) est shérif du comté de Kings en Géorgie. Il se réveille d’un coma de plusieurs semaines pour découvrir un monde changé. Les villes sont vidées de leurs habitants. Un virus a causé la transformation de la majeure partie des humains en zombies. Les rares survivants se sont parqués en camps de fortune ou dans certaines parties barricadées de la ville. Les zombies, appelés “rôdeurs”, sont très dangereux, attirés par les bruits et les odeurs humaines.");
        $program8->setPoster('https://www.google.com/url?sa=i&url=https%3A%2F%2Ffreakingeek.com%2Flocke-and-key-le-comics-de-joe-hill-adaptee-sur-netflix%2F&psig=AOvVaw3Q2ib_a0y-6HJ0K5ZM1yQa&ust=1701644748700000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCLjSnOju8YIDFQAAAAAdAAAAABAE');
        $program8->setCategory($categoryHorror);
        $manager->persist($program8);

        
        $manager->flush();

 
        $this->addReference('program_TheLastOfUs', $program1);
        $this->addReference('program_Lupin', $program2);
        $this->addReference('program_PatPatrouille', $program3);
        $this->addReference('program_OnePiece', $program4);
        $this->addReference('program_SexEducation', $program5);
        $this->addReference('program_GossipGirl', $program6);
        $this->addReference('program_LockeAndKey', $program7);
        $this->addReference('program_TheWalkingDead', $program8);
    }
    public function getDependencies() :array
    {
        return [
            CategoryFixtures::class,
        ];
    }
}