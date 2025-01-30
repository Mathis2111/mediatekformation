<?php

namespace App\Repository;

use App\Entity\Playlist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Playlist>
 */
class PlaylistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Playlist::class);
    }

    // Ajoute une entité Playlist à la base de données
    public function add(Playlist $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    // Enlève une entité Playlist à la base de données
    public function remove(Playlist $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
    
    /**
     * Retourne toutes les playlists triées sur le nom de la playlist
     * @param type $champ
     * @param type $ordre
     * @return Playlist[]
     */
    public function findAllOrderByName($ordre): array{
        return $this->createQueryBuilder('p')
                ->leftjoin('p.formations', 'f')
                ->groupBy('p.id')
                ->orderBy('p.name', $ordre)
                ->getQuery()
                ->getResult();       
    } 
	
    /**
     * Enregistrements dont un champ contient une valeur
     * ou tous les enregistrements si la valeur est vide
     * @param type $champ
     * @param type $valeur
     * @param type $table si $champ dans une autre table
     * @return Playlist[]
     */
    public function findByContainValue($champ, $valeur, $table=""): array{
        if($valeur==""){
            return $this->findAllOrderByName('ASC');
        }    
        if($table==""){      
            return $this->createQueryBuilder('p')
                    ->leftjoin('p.formations', 'f')
                    ->where('p.'.$champ.' LIKE :valeur')
                    ->setParameter('valeur', '%'.$valeur.'%')
                    ->groupBy('p.id')
                    ->orderBy('p.name', 'ASC')
                    ->getQuery()
                    ->getResult();              
        }else{   
            return $this->createQueryBuilder('p')
                    ->leftjoin('p.formations', 'f')
                    ->leftjoin('f.categories', 'c')
                    ->where('c.'.$champ.' LIKE :valeur')
                    ->setParameter('valeur', '%'.$valeur.'%')
                    ->groupBy('p.id')
                    ->orderBy('p.name', 'ASC')
                    ->getQuery()
                    ->getResult();              
        }           
    } 
    
    /**
    * Récupère toutes les playlists avec le nombre de formations associées,
    * triées par nombre de formations dans l'ordre spécifié.
    * @param string $ordre L'ordre de tri des playlists basé sur le nombre de formations. 
    *                       Cela peut être "ASC" pour croissant ou "DESC" pour décroissant.
    * @return array Un tableau d'objets Playlist, avec le nombre de formations associé.
    */
    public function findAllWithFormationCount(string $ordre): array
    {
        $result = $this->createQueryBuilder('p')
            ->select('p', 'COUNT(f.id) as nb_formations')
            ->leftJoin('p.formations', 'f')
            ->groupBy('p.id')
            ->orderBy('nb_formations', $ordre)
            ->getQuery()
            ->getResult();

        foreach ($result as $data) {
            $data[0]->setNbFormations($data['nb_formations']);
        }

        return array_column($result, 0);
    }
}
