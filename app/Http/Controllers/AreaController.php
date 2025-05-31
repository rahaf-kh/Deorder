<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function getAreas($city_id)
    {
        $areas = Area::where('city_id', $city_id)->get();
    }
    //  public function index(Request $request)
    // {
    //     if ($request->filled('search')) {
    //         $search = $request->input('search');

    //         $hotels = Hotel::where(function ($query) use ($search) {
    //             $query->where('name', 'like', "%$search%");
    //         })
    //             ->orWhereHas('city', function ($cityQuery) use ($search) {
    //                 $cityQuery->where('name', 'like', "%$search%");
    //             })
    //             ->paginate(2);
    //     } else {

    //         $hotels = Hotel::orderBy('id', 'desc')
    //             ->with('hotel_images')
    //             ->withAvg('rates', 'star')
    //             ->paginate(4);
    //         // dd($hotels->toArray());
    //     }
    //     return view('admins.hotels.index', ['hotels' => $hotels]);
    public function index(Request $request)
    {
        if ($request->filled('search')) {
            $search = $request->input('search');

            $areas = Area::where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })->orwhereHas('city', function ($CityQuery) use ($search) {
                $CityQuery->where('name', 'like', "%$search%");
            })->get();
        }
        else{
            $areas=Area::orderBy('name','asc')->with('city');
        }
        return response()->json($areas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Area $area)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        //
    }
}
