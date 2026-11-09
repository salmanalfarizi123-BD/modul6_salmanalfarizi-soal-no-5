<?php

namespace App\Policies;
use App\Models\User;
use App\Models\Peminjaman;

class PeminjamanPolicy {
    public function view(User $user, Peminjaman $peminjaman): bool {
        if ($user->hasRole(['admin', 'petugas'])) return true;
        return $user->id === $peminjaman->user_id;
    }
}