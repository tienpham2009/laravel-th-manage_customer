<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CityController extends Controller
{
    function index()
    {
        $cities = City::all();
        return view('cities.list' , compact('cities'));
    }

    function create()
    {
        return view('cities.create');
    }

    function store(Request $request)
    {
        $city = new City();
        $city->name = $request->input('name');
        $city->save();
        Session::flash('success', 'Thêm mới tỉnh thành thành công');
        return redirect()->route('cities.index');
    }

    function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $city = City::findOrfail($id);
        return view('cities.edit' , compact('city'));
    }

    function update(Request $request , $id)
    {
        $city = City::findOrfail($id);
        $city->name = $request->input('name');
        $city->save();
        Session::flash('success', 'Cập nhật tỉnh thành thành công');
        return redirect()->route('cities.index');
    }

    function delete($id)
    {
        $city = City::findOrfail($id);
        DB::beginTransaction();
        try {
            $city->customers()->update(['city_id'=>null]);
            $city->delete();
            DB::commit();
        }catch (\Exception $exception)
        {
            DB::rollBack();
            echo $exception->getMessage();
        }
        Session::flash('success', 'Xóa tỉnh thành thành công');
        return redirect()->route('cities.index');

    }
}
