<?php

namespace App\Http\Controllers\Backend\Files;

use App\Http\Controllers\Backend\BackendController;
use App\Repository\FileRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends BackendController
{
    public function __construct(private FileRepositoryInterface $fileRepository)
    {
    }

    public function uploadImage(Request $request): JsonResponse
    {
        $image = $request->file('file');
        [$filename, $extension] = $this->fileRepository->format($image, [['resize', 1600, 700]], 'uploads/rich_text');
        return response()->json(asset('storage/uploads/rich_text/') . '/' . $filename . '_1600x700.' . $extension);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadFancyImage(Request $request): JsonResponse
    {
        $crop = $request->post('crop');
        $max = ['original', null, null];
        if ($crop) {
            $max = ['resize', 1920, 1080];
        }
        $image = $request->file('file') ?? $request->get('select_image_file_input');
        $preview = $request->file('preview') ?? $request->get('select_image_preview_input');
        [$filename, $extension] = $this->fileRepository->format($preview ?? $image, [['resizeBack', null, 700]], 'uploads/rich_text');
        $images['min'] = asset('storage/uploads/rich_text/') . '/' . $filename . '_700xauto.' . $extension;
        $images['webp'] = asset('storage/uploads/rich_text/') . '/' . $filename . '_700xauto.' . 'webp';
        [$filename, $extension] = $this->fileRepository->format($image, [$max], 'uploads/rich_text');
        $images['max'] = asset('storage/uploads/rich_text/') . '/' . $filename . ($crop ? "_1920x1080" : '') . '.' . $extension;
        return response()->json($images);
    }
}
