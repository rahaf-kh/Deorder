<?php

namespace App\Http\Controllers;

use App\Http\Traits\GeneralTrait;
use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Access\AuthorizationException;

class AreaController extends Controller
{
    use GeneralTrait;


    public function index()
    {
        try {
            $areas = Area::with('city')->orderBy('name', 'asc')->get();
            if ($areas->isEmpty()) {
                return $this->requiredField('No areas avilable right now');
            } else {
                $areas = Area::collection($areas);
                return $this->apiResponse($areas);
            }
        } catch (\Throwable $th) {
            return $this->errorResponse("An error occurred while fetching areas :", $th->getMessage());
        }
    }
    public function findArea($search)
    {
        $area = Area::where(function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })->orWhereHas('city', function ($CityQuery) use ($search) {
            $CityQuery->where('name', 'like', "%$search%");
        })->get();

        return $area;
    }
    public function create()
    {
        try {
            $this->authorize('create', Area::class);
            $cities = City::all();
            $areas = Area::all();
            return $this->successResponse([
                'cities' => $cities,
                'areas' => $areas
            ], 'Data fetched successfully');
        } catch (AuthorizationException $e) {
            return $this->unAuthorizeResponse();
        } catch (\Throwable $th) {
            return $this->errorResponse("An error occurred while fetching data :", $th->getMessage());
        }
    }
    public function store(Request $request)
    {
        try {
            $this->authorize('create', Area::class);
            $validate = Validator::make($request->all(), [
                'city_id' => 'required|exists:cities,id|integer',
                'name' => 'required|string'
            ]);
            if ($validate->fails()) {
                return $this->requiredField($validate->errors()->first());
            } else {
                $area = Area::create([
                    'city_id' => $request->city_id,
                    'name' => $request->name,
                ]);
                return $this->successResponce($area, 'Area created successfully');
            }
        } catch (AuthorizationException $e) {
            return $this->unAuthorizeResponse();
        } catch (\Throwable $th) {
            return $this->errorResponse("An error occurred while Storing data :", $th->getMessage());
        }
    }
    public function show(Request $request)
    {
        try {
            if ($request->filled('search')) {
                $search = $request->input('search');
                $areas = $this->findArea($search);
                if ($areas->isEmpty()) {
                    return $this->notFoundResponse('No results found for your search');
                }
                return $this->apiResponse($areas);
            } else {
                return $this->requiredField('Search keyword is required');
            }
        } catch (\Throwable $th) {
            return $this->errorResponse('An unexpected error occurred', $th->getMessage());
        }
    }
    public function edit($name)
    {
        try {
            $area = $this->findArea($name);
            $this->authorize('update', $area);
            if ($area instanceof JsonResponse) {
                return $area;
            } else {
                return $this->successResponse($area, 'Area founded successfully');
            }
        } catch (AuthorizationException $e) {
            return $this->unAuthorizeResponse();
        } catch (\Throwable $th) {
            return $this->errorResponse('An unxpected error occurred', $th->getMessage());
        }
    }
    public function update(Request $request, Area $area, $name)
    {
        try {

            $area = $this->findArea($name);
            if (!$area) {
                return $this->notFoundResponse('Area not found');
            }
            if ($area instanceof JsonResponse) {
                return $area;
            } else {
                $this->authorize('update', $area);
                $validate = Validator::make(request()->all(), [
                    'city_id' => 'required|exists:cities,id|integer',
                    'name' => 'required|string'
                ]);
                if ($validate->fails()) {
                    return $this->requiredField($validate->errors()->first());
                } else {
                    $area->city_id = $request->city_id;
                    $area->name = $request->name;
                    $area->save();
                    return $this->successResponce($area, 'Area updated successfully');
                }
            }
        } catch (AuthorizationException $e) {
            return $this->unAuthorizeResponse();
        } catch (\Throwable $th) {
            return $this->errorResponse('An unxpected error occurred', $th->getMessage());
        }
    }
    public function destroy($name)
    {
        try {

            $area = $this->findArea($name);

            if ($area instanceof JsonResponse) {
                return $area;
            } else {
                $this->authorize('delete', $area);
                $area->delete();
                return $this->successResponse('Area deleted successfully');
            }
        } catch (AuthorizationException $e) {
            return $this->unAuthorizeResponse();
        } catch (\Throwable $th) {
            return $this->errorResponse('An unxpected error occurred', $th->getMessage());
        }
    }
}
