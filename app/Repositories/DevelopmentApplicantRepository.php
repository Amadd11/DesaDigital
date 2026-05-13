<?php

namespace App\Repositories;

use App\Interfaces\DevelopmentApplicantRepositoryInterface;
use App\Models\DevelopmentApplicant;
use Illuminate\Support\Facades\DB;

class DevelopmentApplicantRepository implements DevelopmentApplicantRepositoryInterface
{
    public function getAll(
        ?string $search,
        ?int $limit,
        bool $execute
    ) {
        $query = DevelopmentApplicant::query()->where(function ($query) use ($search) {
            if ($search) {
                $query->search($search);
            }
        });

        $query->orderBy('created_at', 'desc');

        if ($limit !== null) {
            $query->limit($limit);
        }

        if ($execute) {
            return $query->get();
        }

        return $query;
    }

    public function getAllPaginated(
        ?string $search,
        ?int $rowPerPage,
    ) {
        $query = $this->getAll(
            $search,
            null,
            false
        );

        return $query->paginate($rowPerPage);
    }

    public function getById(
        string $id
    ) {
        $query = DevelopmentApplicant::query()->where('id', $id);

        return $query->first();
    }

    public function create(
        array $data
    ) {
        DB::beginTransaction();

        try {
            $developmentApplicant = new DevelopmentApplicant();

            $developmentApplicant->development_id = $data['development_id'];
            $developmentApplicant->user_id = $data['user_id'];

            if (isset($data['status'])) {
                $developmentApplicant->status = $data['status'];
            }

            $developmentApplicant->save();

            DB::commit();

            return $developmentApplicant;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(
        string $id,
        array $data
    ) {
        DB::beginTransaction();

        try {
            $developmentApplicant = DevelopmentApplicant::query()->find($id);

            $developmentApplicant->development_id = $data['development_id'];
            $developmentApplicant->user_id = $data['user_id'];

            if (isset($data['status'])) {
                $developmentApplicant->status = $data['status'];
            }

            $developmentApplicant->save();

            DB::commit();

            return $developmentApplicant;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(
        string $id
    ) {
        DB::beginTransaction();

        try {
            $developmentApplicant = DevelopmentApplicant::query()->find($id);
            $developmentApplicant->delete();

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
