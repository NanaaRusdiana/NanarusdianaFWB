<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Users (Pengguna)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'dosen', 'mahasiswa'])->default('mahasiswa');
            $table->string('nim')->nullable()->comment('Hanya untuk mahasiswa');
            $table->string('nidn')->nullable()->comment('Hanya untuk dosen');
            $table->string('prodi')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. Skripsi (Tugas Akhir)
        Schema::create('skripsis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('abstrak');
            $table->foreignId('mahasiswa_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('pembimbing1_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('pembimbing2_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('tahun', 4);
            $table->string('file_path');
            $table->unsignedBigInteger('file_size');
            $table->string('file_type', 50);
            $table->enum('status', ['draft', 'pending', 'approved', 'rejected'])->default('draft');
            $table->text('catatan_reviewer')->nullable();
            $table->timestamps();
        });

        // 3. Kategori
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // 4. Notifikasi
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->string('url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Urutan drop table harus dibalik dari pembuatan
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('kategoris');
        Schema::dropIfExists('skripsis');
        Schema::dropIfExists('users');
    }
};