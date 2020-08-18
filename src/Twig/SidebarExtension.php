<?php


namespace App\Twig;


use App\Repository\CategoryRepository;
use App\Repository\EventRepository;
use App\Repository\RecipeRepository;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class SidebarExtension extends AbstractExtension
{
    /**
     * @var RecipeRepository
     */
    private RecipeRepository $recipeRepository;
    /**
     * @var EventRepository
     */
    private EventRepository $eventRepository;
    /**
     * @var CategoryRepository
     */
    private CategoryRepository $categoryRepository;
    /**
     * @var Environment
     */
    private Environment $twig;

    public function __construct(RecipeRepository $recipeRepository,
                                EventRepository $eventRepository,
                                CategoryRepository $categoryRepository,
                                Environment $twig)
    {
        $this->recipeRepository = $recipeRepository;
        $this->eventRepository = $eventRepository;
        $this->categoryRepository = $categoryRepository;
        $this->twig = $twig;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('sidebar', [$this, 'getSidebar'], ['is_safe' => ['html']]),
            new TwigFunction('recipeForFooter', [$this, 'getRecipeForFooter'], ['is_safe' => ['html']]),
            new TwigFunction('adminSidebar', [$this, 'getAdminSidebar'], ['is_safe' => ['html']])
        ];
    }

    public function getSidebar(): string
    {
        $categories = $this->categoryRepository->findForSidebar();
        $recipes = $this->recipeRepository->findForSidebar();
        $events = $this->eventRepository->findForSidebar();

        return $this->twig->render('partials/sidebar.html.twig', [
            'categories' => $categories,
            'recipes' => $recipes,
            'events' => $events,
        ]);
    }

    public function getRecipeForFooter(): string
    {
        $recipes = $this->recipeRepository->findForSidebar();

        return $this->twig->render('partials/recipe_footer.html.twig', [
            'recipes' => $recipes,
        ]);

    }

    public function getAdminSidebar(?string $currentSubMenu): string
    {
        return $this->twig->render('admin/partials/admin_sidebar.html.twig', [
            'current_sub_menu' => $currentSubMenu,
        ]);
    }
}