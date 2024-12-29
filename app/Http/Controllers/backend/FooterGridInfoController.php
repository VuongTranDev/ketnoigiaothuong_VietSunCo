<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\FooterGridOne;
use App\Traits;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FooterGridInfoController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $footerInfo = FooterGridOne::first();

        return view('frontend.admin.footer.footer-grid-info.index', compact('footerInfo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'logo' => ['nullable', 'image'],
            'phone' => ['max:100'],
            'email' => ['max:100'],
            'address' => ['max:300'],
            'copyright' => ['max:200']
        ]);

        $footerInfo = FooterGridOne::find($id);

        if ($request->hasFile('logo')) {
            $imagePath = $this->updateImage($request, 'logo', 'frontend/image/logo', $footerInfo?->hinhanh);
            $footerInfo->logo = $imagePath;
        } else {
            $footerInfo->logo = $footerInfo->logo;
        }

        FooterGridOne::updateOrCreate(
            ['id' => $id],
            [
                'logo' => $footerInfo->logo,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'copyright' => $request->copyright
            ]
        );

        Cache::forget('footer_grid_one');

        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }
}
