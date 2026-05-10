<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-green-900 text-xl">Profil Sekolah</h2>
    </x-slot>

    @if(session('success'))
        <div class="mb-5 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm font-medium flex items-center gap-2">
            <span>✓</span> {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.school-profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')

        {{-- 1. Identitas Dasar --}}
        <div class="admin-card">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center text-base">🏫</div>
                <h3 class="font-black text-green-900">Identitas Dasar</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Nama Sekolah</label>
                    <x-text-input name="name" value="{{ old('name', $profile->name) }}" class="form-input" />
                </div>
                <div>
                    <label class="form-label">NPSN</label>
                    <x-text-input name="npsn" value="{{ old('npsn', $profile->npsn) }}" class="form-input" />
                </div>
                <div>
                    <label class="form-label">Slogan / Motto</label>
                    <x-text-input name="slogan" value="{{ old('slogan', $profile->slogan) }}" class="form-input" />
                </div>
                <div>
                    <label class="form-label">Akreditasi</label>
                    <x-text-input name="accreditation" value="{{ old('accreditation', $profile->accreditation) }}" class="form-input" />
                </div>
                <div class="md:col-span-2">
                    <label class="form-label">Upload Logo Baru <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <input type="file" name="logo" class="form-file">
                </div>
            </div>
        </div>

        {{-- 2. Narasi --}}
        <div class="admin-card">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-base">📖</div>
                <h3 class="font-black text-green-900">Konten Narasi</h3>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="form-label">Sejarah Singkat</label>
                    <textarea name="history" rows="4" class="form-textarea">{{ old('history', $profile->history) }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Visi</label>
                        <textarea name="vision" rows="3" class="form-textarea">{{ old('vision', $profile->vision) }}</textarea>
                    </div>
                    <div>
                        <label class="form-label">Misi</label>
                        <textarea name="mission" rows="3" class="form-textarea">{{ old('mission', $profile->mission) }}</textarea>
                    </div>
                </div>
                <div>
                    <label class="form-label">Tujuan &amp; Sasaran</label>
                    <textarea name="goals" rows="4" class="form-textarea">{{ old('goals', $profile->goals) }}</textarea>
                </div>
                <div>
                    <label class="form-label">Sambutan Kepala Sekolah</label>
                    <textarea name="principal_message" rows="5" class="form-textarea">{{ old('principal_message', $profile->principal_message) }}</textarea>
                </div>
                <div>
                    <label class="form-label">Foto Kepala Sekolah <span class="text-gray-400 font-normal">(opsional)</span></label>
                    @if($profile->principal_photo)
                        @php $photoUrl = Str::contains($profile->principal_photo, ['/']) ? Storage::url($profile->principal_photo) : asset($profile->principal_photo); @endphp
                        <img src="{{ $photoUrl }}" class="w-20 h-20 rounded-full object-cover mb-2 border-2 border-green-200 shadow" alt="Kepsek">
                    @endif
                    <input type="file" name="principal_photo" class="form-file">
                </div>
            </div>
        </div>

        {{-- 3. Kontak & Sosmed --}}
        <div class="admin-card">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-base">📡</div>
                <h3 class="font-black text-green-900">Kontak &amp; Media Sosial</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea name="address" rows="2" class="form-textarea">{{ old('address', $profile->address) }}</textarea>
                </div>
                <div>
                    <label class="form-label">Link Google Maps</label>
                    <textarea name="maps_link" rows="2" class="form-textarea">{{ old('maps_link', $profile->maps_link) }}</textarea>
                </div>
                <div>
                    <label class="form-label">Email Sekolah</label>
                    <x-text-input name="email" type="email" value="{{ old('email', $profile->email) }}" class="form-input" />
                </div>
                <div>
                    <label class="form-label">Telepon Kantor</label>
                    <x-text-input name="phone" value="{{ old('phone', $profile->phone) }}" class="form-input" />
                </div>
                <div class="md:col-span-2">
                    <label class="form-label">Nomor WhatsApp</label>
                    <x-text-input name="whatsapp" value="{{ old('whatsapp', $profile->whatsapp) }}" class="form-input" />
                </div>
                <div>
                    <label class="form-label">Link Instagram</label>
                    <x-text-input name="instagram" value="{{ old('instagram', $profile->instagram) }}" class="form-input" />
                </div>
                <div>
                    <label class="form-label">Link Facebook</label>
                    <x-text-input name="facebook" value="{{ old('facebook', $profile->facebook) }}" class="form-input" />
                </div>
                <div>
                    <label class="form-label">Link YouTube</label>
                    <x-text-input name="youtube" value="{{ old('youtube', $profile->youtube) }}" class="form-input" />
                </div>
                <div>
                    <label class="form-label">Link TikTok</label>
                    <x-text-input name="tiktok" value="{{ old('tiktok', $profile->tiktok) }}" class="form-input" />
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="admin-btn-primary px-8 py-3">
                💾 Simpan Semua Perubahan
            </button>
        </div>
    </form>

    <style>
        .admin-card { background:#fff; border:1px solid #dcfce7; border-radius:20px; padding:24px; box-shadow:0 2px 12px rgba(5,46,22,0.05); }
        .form-label { display:block; font-size:0.75rem; font-weight:700; color:#15803d; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:6px; }
        .form-input { display:block; width:100%; border:1px solid #bbf7d0; border-radius:12px; padding:10px 14px; font-size:0.875rem; color:#14532d; background:#f0fdf4; transition:border-color 0.2s, box-shadow 0.2s; }
        .form-input:focus { border-color:#22c55e; box-shadow:0 0 0 3px rgba(34,197,94,0.15); outline:none; }
        .form-textarea { display:block; width:100%; border:1px solid #bbf7d0; border-radius:12px; padding:10px 14px; font-size:0.875rem; color:#14532d; background:#f0fdf4; resize:vertical; transition:border-color 0.2s; }
        .form-textarea:focus { border-color:#22c55e; box-shadow:0 0 0 3px rgba(34,197,94,0.15); outline:none; }
        .form-file { display:block; width:100%; font-size:0.8rem; color:#15803d; padding:8px; border:1px dashed #86efac; border-radius:12px; background:#f0fdf4; cursor:pointer; }
        .admin-btn-primary { background:linear-gradient(135deg,#16a34a,#22c55e); color:#fff; font-size:0.875rem; font-weight:800; border-radius:9999px; box-shadow:0 4px 16px rgba(22,163,74,0.35); transition:all 0.2s; display:inline-block; border:none; cursor:pointer; }
        .admin-btn-primary:hover { box-shadow:0 6px 24px rgba(22,163,74,0.5); transform:translateY(-1px); }
    </style>
</x-app-layout>