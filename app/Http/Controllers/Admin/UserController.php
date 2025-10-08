<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        // Only admin can manage users
        if (!auth()->user()->isAdmin()) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Akses ditolak. Hanya Admin yang dapat mengelola user.'], 403);
            }
            return redirect()->route('admin.users.index')->with('error', 'Akses ditolak. Hanya Admin yang dapat mengelola user.');
        }

        $request->validate([
            'role' => 'required|in:user,admin,main_admin'
        ]);

        // Prevent promoting to main_admin if not main admin
        if ($request->role === 'main_admin' && !auth()->user()->isMainAdmin()) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Hanya Main Admin yang dapat promote user menjadi Main Admin.'], 403);
            }
            return redirect()->route('admin.users.index')->with('error', 'Hanya Main Admin yang dapat promote user menjadi Main Admin.');
        }

        // Prevent demoting main admin
        if ($user->isMainAdmin() && $request->role !== 'main_admin') {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Tidak dapat menurunkan Main Admin.'], 403);
            }
            return redirect()->route('admin.users.index')->with('error', 'Tidak dapat menurunkan Main Admin.');
        }

        // Prevent changing own role to non-admin
        if ($user->id === auth()->id() && !in_array($request->role, ['admin', 'main_admin'])) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Tidak dapat mengubah role sendiri menjadi user.'], 403);
            }
            return redirect()->route('admin.users.index')->with('error', 'Tidak dapat mengubah role sendiri menjadi user.');
        }

        $user->update([
            'role' => $request->role
        ]);

        $roleName = $user->getRoleDisplayName();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Role {$user->name} berhasil diubah menjadi {$roleName}."
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', "Role {$user->name} berhasil diubah menjadi {$roleName}.");
    }

    public function destroy(User $user)
    {
        // Only admin can delete users
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('admin.users.index')->with('error', 'Akses ditolak. Hanya Admin yang dapat menghapus user.');
        }

        // Prevent deleting main admin (unless by main admin)
        if ($user->isMainAdmin() && !auth()->user()->isMainAdmin()) {
            return redirect()->route('admin.users.index')->with('error', 'Hanya Main Admin yang dapat menghapus Main Admin.');
        }

        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', "User {$user->name} berhasil dihapus.");
    }
}
