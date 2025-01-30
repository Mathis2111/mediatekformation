<?php
namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Formation;
use App\Form\FormationType;

/**
 * Controleur des formations
 *
 * @author emds
 */

class FormationsController extends AbstractController {

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
    
    function __construct(FormationRepository $formationRepository, CategorieRepository $categorieRepository, EntityManagerInterface $entityManager) {
        $this->formationRepository = $formationRepository;
        $this->categorieRepository= $categorieRepository;
        $this->entityManager = $entityManager;
    }
    
    private const FORMATIONS_TEMPLATE = "pages/formations.html.twig";
    private const FORMATION_TEMPLATE = "pages/formation.html.twig";
    
    // Affiche la liste des formations et des catégories
    #[Route('/formations', name: 'formations')]
    public function index(): Response{
        $formations = $this->formationRepository->findAll();
        $categories = $this->categorieRepository->findAll();
        return $this->render(self::FORMATIONS_TEMPLATE, [
            'formations' => $formations,
            'categories' => $categories
        ]);
    }

    // Trie les formations selon un champ, un ordre, et éventuellement une table donnée
    #[Route('/formations/tri/{champ}/{ordre}/{table}', name: 'formations.sort')]
    public function sort($champ, $ordre, $table=""): Response{
        $formations = $this->formationRepository->findAllOrderBy($champ, $ordre, $table);
        $categories = $this->categorieRepository->findAll();
        return $this->render(self::FORMATIONS_TEMPLATE, [
            'formations' => $formations,
            'categories' => $categories
        ]);
    }     

    // Recherche des formations qui contiennent une valeur spécifique dans un champ donné
    #[Route('/formations/recherche/{champ}/{table}', name: 'formations.findallcontain')]
    public function findAllContain($champ, Request $request, $table=""): Response{
        $valeur = $request->get("recherche");
        $formations = $this->formationRepository->findByContainValue($champ, $valeur, $table);
        $categories = $this->categorieRepository->findAll();
        return $this->render(self::FORMATIONS_TEMPLATE, [
            'formations' => $formations,
            'categories' => $categories,
            'valeur' => $valeur,
            'table' => $table
        ]);
    }  

    // Affiche les détails d'une formation spécifique
    #[Route('/formations/formation/{id}', name: 'formations.showone')]
    public function showOne($id): Response{
        $formation = $this->formationRepository->find($id);
        return $this->render(self::FORMATION_TEMPLATE, [
            'formation' => $formation
        ]);        
    }
    
    /**
     * Supprime une formation et la retire de sa playlist.
     *
     * @Route('/formations/delete/{id}', name: 'formations.delete', methods={"POST"})
     */
    
    #[Route('/formations/delete/{id}', name: 'formations.delete', methods: ['POST', 'GET'])]
    public function delete($id): Response
    {
        $formation = $this->formationRepository->find($id);

        if ($formation) {
            $this->entityManager->remove($formation);
            $this->entityManager->flush();
            $this->addFlash('success', 'La formation a bien été supprimée.');
        } else {
            $this->addFlash('error', 'La formation demandée n\'existe pas.');
        }

        // Redirection vers la page des formations
        return $this->redirectToRoute('formations');
    }
    
    /**
     * @Route("/formations/add", name="formations.add")
     * @Route("/formations/edit/{id}", name="formations.edit")
     */
    
    // Gère la création et la modification des formations
    #[Route('/formations/form/{id?}', name: 'formations.form')]
    public function form(Request $request, EntityManagerInterface $entityManager, $id = null): Response
    {
        $formation = $id ? $this->formationRepository->find($id) : new Formation();

        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($formation);
            $entityManager->flush();
            $this->addFlash('success', 'La formation a bien été enregistrée.');

            return $this->redirectToRoute('formations');
        }

        return $this->render('pages/formation_form.html.twig', [
            'form' => $form->createView(),
            'isEdit' => $id !== null,
        ]);
    }
}
