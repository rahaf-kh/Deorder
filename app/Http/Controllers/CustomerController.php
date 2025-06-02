<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class CustomerController extends Controller
{
  
    
    public function index()
    {
        try{
            // $users=User::whith
        } catch (\Throwable $th) {
            return $this->errorResponse("An error occurred while fetching data :", $th->getMessage());
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
    public function show(Customer $customer)
    {
        //
    }
    public function edit(Customer $customer)
    {
        //
    }
    public function update(Request $request, Customer $customer)
    {
        //
    }
    public function destroy(Customer $customer)
    {
        //
    }
}
