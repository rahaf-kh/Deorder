<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;


class CityController extends Controller
{

    use GeneralTrait;

    public function index()
    {
        try {
            $cities = City::orderBy('name', 'asc');
            if ($cities->isEmpty()) {
                return $this->requiredField('no cities avilable');
            } else {
                $cities = City::collection($cities);
                return $this->apiResponse($cities);
            }
        } catch (\Throwable $th) {
            return $this->apiResponse('An error occurred while fetching cities', $th->getMessage());
        }
    }
    public function findCity($search)
    {
        $city = City::where(function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })->get();
        return $city;
    }
    public function create()
    {
        try {
            $this->Authorize('create', City::class);
            $cities = City::all();
            return $this->successResponse([
                'cities' => $cities
            ], 'Data featched successfully');
        } catch (AuthorizationException $e) {
            return $this->unAuthorizeResponse();
        } catch (\Throwable $th) {
            return $this->errorResponse('An error accurred while fetching data', $th->getMessage());
        }
    }
    public function store(Request $request)
    {
        try {
            $this->authorize('create', City::class);
            $validate = Validator::make($request->all(), [
                'name' => 'required|string|max:25',
            ]);
            if ($validate->fails()) {
                return $this->requiredField($validate->errors()->first());
            } else {
                $city = City::create([
                    'name' => $request->name
                ]);
                return $this->successResponse($city, 'city created successfully');
            }
        } catch (\Throwable $th) {
            return $this->errorResponse('An errror occurred while creating a city', $th->getMessage());
        } catch (AuthorizationException $e) {
            return $this->unAuthorizeResponse();
        }
    }
    public function show(Request $request)
    {
        try {
            if ($request->filled('search')) {
                $search = $request->input('search');
                $city = $this->findCity($search);
                if ($city->isEmpty()) {
                    return $this->notFoundResponse('No results for your search');
                }
                return $this->apiResponse($city);
            } else {
                return $this->requiredField('Search keyword is required');
            }
        } catch (\Throwable $th) {
            return $this->errorResponse('An errror occurred', $th->getMessage());
        } catch (AuthorizationException $e) {
            return $this->unAuthorizeResponse();
        }
    }
    public function edit($name)
    {
        try {
            $city = $this->findCity($name);
            $this->authorize('update', $city);
            if ($city instanceof JsonResponse) {
                return $city;
            } else {
                return $this->successResponse($city, 'City founded successfully');
            }
        } catch (\Throwable $th) {
            return $this->errorResponse('An errror occurred', $th->getMessage());
        } catch (AuthorizationException $e) {
            return $this->unAuthorizeResponse();
        }
    }
    public function update(Request $request, City $city, $name)
    {
        try {
            $city = $this->findCity($name);
            if ($city->isEmpty()) {
                return $this->notFoundResponse('No results for your search');
            }
            if ($city instanceof JsonResponse) {
                return $city;
            } else {
                $this->authorize('update', $city);
                $validate = Validator::make(request()->all(), [
                    'name' => 'required|string|max:25',
                ]);
                if ($validate->fails()) {
                    return $this->requiredField($validate->errors()->first());
                } else {
                    $city->name = $request->name;
                    $city->save();
                    return $this->successResponse($city, 'City updated successfully');
                }
            }
        } catch (\Throwable $th) {
            return $this->errorResponse('An errror occurred', $th->getMessage());
        } catch (AuthorizationException $e) {
            return $this->unAuthorizeResponse();
        }
    }
    public function destroy($name)
    {
        try {
            $city = $this->findCity($name);
            if ($city instanceof JsonResponse) {
                return $city;
            } else {
                $this->authorize('delete', $city);
                $city->delete();
                return $this->successResponse('City deleted successfully');
            }
        } catch (AuthorizationException $e) {
            return $this->unAuthorizeResponse();
        } catch (\Throwable $th) {
            return $this->errorResponse('An unxpected error occurred', $th->getMessage());
        }
    }
}
