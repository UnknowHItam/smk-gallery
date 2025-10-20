<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PublicUser;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index()
    {
        $users = PublicUser::orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Delete a user
     */
    public function destroy($id)
    {
        try {
            $user = PublicUser::findOrFail($id);
            
            // Prevent deleting yourself (if admin is also a public user)
            if (auth()->guard('public')->check() && auth()->guard('public')->id() === $user->id) {
                return redirect()->back();
            }
            
            $user->delete();
            
            // Auto reload without notification
            return redirect()->route('admin.users.index');
                
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
}
