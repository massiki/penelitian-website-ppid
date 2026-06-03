<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PenggunaController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $request->validate([
            'nip' => ['required'],
            'password' => ['required'],
            'captcha' => 'required|captcha',
        ]);

        $credentials = $request->only(['nip', 'password']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
 
        return back()->withErrors([
            'nip' => 'NIP atau password anda salah',
        ])->onlyInput('nip');
    }

    public function logout(Request $request) : RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest();
        if (request('cari')) {
            $users = $users->where('name', 'like', '%' . request('cari') . '%');
        } else {
            $users = $users->paginate(5);
        }
        return view('admin.menuUtama.pengguna.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menuUtama.pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'nip' => 'required|numeric|unique:users,nip|digits:13',
            'role' => 'required|in:admin,operator',
            'password' => 'required|min:8',
        ], $this->feedback_validate);

        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect('/pengguna')->with('success', 'Pengguna baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $user)
    {
        return view('admin.menuUtama.pengguna.edit', [
            'item' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nip' => 'required|numeric|digits:13|unique:users,nip,' . $user->id,
            'role' => 'required|in:admin,operator'
        ], $this->feedback_validate);

        $user->update(array_merge($data, ['password' => $user->password]));

        return redirect('/pengguna')->with('success', 'Pengguna baru berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/pengguna')->with('success', 'Pengguna berhasil dihapus');
    }

    public function password(User $user)
    {
        return view('admin.menuUtama.pengguna.password', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|min:8'
        ], $this->feedback_validate);

        $user->update(['password' => Hash::make($request->password)]);

        return redirect('/pengguna')->with('success', 'Pengguna berhasil mengubah password');
    }
}
