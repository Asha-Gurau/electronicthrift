<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('banner.index', compact('banners'));
    }

    public function create()
    {
        return view('banner.create');
    }


    // Store a new banner
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|numeric',
            'status' => 'required|string',
           'photopath' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Store the uploaded photo
        $photo = $request->file('photopath');
        $photoname = time() . '.' . $photo->extension();
        $photo->move(public_path('images/banners'), $photoname);
        $data['photopath'] = $photoname;

        Banner::create($data);
        return redirect()->route('banner.index')->with('success', 'Banner created successfully.');
    }

    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('banner.edit', compact('banner'));
    }

    // Update an existing banner
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|numeric',
            'status' => 'required|string',
            'photopath' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $banner = Banner::findOrFail($id);
        $data['photopath'] = $banner->photopath;

        if ($request->hasFile('photopath')) {
            // Store the new photo
            $photo = $request->file('photopath');
            $photoname = time() . '.' . $photo->extension();
            $photo->move(public_path('images/banners'), $photoname);
            $data['photopath'] = $photoname;

            // Delete the old photo
            $oldphoto = public_path('images/banners/' . $banner->photopath);
            if (file_exists($oldphoto)) {
                unlink($oldphoto);
            }
        }

        $banner->update($data);
        return redirect()->route('banner.index')->with('success', 'Banner updated successfully.');
    }



    public function destroy($id)
    {
        $banner = Banner::find($id);
        $photo = public_path('images/banners/' . $banner->photopath);
        if (file_exists($photo)) {
            unlink($photo);
        }
        $banner->delete();
        return redirect()->route('banner.index')->with('success', 'Banner deleted successfully');
    }

    public function showBanners()
    {
        $banners = Banner::where('status', 1) // Assuming 'status' indicates active banners
            ->orderBy('priority', 'asc') // Order banners by priority
            ->get();

        return view('welcome.banner', compact('banners'));
    }


}
