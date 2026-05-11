<?php

namespace App\Repositories;

use App\Interfaces\SocialAssistanceRepositoryInterface;
use App\Models\SocialAssistance;
use Illuminate\Support\Facades\DB;
use Override;

class SocialAssistanceRepository implements SocialAssistanceRepositoryInterface
{
    public function getAll(
        ?string $search,
        ?int $limit,
        bool $execute
    ) {
        $query = SocialAssistance::query()->where(function ($query) use ($search) {
            if ($search) {
                $query->search($search);
            }
        });

        if ($limit) {
            $query->take($limit);
        }

        if ($execute) {
            return $query->get();
        }

        return $query;
    }

    public function getAllPaginated(
        ?string $search,
        ?int $rowPerPage
    ) {
        $query = $this->getAll(
            $search,
            $rowPerPage,
            false
        );

        return $query->paginate($rowPerPage);
    }

    public function getById(
        string $id
    ) {
        $query = SocialAssistance::query()->where('id', $id);

        return $query->first();
    }

    public function create(
        array $data
    ) {
        DB::beginTransaction();
        try {
            $socialAssistance = new SocialAssistance;
            $socialAssistance->thumbnail = $data['thumbnail']->store('assets/social-assistance', 'public');
            $socialAssistance->name = $data['name'];
            $socialAssistance->provider = $data['provider'];
            $socialAssistance->category = $data['category'];
            $socialAssistance->amount = $data['amount'];
            $socialAssistance->description = $data['description'];
            $socialAssistance->is_available = $data['is_available'];
            $socialAssistance->save();

            DB::commit();

            return $socialAssistance;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update(
        string $id,
        array $data
    ) {
        DB::beginTransaction();
        try {
            $socialAssistance = SocialAssistance::query()->find($id);

            if (isset($data['thumbnail'])) {
                $socialAssistance->thumbnail = $data['thumbnail']->store('assets/social-assistance', 'public');
            }

            $socialAssistance->name = $data['name'];
            $socialAssistance->provider = $data['provider'];
            $socialAssistance->category = $data['category'];
            $socialAssistance->amount = $data['amount'];
            $socialAssistance->description = $data['description'];
            $socialAssistance->is_available = $data['is_available'];
            $socialAssistance->save();

            DB::commit();

            return $socialAssistance;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function delete(
        string $id
    ) {
        DB::beginTransaction();
        try {
            $socialAssistance = SocialAssistance::query()->find($id);
            $socialAssistance->delete();

            if (!$socialAssistance) {
                throw new \Exception('Data Bantuan Sosial Tidak Ditemukan');
            }

            DB::commit();

            return $socialAssistance;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
