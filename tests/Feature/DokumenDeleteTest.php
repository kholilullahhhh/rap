<?php

namespace Tests\Feature;

use App\Models\Dokumen;
use App\Models\JenisUsaha;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DokumenDeleteTest extends TestCase
{
    use DatabaseTransactions;

    private function makeUser(string $role): User
    {
        $user = User::create([
            'name' => 'User '.$role.' '.uniqid(),
            'username' => 'user_'.$role.'_'.uniqid(),
            'password' => Hash::make('password'),
            'role' => $role,
        ]);

        auth()->login($user);
        session([
            'cek' => true,
            'user_id' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
            'role' => $user->role,
        ]);

        return $user;
    }

    private function makeDokumen(User $owner): Dokumen
    {
        $kategori = JenisUsaha::create(['nama_jenis' => 'Kategori '.uniqid()]);

        return Dokumen::create([
            'kategori_id' => $kategori->id,
            'user_id' => $owner->id,
            'judul' => 'Dokumen Tes '.uniqid(),
            'file_path' => null,
            'tanggal_dokumen' => now()->toDateString(),
        ]);
    }

    public function test_admin_can_delete_any_document(): void
    {
        $admin = $this->makeUser('admin');
        $owner = User::create([
            'name' => 'Pemilik',
            'username' => 'pemilik_'.uniqid(),
            'password' => Hash::make('password'),
            'role' => 'tu',
        ]);
        $dokumen = $this->makeDokumen($owner);

        $response = $this->deleteJson(route('umkm.hapus', $dokumen->id));

        $response->assertOk()
            ->assertJson(['success' => true]);
        $this->assertDatabaseMissing('dokumens', ['id' => $dokumen->id]);
    }

    public function test_owner_can_delete_own_document(): void
    {
        $owner = $this->makeUser('tu');
        $dokumen = $this->makeDokumen($owner);

        $response = $this->deleteJson(route('umkm.hapus', $dokumen->id));

        $response->assertOk()
            ->assertJson(['success' => true]);
        $this->assertDatabaseMissing('dokumens', ['id' => $dokumen->id]);
    }

    public function test_non_owner_cannot_delete_document(): void
    {
        $intruder = $this->makeUser('tu');
        $owner = User::create([
            'name' => 'Pemilik',
            'username' => 'pemilik_'.uniqid(),
            'password' => Hash::make('password'),
            'role' => 'tu',
        ]);
        $dokumen = $this->makeDokumen($owner);

        $response = $this->deleteJson(route('umkm.hapus', $dokumen->id));

        $response->assertStatus(403)
            ->assertJson(['success' => false]);
        $this->assertDatabaseHas('dokumens', ['id' => $dokumen->id]);
    }

    public function test_delete_without_ajax_redirects_with_flash(): void
    {
        $owner = $this->makeUser('tu');
        $dokumen = $this->makeDokumen($owner);

        $response = $this->delete(route('umkm.hapus', $dokumen->id));

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Dokumen berhasil dihapus');
        $this->assertDatabaseMissing('dokumens', ['id' => $dokumen->id]);
    }

    public function test_owner_can_update_document(): void
    {
        $owner = $this->makeUser('tu');
        $dokumen = $this->makeDokumen($owner);

        $response = $this->put(route('umkm.update', $dokumen->id), [
            'kategori_id' => $dokumen->kategori_id,
            'judul' => 'Judul Diubah',
            'tanggal_dokumen' => now()->toDateString(),
        ]);

        $response->assertRedirect(route('umkm.index'));
        $this->assertDatabaseHas('dokumens', ['id' => $dokumen->id, 'judul' => 'Judul Diubah']);
    }

    public function test_umkm_index_renders_for_roles(): void
    {
        foreach (['admin', 'kepala_kantor', 'tu', 'verdokjal', 'inteldaktim'] as $role) {
            $user = $this->makeUser($role);
            $dokumen = $this->makeDokumen($user);

            $this->get(route('umkm.index'))
                ->assertOk()
                ->assertSee('delete-form')
                ->assertSee($dokumen->judul);
        }
    }
}
