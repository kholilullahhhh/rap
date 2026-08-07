<?php

namespace Tests\Feature;

use App\Models\Dokumen;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
        return Dokumen::create([
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
        $newDate = now()->addDay()->toDateString();

        $response = $this->put(route('umkm.update', $dokumen->id), [
            'tanggal_dokumen' => $newDate,
        ]);

        $response->assertRedirect(route('umkm.index'));

        $stored = Dokumen::find($dokumen->id);
        $this->assertEquals($dokumen->judul, $stored->judul);
        $this->assertEquals($newDate, $stored->tanggal_dokumen->toDateString());
    }

    public function test_update_with_new_file_derives_judul_from_filename(): void
    {
        Storage::fake('public');

        $owner = $this->makeUser('tu');
        $dokumen = $this->makeDokumen($owner);

        $response = $this->put(route('umkm.update', $dokumen->id), [
            'file_path' => UploadedFile::fake()->create('Surat_Baru.pdf', 100),
            'tanggal_dokumen' => $dokumen->tanggal_dokumen->toDateString(),
        ]);

        $response->assertRedirect(route('umkm.index'));
        $this->assertDatabaseHas('dokumens', [
            'id' => $dokumen->id,
            'judul' => 'Surat_Baru',
        ]);
    }

    public function test_store_derives_judul_from_uploaded_file(): void
    {
        Storage::fake('public');

        $this->makeUser('tu');

        $response = $this->post(route('umkm.store'), [
            'file_path' => UploadedFile::fake()->create('Surat_Permohonan_Pindah.pdf', 100),
            'tanggal_dokumen' => now()->toDateString(),
        ]);

        $response->assertRedirect(route('umkm.index'));
        $this->assertDatabaseHas('dokumens', ['judul' => 'Surat_Permohonan_Pindah']);
        $this->assertCount(1, Storage::disk('public')->files('dokumen'));
    }

    public function test_store_requires_file(): void
    {
        $this->makeUser('tu');

        $response = $this->from(route('umkm.create'))->post(route('umkm.store'), [
            'tanggal_dokumen' => now()->toDateString(),
        ]);

        $response->assertSessionHasErrors('file_path');
    }

    public function test_umkm_index_renders_for_roles(): void
    {
        foreach (['admin', 'kepala_kantor', 'tu', 'verdokjal', 'inteldakim'] as $role) {
            $user = $this->makeUser($role);
            $dokumen = $this->makeDokumen($user);

            $this->get(route('umkm.index'))
                ->assertOk()
                ->assertSee('delete-form')
                ->assertSee($dokumen->judul);
        }
    }
}
