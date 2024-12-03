<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::where('status', 'Active')->get();
        return view('admin.profile.index', compact('profiles'));
    }

    public function create()
    {
        return view('admin.profile.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'nullable|in:active,inactive',
        ]);

        Profile::create([
            'item' => $validated['item'],
            'deskripsi' => $validated['deskripsi'],
            'status' => "Active",
        ]);

        return redirect()->route('admin.profiles.index')->with('success', 'Profil berhasil ditambahkan.');
    }

    public function detailProfiles(Request $request)
    {
        $profile_id = $request->input('profile_id');

        $profile = Profile::find($profile_id);

        if (!$profile) {
            return redirect()->route('admin.profiles.index')->withErrors(['error' => 'Profile tidak ditemukan']);
        }

        return view('admin.profile.detail', compact('profile'));
    }

    public function edit(Request $request)
    {
        $profile = Profile::find($request->profile_id);

        if (!$profile) {
            return redirect()->back()->withErrors(['error' => 'Profile tidak ditemukan']);
        }

        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request, $profile_id)
    {

        $request->validate([
            'profile_description' => 'required|string',
            'profile_item' => 'required|string|max:255',
        ]);

        $profile = Profile::findOrFail($profile_id);

        $profile->item = $request->profile_item;
        $profile->deskripsi = $request->profile_description;
        $profile->updated_at = now();

        $profile->save();

        return redirect()->route('admin.profiles.index')->with('success', 'Profile berhasil diperbarui');
    }

    public function delete(Request $request)
    {
        // Menonaktifkan profil (soft delete)
        DB::table('profiles')
            ->where('profile_id', $request->profile_id)
            ->update(['status' => 'Inactive']);

        return redirect()->route('admin.profiles.index')->with('success', 'Profil berhasil dihapus');
    }
}
