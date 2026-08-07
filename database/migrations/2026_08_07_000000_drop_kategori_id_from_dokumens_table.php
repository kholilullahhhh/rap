<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kategori dokumen sudah tidak dipakai lagi.
     * Nama/judul dokumen kini otomatis diambil dari nama file yang diupload.
     */
    public function up(): void
    {
        if (DB::connection()->getDriverName() === 'sqlite') {
            $this->rebuildSqliteTableWithoutKategori();

            return;
        }

        Schema::table('dokumens', function (Blueprint $table) {
            $table->dropConstrainedForeignId('kategori_id');
        });
    }

    public function down(): void
    {
        Schema::table('dokumens', function (Blueprint $table) {
            $table->foreignId('kategori_id')
                ->after('id')
                ->nullable()
                ->constrained('jenis_usahas')
                ->onDelete('cascade');
        });
    }

    /**
     * SQLite tidak mendukung DROP COLUMN untuk kolom yang dipakai foreign key,
     * jadi tabel dibuat ulang tanpa kolom kategori_id.
     */
    private function rebuildSqliteTableWithoutKategori(): void
    {
        $table = 'dokumens';
        $backup = 'dokumens_tmp_kategori';

        DB::statement('PRAGMA foreign_keys = OFF');

        Schema::create($backup, function (Blueprint $newTable) {
            $newTable->id();
            $newTable->foreignId('folder_id')->nullable();
            $newTable->foreignId('user_id')->constrained()->cascadeOnDelete();
            $newTable->string('judul');
            $newTable->string('file_path')->nullable();
            $newTable->date('tanggal_dokumen');
            $newTable->timestamps();
        });

        DB::table($backup)->insertUsing(
            ['id', 'folder_id', 'user_id', 'judul', 'file_path', 'tanggal_dokumen', 'created_at', 'updated_at'],
            DB::table($table)->select('id', 'folder_id', 'user_id', 'judul', 'file_path', 'tanggal_dokumen', 'created_at', 'updated_at')
        );

        Schema::drop($table);
        Schema::rename($backup, $table);

        DB::statement('PRAGMA foreign_keys = ON');
    }
};
