<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function adminDashboard()
    {

        return view('admin.dashboard');
    } // End Method

    public function adminDestroy(Request $request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    } // end method

    public function adminProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);

        return view('admin.profile-view', compact('adminData'));
    } // end method

    public function adminProfileStore(Request $request)
    {

        $id = Auth::user()->id;
        $updateData = User::find($id);

        $updateData->name = $request->name;
        $updateData->email = $request->email;
        $updateData->phone = $request->phone;
        $updateData->address = $request->address;
        

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images'. $updateData->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);

            $updateData['photo'] = $filename;
        }

        $updateData->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // end method

    public function adminChangePassword()
    {

        return view('admin.methods.change-password');
    } // end method

    public function adminUpdatePassword(Request $request)
    {
        // validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match the old password
        if(!Hash::check($request->old_password, auth::user()->password)){
            return back()->with("error", "las contraseñas no coinciden o contraseña actual incorrecta");
        };

        // Update the new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);
    
        return back()->with("status", "Contraseña actualizada Correctamente!");
    
    } // end method


    //* Admin users seccion
    public function adminRegister()
    {
        // registrar un admin nuevo
        return view('admin.users.register-new-user');
    } // End Method

    //* Admin users seccion
    public function adminRegisterStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin'
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::dashboardDinamic('admin'));
    } // End Method
}
