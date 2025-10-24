<?php

namespace App\Http\Controllers;

use App\Models\Attraction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminAttractionController extends Controller
{
    public function index()
    {
        $attractions = Attraction::latest()->paginate(10);
        return view('admin.attractions.index', compact('attractions'));
    }

    public function create()
    {
        $categories = ['Nature', 'Historical', 'Adventure', 'Cultural', 'Other'];
        return view('admin.attractions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name'               => 'required|string|max:255',
            'description'        => 'nullable|string',
            'category'           => 'nullable|string',
            'address'            => 'nullable|string',
            'best_time_to_visit' => 'nullable|string',
            'visit_duration'     => 'nullable|string',
            'entry_fee'          => 'nullable|numeric',
            'special_notes'      => 'nullable|string',
            'map_embed_url'      => 'nullable|string',
            'image'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('attractions', 'public');
        }

        Attraction::create($data);

        return redirect()->route('admin.attractions.index')
            ->with('status', 'Attraction created successfully!');
    }

    public function show(Attraction $attraction)
    {
        return view('admin.attractions.show', compact('attraction'));
    }

    public function edit(Attraction $attraction)
    {
        $categories = ['Nature', 'Historical', 'Adventure', 'Cultural', 'Other'];
        return view('admin.attractions.edit', compact('attraction', 'categories'));
    }

    public function update(Request $request, Attraction $attraction)
    {
       $validated = $request->validate([
    'name'              => 'required|string|max:255',
    'description'       => 'nullable|string',
    'category'          => 'nullable|string|max:100',
    'address'           => 'nullable|string|max:255',
    'best_time_to_visit'=> 'nullable|string|max:100',
    'visit_duration'    => 'nullable|string|max:100',
    'entry_fee'         => 'nullable|numeric|min:0',
    'special_notes'     => 'nullable|string',
    'map_embed_url'     => 'nullable|string',
    'image'             => 'nullable|image|mimes:jpg,jpeg,png|max:4096', 
]);

    if ($request->hasFile('image')) {
        if ($attraction->image_path) {
            Storage::disk('public')->delete($attraction->image_path);
        }
        $validated['image_path'] = $request->file('image')->store('attractions', 'public');
    }
            $attraction->update($validated);

        return redirect()->route('admin.attractions.index')->with('success', 'Attraction updated successfully!');
    }

    public function destroy(Attraction $attraction)
    {
        if ($attraction->image_path) {
            Storage::disk('public')->delete($attraction->image_path);
        }
        $attraction->delete();

        return redirect()->route('admin.attractions.index')->with('success', 'Attraction deleted successfully!');
    }
    public function dashboard()
    {
        // Get the currently authenticated admin
        $admin = Auth::user();

        return view('admin.dashboard', compact('admin'));
    }

    public function profile()
    {
        // You can use this later for the admin profile page
        $admin = Auth::user();

        return view('admin.profile', compact('admin'));
    }
}