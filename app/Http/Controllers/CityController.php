<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Http\JsonResponse;


class CityController extends Controller
{
    use HasRoles;
    use GeneralTrait;
    public function index()
    {
        try {
            $cities = City::all()->orderBy('name', 'asc');
            if ($cities->isEmpty()) {
                return $this->requiredField('no cities avilable');
            } else {
                $cities = City::collection($cities);
                return $this->apiResponse($cities);
            }
        } catch (\Throwable $th) {
        }
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show(City $city)
    {
        //
    }
    public function edit(City $city)
    {
        //
    }
    public function update(Request $request, City $city)
    {
        //
    }
    public function destroy(City $city)
    {
        //
    }
}
