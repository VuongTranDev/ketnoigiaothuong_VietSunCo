<?php

namespace App\Http\Controllers\backend;

use App\DataTables\FooterGridThreeDataTables;
use App\Http\Controllers\Controller;
use App\Models\FooterGridThree;
use App\Models\FooterTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FooterGridThreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterGridThreeDataTables $dataTable)
    {
        $footerTitle = FooterTitle::first();
        return $dataTable->render('frontend.admin.footer.footer-grid-three.index', compact('footerTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.admin.footer.footer-grid-three.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'url' => ['required', 'url'],
            'status' => ['required']
        ]);

        $footer = new FooterGridThree();
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();

        Cache::forget('footer_grid_three');

        // toastr('Created Successfully!', 'success', 'success');

        return redirect()->route('admin.footer-grid-three.index')->with('success', 'Thêm thành công!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $footer = FooterGridThree::findOrFail($id);
        return view('frontend.admin.footer.footer-grid-three.edit', compact('footer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'url' => ['required', 'url'],
            'status' => ['required']
        ]);

        $footer = FooterGridThree::findOrFail($id);
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();

        Cache::forget('footer_grid_three');

        return redirect()->route('admin.footer-grid-three.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footer = FooterGridThree::findOrFail($id);
        $footer->delete();
        Cache::forget('footer_grid_three');

        return response(['status' => 'success', 'message' => 'Xoá thành công!']);
    }

    public function changeStatus(Request $request)
    {
        $footer = FooterGridThree::findOrFail($request->id);
        $footer->status = $request->status == 'true' ? 1 : 0;
        $footer->save();
        Cache::forget('footer_grid_three');

        return response()->json(['message' => 'Trạng thái cập nhật thành công!']);
    }

    public function changeTitle(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:200']
        ]);

        FooterTitle::updateOrCreate(
            ['id' => 1],
            ['footer_grid_three_title' => $request->title]
        );

        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }
}
