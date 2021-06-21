<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $customers = Customer::paginate(1);
        $cities = City::all();
        return view('customer.list', compact('customers' , 'cities'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $cities = City::all();
        return view('customer.create' , compact('cities'));
    }

    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->dob = $request->input('dob');
        $customer->city_id = $request->input('city_id');
        $customer->save();

        Session::flash('success' , 'tao moi khach hang thanh cong');
        return redirect()->route('customers.index');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $cities = City::all();
        return view('customer.edit' , compact('customer' , 'cities'));
    }

    public function update(Request $request,$id)
    {
        $customer = Customer::findOrFail($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->dob = $request->dob;
        $customer->city_id = $request->input('city_id');

        $customer->save();
        //dung session de dua ra thong bao
        Session::flash('success', 'Cập nhật khách hàng thành công');
        //cap nhat xong quay ve trang danh sach khach hang
        return redirect()->route('customers.index');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        //dung session de dua ra thong bao
        Session::flash('success', 'Xóa khách hàng thành công');

        //xoa xong quay ve trang danh sach khach hang
        return redirect()->route('customers.index');
    }

    function filterByCity(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $idCity = $request->input('city_id');

        $cityFilter = City::findOrFail($idCity);

        $customers = Customer::where('city_id' , $cityFilter->id )->get();
        $totalCustomerFilter = count($customers);
        $cities = City::all();

        return view('customer.list' , compact('cityFilter' , 'customers' , 'totalCustomerFilter' , 'cities'));
    }

    function search(Request $request)
    {
        $keyword = $request->input('keyword');
        if (!$keyword){
            return redirect()->route('customers.index');
        }
        $customers = Customer::where('name' , 'LIKE' , '%'.$keyword.'%')->paginate(1);
        $cities = City::all();
        return view('customer.list' , compact('customers' , 'cities'));
    }
}
