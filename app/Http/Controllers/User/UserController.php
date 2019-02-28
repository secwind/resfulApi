<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Model\Buyer;
use App\Model\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class UserController extends ApiController
{
    public function index()
    {
        $users = User::all();

        return $this->showAll($users);
        //return response()->json(['data' => $users], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $data['password'] = bcrypt($request->password);
        $data['email'] = $request->email;
        $data['verified'] = User::UNVERIFIED_USER;  // = '0'
        $data['verification_token'] = User::generateCode();
        $data['admin'] = User::REGULAR_USER; // = false
        
        $user = User::create($data);

        return $this->showOne($user, 201);
    }

    public function show(User $user)
    {
        // $users = User::findOrFail($id);
        return $this->showOne($user);
    }

    public function update(Request $request,User $user)
    {

        $data = request()->validate([
            'email' => 'unique:users,email,' .$user->id,
            'password' => 'min:6 | confirmed',
            'admin' => 'in:'.User::ADMIN_USER . ',' . User::REGULAR_USER,
            // 'admin' => 'in:wisanu,secwind'
        ]);

        if ($request->has('name')) {
            // $user->name = $request->name;
            $user->setName($request->name);
        }

        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = User::UNVERIFIED_USER;
            $user->email =  $request->email;
            $user->verification_token = User::generateCode();
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('admin')) {
            if(!$user->isVerified()) {
                return $this->errorResponse('Message Show Error Fied table.admin', 409);
            }
            $user->admin = $request->admin;
        }

        // dd(!$user->isDirty());
        if (!$user->isDirty()) { //func ว่าใน user มีค่าอะไรเปลี่ยนแปลงไปไหม
            return $this->errorResponse('กรุณาตรวจสอบ คุณไม่ได้มีการแก้ไข้ใดๆในข้อมูลนี้', 422);
        }

        $user->save();
        return $this->showOne( $user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return $this->showOne($user);
    }

    public function secwind ()
    {
        $buyers = Buyer::has('transactions')->get();
        $seller = Seller::has('products')->get();
        $buyer = User::all()->except(10)->random();
        return $this->showAll($seller);
    } // ------  / secwind 


    public function verify ($token)
    {
        $user = User::where('verification_token', $token)->firstOrFail(); 

        $user->verified = User::VERIFIED_USER;
        $user->verification_token = null;   

        $user->save();

        return $this->showMessage('The account has been verified succesfull');
    } // ------  / verify 
}
