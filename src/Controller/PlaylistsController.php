<?php
namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\FormationRepository;
use App\Repository\PlaylistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Playlist;
use App\Form\PlaylistType;

/**
 * Description of PlaylistsController
 *
 * @author emds
 */

class PlaylistsController extends AbstractController {
    
    /**
     * 
     * @var PlaylistRepository
     */
    private $playlistRepository;
    
    /**
     * 
     * @var FormationRepository
     */
    private $formationRepository;
    
    /**
     * 
     * @var CategorieRepository
     */
    private $categorieRepository; 
    
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    
    function __construct(PlaylistRepository $playlistRepository, 
            CategorieRepository $categorieRepository,
            FormationRepository $formationRespository,
            EntityManagerInterface $entityManager) {
        $this->playlistRepository = $playlistRepository;
        $this->categorieRepository = $categorieRepository;
        $this->formationRepository = $formationRespository;
        $this->entityManager = $entityManager;
    }
    
    private const PLAYLISTS_TEMPLATE = "pages/playlists.html.twig";
    private const PLAYLIST_TEMPLATE = "pages/playlist.html.twig";
    
    /**
     * @Route("/playlists", name="playlists")
     * @return Response
     */
    
    // Affiche la liste des playlists avec le nombre de formations associées
    #[Route('/playlists', name: 'playlists')]
    public function index(): Response {
        $playlists = $this->playlistRepository->findAllOrderByName('ASC');
        foreach ($playlists as $playlist) {
            $playlist->nb_formations = $playlist->getNbFormations();
        }
        return $this->render(self::PLAYLISTS_TEMPLATE, [
            'playlists' => $playlists,
            'categories' => $this->categorieRepository->findAll()
        ]);
    }


    // Trie les playlists selon un champ donné et un ordre spécifié
    #[Route('/playlists/tri/{champ}/{ordre}', name: 'playlists.sort')]
    public function sort($champ, $ordre): Response {
        switch ($champ) {
            case "name":
                $playlists = $this->playlistRepository->findAllOrderByName($ordre);
                break;
            case "formations":
                $playlists = $this->playlistRepository->findAllWithFormationCount($ordre);
                break;
            default:
                $playlists = [];
                break;
        }
        if ($champ == "name"){
            foreach ($playlists as $playlist) {
            $playlist->nb_formations = $playlist->getNbFormations();
            }
        }        
        
        
        $categories = $this->categorieRepository->findAll();
        return $this->render(self::PLAYLISTS_TEMPLATE, [
            'playlists' => $playlists,
            'categories' => $categories
        ]);
    }          

    // Recherche les playlists contenant une valeur spécifique dans un champ donné
    #[Route('/playlists/recherche/{champ}/{table}', name: 'playlists.findallcontain')]
    public function findAllContain($champ, Request $request, $table=""): Response{
        $valeur = $request->get("recherche");
        $playlists = $this->playlistRepository->findByContainValue($champ, $valeur, $table);
        foreach ($playlists as $playlist) {
            $playlist->nb_formations = $playlist->getNbFormations();
        }
        $categories = $this->categorieRepository->findAll();
        return $this->render(self::PLAYLISTS_TEMPLATE, [
            'playlists' => $playlists,
            'categories' => $categories,            
            'valeur' => $valeur,
            'table' => $table
        ]);
    }  

    // Affiche les détails d'une playlist spécifique
    #[Route('/playlists/playlist/{id}', name: 'playlists.showone')]
    public function showOne($id): Response{
        $playlist = $this->playlistRepository->find($id);
        $playlistCategories = $this->categorieRepository->findAllForOnePlaylist($id);
        $playlistFormations = $this->formationRepository->findAllForOnePlaylist($id);
        return $this->render(self::PLAYLIST_TEMPLATE, [
            'playlist' => $playlist,
            'playlistcategories' => $playlistCategories,
            'playlistformations' => $playlistFormations
        ]);        
    } 
    
    /**
     * Supprime une playlist si elle ne contient aucune formation
     *
     * @Route('/playlists/delete/{id}', name: 'playlists.delete', methods={"POST"})
     */
    
    #[Route('/playlists/delete/{id}', name: 'playlists.delete', methods: ['POST', 'GET'])]
    public function delete($id): Response
    {
        $playlist = $this->playlistRepository->find($id);

        if ($playlist->getFormations()->isEmpty()) {
            $this->entityManager->remove($playlist);
            $this->entityManager->flush();
            $this->addFlash('success', 'La playlist a bien été supprimée.');
        } else {
            $this->addFlash('error', 'La playlist demandée ne peut pas être supprimée car elle contient une formation.');
        }
        return $this->redirectToRoute('playlists');
    }
    
    /**
     * @Route("/playlists/add", name="playlists.add")
     * @Route("/playlists/edit/{id}", name="playlists.edit")
     */
    
    // Gère la création et la modification des playlists
    #[Route('/playlists/form/{id?}', name: 'playlists.form')]
    public function form(Request $request, EntityManagerInterface $entityManager, $id = null): Response
    {
        $playlist = $id ? $this->playlistRepository->find($id) : new Playlist();

        $form = $this->createForm(PlaylistType::class, $playlist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($playlist);
            $entityManager->flush();
            $this->addFlash('success', 'La playlist a bien été enregistrée.');

            return $this->redirectToRoute('playlists');
        }

        return $this->render('pages/playlist_form.html.twig', [
            'form' => $form->createView(),
            'isEdit' => $id !== null,
            'formations' => $playlist->getFormations(),
            'playlistformations' => $playlist->getFormations(),
        ]);
    }
}
