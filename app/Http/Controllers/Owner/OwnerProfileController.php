<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class OwnerProfileController extends Controller
{
    //
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $id = Auth::user()->user_id;
        $user = DB::table('users as a')
            ->join('provinces as b', 'a.province', 'b.provCode')
            ->join('cities as c', 'a.city', 'c.citymunCode')
            ->join('barangays as d', 'a.barangay', 'd.brgyCode')
            ->where('user_id', $id)
            ->first();

        return view('owner.owner-profile')
            ->with('user', $user);
    }

    public function update(Request $req){
        $userid = Auth::user()->user_id;
        $user = User::find($userid);

        $user->username = $req->username;
        $user->lname = strtoupper($req->lname);
        $user->fname = strtoupper($req->fname);
        $user->mname = strtoupper($req->mname);
        $user->sex = strtoupper($req->sex);
        $user->contact_no = strtoupper($req->contact_no);
        $user->business_permit = strtoupper($req->business_permit);
        $user->province = strtoupper($req->province);
        $user->city = strtoupper($req->city);
        $user->barangay = strtoupper($req->barangay);
        $user->street = strtoupper($req->street);
        $user->save();

        return response()->json([
            'status' => 'updated'
        ], 201);
    }

}