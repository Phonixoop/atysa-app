<?php

namespace App\Http\Controllers\Logistic;

use App\Classes\functions;
use App\Models\Company;
use App\Models\Hotbox;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function hotboxUpdate(Request $request){
        $company = Company::find($request->id);
        $data = array();
        $data['hotboxes'] = $request->hotboxes;
        $company->update($data);
        return back();
    }
    public function all(){
        $company = Company::all();
        $hotboxes = Hotbox::all();
        return view('logistic.all')->with('all',$company)->with('hotboxes',$hotboxes);
    }
    public function report(Request $request){
        $company = Company::find($request->id);
    }
    public function profile(){
        return view('logistic.profile');
    }
    public function profileUpdate(Request $request){
        $function = new functions();
        $data = array();
        if($request->password && $request->password != null){
            $data['password'] = Hash::make($request->password);
        }
        $imgUrl = Auth::user()->avatar;
        if ($request->hasFile('file')) {
            $fileName = $function->uploadImage($request->file('file'), 'uploads/avatars',$imgUrl);
            $imgUrl = $fileName;
        }
        $data['avatar'] = $imgUrl;
        $user = User::find(Auth::id());
        $user->update($data);
        return back();
    }
}
