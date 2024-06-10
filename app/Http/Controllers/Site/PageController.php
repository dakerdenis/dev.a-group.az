<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests\Site\ContactFormData;
use App\Mail\ContactForm;
use App\Models\Article;
use App\Models\Category;
use App\Models\Product;
use App\Models\StaticPage;
use App\Models\Vacancy;
use App\Repository\BlockRepositoryInterface;
use App\Repository\BranchRepositoryInterface;
use App\Repository\ContactRepositoryInterface;
use App\Repository\DepartmentRepositoryInterface;
use App\Repository\FaqRepositoryInterface;
use App\Repository\ManagementRepositoryInterface;
use App\Repository\ReportYearRepositoryInterface;
use App\Repository\SliderRepositoryInterface;
use App\Repository\VacancyRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class PageController extends SiteController
{

    public function __construct(
        private BlockRepositoryInterface $blockRepository,
        private SliderRepositoryInterface $sliderRepository,
        private ReportYearRepositoryInterface $reportYearRepository,
        private BranchRepositoryInterface $branchRepository,
        private ContactRepositoryInterface $contactRepository,
        private DepartmentRepositoryInterface $departmentRepository,
        private FaqRepositoryInterface $faqRepository,
        private VacancyRepositoryInterface $vacancyRepository
    )
    {

    }

    public function index(): View
    {
        $slides = $this->sliderRepository->getSlides('main_slider');
        $blocks = $this->blockRepository->getPageBlocks('main_page');

        return $this->render('site.index', compact('slides', 'blocks'));
    }

    public function redirectNoLocale()
    {
        return redirect()->route('index');
    }

    public function article(Category $category, Article $article)
    {
        if (!$article->active) {
            abort(404);
        }

        return $this->render('site.article', compact('article', 'category'));
    }

    public function category(Request $request, Category $category)
    {
        if (!$category->active) {
            abort(404);
        }
        return match ($category->taxonomy) {
            Category::BLOG, Category::SPECIAL_OFFERS => $this->blog($category, $request),
            Category::MANAGEMENT                     => $this->management($category),
            Category::REPORTS                        => $this->reports($category),
            Category::BRANCHES                       => $this->branches($category),
            Category::PRODUCTS                       => $this->products($category),
            Category::VACANCIES                      => $this->vacancies($category),
            Category::FAQ                            => $this->faqs($category),
            default                                  => abort(404),
        };
    }

    public function faqs(Category $category)
    {
        $faqs = $this->faqRepository->allActiveNested();

        return $this->render('site.faqs', compact('faqs', 'category'));
    }

    public function blog(Category $category, Request $request)
    {
        $articles = $category->articles()->where('active', true);
        $hasArchive = false;
        $archiveShowed = $request->archive;
        if ($category->taxonomy === Category::BLOG) {
            $articles = $articles->orderByDesc('date')->paginate();
        } else {
            $articles = $articles->when($request->archive, fn(Builder $query) => $query->where('archive', true), fn(Builder $query) => $query->where('archive', false))->orderBy('_lft')->get();
            $hasArchive = $category->articles()->where('archive', true)->where('active', true)->count() > 0;
        }

        return $this->render('site.blog', compact('articles', 'category', 'hasArchive', 'archiveShowed'));
    }

    public function management(Category $category)
    {
        $managementRepository = app(ManagementRepositoryInterface::class);
        $managers = $managementRepository->allActiveNested();

        return $this->render('site.management', compact('managers', 'category'));
    }

    public function reports(Category $category)
    {
        $years = $this->reportYearRepository->allActiveOrderedBy(['year', 'desc']);

        return $this->render('site.reports', compact('years', 'category'));
    }

    public function products(Category $category)
    {
        return $this->render('site.products', compact('category'));
    }

    public function product(Category $category, Product $product)
    {
        if (!$product->active) {
            abort(404);
        }

        return $this->render('site.product', compact('product', 'category'));
    }

    public function vacancy(Category $category, Vacancy $vacancy)
    {
        return $this->render('site.vacancy', compact('vacancy', 'category'));
    }

    public function staticPage(StaticPage $staticPage)
    {
        if (!$staticPage->active) {
            abort(404);
        }

        return $this->render('site.static-page', compact('staticPage'));
    }

    public function branches(Category $category)
    {
        $branches = $this->branchRepository->allActiveNested();

        return $this->render('site.branches', compact('branches', 'category'));
    }

    public function contacts()
    {
        $contacts = $this->contactRepository->find(1);
        $departments = $this->departmentRepository->allActiveNested();

        return $this->render('site.contacts', compact('contacts', 'departments'));
    }

    public function sendContactForm(ContactFormData $request)
    {
        $data = $request->validated();
        $department = $this->departmentRepository->find($data['department_id']);
        $data['department'] = $department->title ?? 'empty';
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify',
            ['secret' => '6LeMjs0oAAAAALpzfOfrjFoD3Nj3kYoRBeWwcdeu', 'response' => $request->post('g-recaptcha-response')]);
        if ($response->json()['success'] ?? true) {
            Mail::to(['samir@mediadesign.az'])->send(new ContactForm($data));
        }
    }

    public function submitProductForm(Product $product, Request $request)
    {
        try {
            $product->getForm()->handle($request);
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (\Throwable $throwable) {
            Log::error($throwable->getMessage(), ['exception' => $throwable]);
        }

        return response()->json(['message' => 'success']);
    }

    public function vacancies(Category $category)
    {
        $vacancies = $this->vacancyRepository->getModel()->where('active', true)->orderByDesc('date')->get();

        return $this->render('site.vacancies', compact('vacancies', 'category'));
    }
}
