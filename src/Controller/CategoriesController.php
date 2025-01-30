<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\FormationRepository;
use App\Entity\Categorie;
use App\Form\CategorieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of CategoriesController
 *
 * @author Mathis
 */

class CategoriesController extends AbstractController{
    
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
    
    function __construct( 
            CategorieRepository $categorieRepository,
            FormationRepository $formationRespository,
            EntityManagerInterface $entityManager) {
        $this->categorieRepository = $categorieRepository;
        $this->formationRepository = $formationRespository;
        $this->entityManager = $entityManager;
    }
    
    private const CATEGORIES_TEMPLATE = "pages/categories.html.twig";
    
    /**
     * @Route("/categories", name="categories")
     * @return Response
     */
    
    // Affiche la liste des catégories et des formations disponibles
    #[Route('/categories', name: 'categories')]
    public function index(): Response{
        $formations = $this->formationRepository->findAll();
        $categories = $this->categorieRepository->findAll();
        return $this->render(self::CATEGORIES_TEMPLATE, [
            'formations' => $formations,
            'categories' => $categories
        ]);
    }


    // Trie les formations selon un champ spécifique et un ordre donné
    #[Route('/categories/tri/{champ}/{ordre}/{table}', name: 'categories.sort')]
    public function sort($champ, $ordre, $table=""): Response{
        $categories = $this->categorieRepository->findAll();
        $formations = $this->formationRepository->findAllOrderBy($champ, $ordre, $table);
        return $this->render(self::CATEGORIES_TEMPLATE, [
            'categories' => $categories,
            'formations' => $formations
        ]);
    }     

    // Recherche les formations qui contiennent une valeur spécifique dans un champ donné
    #[Route('/categories/recherche/{champ}/{table}', name: 'categories.findallcontain')]
    public function findAllContain($champ, Request $request, $table=""): Response{
        $valeur = $request->get("recherche");
        $formations = $this->formationRepository->findByContainValue($champ, $valeur, $table);
        $categories = $this->categorieRepository->findAll();
        return $this->render(self::CATEGORIES_TEMPLATE, [
            'formations' => $formations,
            'categories' => $categories,
            'valeur' => $valeur,
            'table' => $table
        ]);
    }  
    
    /**
     * Supprime une catégorie spécifique si elle ne contient pas de formations
     *
     * @Route('/categories/delete/{id}', name: 'categories.delete', methods={"POST, GET"})
     */
    
    #[Route('/categories/delete/{id}', name: 'categories.delete', methods: ['POST', 'GET'])]
    public function delete($id): Response
    {
        $categorie = $this->categorieRepository->find($id);

        if (!$categorie) {
            $this->addFlash('error', 'La catégorie demandée n\'existe pas.');
            return $this->redirectToRoute('categories');
        }

        // Vérifier si la catégorie contient des formations
        if (!$categorie->getFormations()->isEmpty()) {
            $this->addFlash('error', 'Impossible de supprimer cette catégorie car elle contient des formations.');
            return $this->redirectToRoute('categories');
        }

        // Suppression de la catégorie si elle ne contient pas de formations
        $this->entityManager->remove($categorie);
        $this->entityManager->flush();
        $this->addFlash('success', 'La catégorie a bien été supprimée.');

        return $this->redirectToRoute('categories');
    }

    
    /**
     * @Route("/categories/add", name="categories.add")
     * @Route("/categories/edit/{id}", name="categories.edit")
     */
    
    // Gère la création et la modification des catégories
        #[Route('/categories/form/{id?}', name: 'categories.form')]
        public function form(Request $request, EntityManagerInterface $entityManager, $id = null): Response
        {
            // Récupérer la catégorie existante ou en créer une nouvelle
            $categorie = $id ? $this->categorieRepository->find($id) : new Categorie();

            // Création du formulaire
            $form = $this->createForm(CategorieType::class, $categorie);
            $form->handleRequest($request);

            // Traitement du formulaire
            if ($form->isSubmitted() && $form->isValid()) {
                // Vérifier si une catégorie avec le même nom existe déjà
                $existingCategorie = $this->categorieRepository->findOneBy(['name' => $categorie->getName()]);

                if ($existingCategorie && $existingCategorie->getId() !== $categorie->getId()) {
                    $this->addFlash('error', 'Ce nom de catégorie existe déjà.');
                    return $this->render('pages/categorie_form.html.twig', [
                        'form' => $form->createView()
                    ]);
                } else {
                    // Enregistrement en base de données
                    $entityManager->persist($categorie);
                    $entityManager->flush();

                    $this->addFlash('success', 'La catégorie a bien été enregistrée.');

                    return $this->redirectToRoute('categories'); 
                }
            }

            return $this->render('pages/categorie_form.html.twig', [
                'form' => $form->createView()
            ]);
        }

}
