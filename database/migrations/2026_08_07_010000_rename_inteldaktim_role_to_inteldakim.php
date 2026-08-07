<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const FINAL_ROLES = ['admin', 'verdokjal', 'tu', 'kepala_kantor', 'inteldakim', 'user'];

    private const LEGACY_ROLES = ['admin', 'verdokjal', 'tu', 'kepala_kantor', 'inteldaktim', 'user'];

    /**
     * Role "inteldaktim" (salah ketik) diubah menjadi "inteldakim".
     * Untuk MySQL, enum diperluas dulu agar nilai baru diterima, data di-update,
     * lalu nilai lama dibuang dari enum.
     */
    public function up(): void
    {
        foreach (['users', 'admins'] as $table) {
            if (DB::connection()->getDriverName() === 'sqlite') {
                $this->rebuildSqliteRoleTable($table, self::FINAL_ROLES, 'inteldaktim', 'inteldakim');

                continue;
            }

            $this->alterRoleEnum($table, array_merge(self::LEGACY_ROLES, ['inteldakim']));
            DB::table($table)->where('role', 'inteldaktim')->update(['role' => 'inteldakim']);
            $this->alterRoleEnum($table, self::FINAL_ROLES);
        }
    }

    public function down(): void
    {
        foreach (['users', 'admins'] as $table) {
            if (DB::connection()->getDriverName() === 'sqlite') {
                $this->rebuildSqliteRoleTable($table, self::LEGACY_ROLES, 'inteldakim', 'inteldaktim');

                continue;
            }

            $this->alterRoleEnum($table, array_merge(self::LEGACY_ROLES, ['inteldakim']));
            DB::table($table)->where('role', 'inteldakim')->update(['role' => 'inteldaktim']);
            $this->alterRoleEnum($table, self::LEGACY_ROLES);
        }
    }

    private function alterRoleEnum(string $table, array $roles): void
    {
        $rolesSql = "'".implode("','", $roles)."'";

        DB::statement("ALTER TABLE `{$table}` MODIFY `role` ENUM({$rolesSql}) NOT NULL DEFAULT 'user'");
    }

    /**
     * SQLite menyimpan kolom enum sebagai VARCHAR + CHECK constraint,
     * jadi tabel dibangun ulang dengan constraint baru sambil mengonversi data.
     */
    private function rebuildSqliteRoleTable(string $table, array $roles, string $from, string $to): void
    {
        $backup = $table.'_tmp_inteldakim';

        DB::statement('PRAGMA foreign_keys = OFF');

        Schema::create($backup, function (Blueprint $newTable) use ($table, $roles) {
            $newTable->id();
            $newTable->string('name');
            $newTable->string('username');
            $newTable->string('password');
            $newTable->string('jabatan')->nullable();
            $newTable->enum('role', $roles)->default('user');

            if ($table === 'users') {
                $newTable->rememberToken();
            }

            $newTable->timestamps();
        });

        $columns = ['id', 'name', 'username', 'password', 'jabatan', 'role'];

        if ($table === 'users') {
            $columns[] = 'remember_token';
        }

        $columns[] = 'created_at';
        $columns[] = 'updated_at';

        $select = [
            'id', 'name', 'username', 'password', 'jabatan',
            DB::raw("CASE WHEN role = '{$from}' THEN '{$to}' ELSE role END AS role"),
        ];

        if ($table === 'users') {
            $select[] = 'remember_token';
        }

        $select[] = 'created_at';
        $select[] = 'updated_at';

        DB::table($backup)->insertUsing($columns, DB::table($table)->select($select));

        Schema::drop($table);
        Schema::rename($backup, $table);

        DB::statement('PRAGMA foreign_keys = ON');
    }
};
