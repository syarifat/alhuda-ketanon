<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolProfileController extends Controller
{
    public function edit()
    {
        // Ambil data pertama, jika kosong buat baru
        $profile = SchoolProfile::first() ?? SchoolProfile::create();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = SchoolProfile::first();
        $data = $request->except(['_token', '_method', 'logo', 'principal_photo']);

        if ($request->hasFile('logo')) {
            if ($profile->logo && !in_array($profile->logo, ['logo.png', 'logo.jpg'])) {
                Storage::disk('r2')->delete($profile->logo);
            }
            $data['logo'] = $request->file('logo')->store('profiles', 'r2');
        }

        if ($request->hasFile('principal_photo')) {
            if ($profile->principal_photo && !in_array($profile->principal_photo, ['kepsek.jpg', 'kepsek.png'])) {
                Storage::disk('r2')->delete($profile->principal_photo);
            }
            $data['principal_photo'] = $request->file('principal_photo')->store('profiles', 'r2');
        }

        $profile->update($data);

        return redirect()->back()->with('success', 'Profil Sekolah berhasil diperbarui!');
    }
}