<?php

namespace App\Http\Controllers;

use App\Models\Footprint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class FootprintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('welcome2', [
            'footprints' => Footprint::orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Footprint $footprint): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Footprint $footprint): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Footprint $footprint): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Footprint $footprint): RedirectResponse
    {
        $footprint->delete();

        return redirect()->route('footprint.index');
    }
}
