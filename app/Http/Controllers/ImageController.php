<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function show(Image $image): JsonResponse
    {
        return $this->response($image->toResource()->toArray(request()));
    }

    public function store(StoreImageRequest $request): JsonResponse
    {
        $image = Image::create([
            'path' => $request->file('image')->store('images', 'public'),
        ]);

        return $this->success(
            message: "Image uploaded successfully",
            data: $image->toResource()->toArray(request())
        );
    }
}
