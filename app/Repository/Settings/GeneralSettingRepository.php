<?php

namespace App\Repository\Settings;

use App\Repository\FileRepositoryInterface;
use App\Repository\GeneralSettingRepositoryInterface;
use App\Settings\GeneralSettings;
use Spatie\LaravelSettings\Settings;
use Storage;

class GeneralSettingRepository extends SettingRepository implements GeneralSettingRepositoryInterface
{
    public function __construct(GeneralSettings $settings, private FileRepositoryInterface $fileRepository)
    {
        parent::__construct($settings);
    }

    public function update(array $data): Settings
    {
        if (isset($data['delete_images'])) {
            foreach ($data['delete_images'] as $type) {
                switch ($type) {
                    case 'logo': $this->settings->logo = null;
                    break;
                    case 'banner': $this->settings->banner = null;
                    break;
                }
            }
        }
        if (isset($data['logo_url'])) {
            $this->settings->logo = $data['logo_url'];
        }
        if (isset($data['logo'])) {
            if ($path = $data['logo']->storePubliclyAs('logo', 'logo.' . $data['logo']->extension(), ['disk' => 'do'])) {
                $this->settings->logo = Storage::disk('do')->url($path);
            }
        }
        if (isset($data['banner_url'])) {
            $this->settings->banner = $data['banner_url'];
        }
        if (isset($data['banner'])) {
            $path = 'banner/banner-background';
            if ($data['banner']->storePubliclyAs('banner', 'banner-background.' . $data['banner']->extension(), ['disk' => 'do']) && Storage::disk('do')->put($path . '.webp', $this->fileRepository->convertToWebp($data['banner']))) {
                $this->settings->banner = Storage::disk('do')->url($path);
            }
        }
        $this->settings->access_price = $data['access_price'] * 100;
        $this->settings->refresh_price = $data['refresh_price'] * 100;
        return $this->settings->save();
    }

    public function get(): Settings
    {
        return $this->settings;
    }
}
