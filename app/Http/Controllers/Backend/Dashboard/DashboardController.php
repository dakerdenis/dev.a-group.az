<?php

namespace App\Http\Controllers\Backend\Dashboard;

use App\Http\Controllers\Backend\BackendController;
use App\Repository\ActivityRepositoryInterface;
use App\Repository\NavigationRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use stdClass;

class DashboardController extends BackendController
{

    public function __construct(
        public ActivityRepositoryInterface   $activityRepository,
        public NavigationRepositoryInterface $navigationRepository,
    )
    {

    }

    public function index(Request $request): View
    {
        $authLogs = $this->activityRepository->filterAndPaginate($request, 12, ['created_at', 'desc'], [['log_name', '=', 'auth']]);
        $contentLogs = $this->activityRepository->filterAndPaginate($request, 12, ['created_at', 'desc'], [['log_name', '=', 'content']]);
        return $this->render('backend.dashboard.index', compact('authLogs', 'contentLogs'));
    }

    public function sitemap(Request $request): View
    {
        $filename = 'sitemap.xml';
        $file = File::exists($filename);
        $fileData = null;
        if ($file) {
            $fileData = new stdClass();
            $fileData->name = $filename;
            $fileData->created_at = Carbon::createFromTimestamp(File::lastModified($filename))->diffForHumans();
        }

        return $this->render('backend.dashboard.sitemap', compact('fileData'));
    }

    public function generateSitemap(Request $request): RedirectResponse
    {
        $sitemap = App::make("sitemap");
        $structure = $this->navigationRepository->getNavigationMenuItemsFlat('main_navigation');
        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $sitemap->add(LaravelLocalization::getLocalizedURL($key, '/'), date('c', time()), '1.0', 'monthly', [], null);
        }
        foreach ($structure as $item) {
            if ($item->slug != '#') {
                foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
                    $sitemap->add(LaravelLocalization::getLocalizedURL($key, $item->slug), date('c', time()), $item->slug === '/' ? '1.0' : '0.9', 'monthly', [], null);
                }
            }
        }
        $sitemap->store('xml');

        return redirect()->route('backend.dashboard.generate_sitemap')->with('message', $message ?? ['type' => 'Success', 'message' => 'Sitemap regenerated successfully']);
    }

}
