<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\ProfileStoreRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\ProfileResource;
use App\Interfaces\ProfileRepositoryInterface;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private ProfileRepositoryInterface $profileRepository;

    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $profile = $this->profileRepository->get();

            if (!$profile) {
                return ResponseHelper::jsonResponse(false, 'Data Profil Tidak Ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Profil Berhasil Diambil', new ProfileResource($profile), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfileStoreRequest $request)
    {
        //
        $request = $request->validated();

        try {
            $profile = $this->profileRepository->create($request);

            return ResponseHelper::jsonResponse(true, 'Profil Berhasil Ditambahkan', new ProfileResource($profile), 201);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileUpdateRequest $request)
    {
        //
        $request = $request->validated();

        try {
            $profile = $this->profileRepository->update($request);

            return ResponseHelper::jsonResponse(true, 'Profil Berhasil Diupdate', new ProfileResource($profile), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }
}
