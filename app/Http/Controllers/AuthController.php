<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //$user adalah variabel yang berisi object model User
    protected $User;

    public function __construct(User $User)
    {
        $this->User = $User;
    }
    //fungsi menampilkan halaman login
    public function getLogin(){
        return view('auth.login');
    }
    //Proses login
    public function postLogin(Request $request){
        $validasi = Validator::make($request->all(),[
            'username'=>'required','password'=>'required|min:8'
        ],[
            'username.required'=>'Username tidak boleh kosong',
            'password.required'=>'Password tidak boleh kosong',
            'password.min'=>'Password minimal 8 karakter'
        ]);
        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi);
        } else {
            $data = [
                'username'=>$request->username,'password'=>$request->password
            ];
            if (Auth::attempt($data)) {
                RateLimiter::clear('login-attempts:'.$request->username);
                return redirect('dashboard');
            } else {
                return redirect()->back()->with('login-failed','Username atau password salah');
            }
            
        }
        
    }
    //Proses logout
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
    //Menampilkan semua data user di urut secara DESC
    public function getPengguna(){
        $title = 'Pengguna';
        $data = $this->User->getUser();
        return view('admin.pengguna',compact('title','data'));
    }
    //Menampilkan profil
    public function getProfil($id){
        $title = 'Profil';
        $data = $this->User->findUser($id);
        return view('admin.profil',compact('title','data'));
    }
    //Menambah pengguna
    public function postPengguna(Request $request){
        $validasi = Validator::make($request->all(),[
            'nama'=>'required',
            'username'=>'required|unique:users,username',
            'password'=>'required|min:8|confirmed'
        ],[
            'nama.required'=>'Nama tidak boleh kosong',
            'username.required'=>'Username tidak boleh kosong',
            'username.unique'=>'Username sudah di gunakan',
            'password.required'=>'Password tidak boleh kosong',
            'password.min'=>'Password minimal 8 karakter',
            'password.confirmed'=>'Password dengan konfirmasi password tidak sama'
        ]);
        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi);
        } else {
            $this->User->createUser([
                'nama'=>$request->nama,'username'=>$request->username,
                'password'=>Hash::make($request->password)
            ]);
            return redirect()->back()->with('postPengguna','Tambah pengguna berhasil');
        }
    }
    //Menampilkan satu user dengan id
    public function findPengguna($id){
        $title = 'Detail Pengguna';
        $data = $this->User->findUser($id);
        return view('admin.pengguna-detail',compact('title','data'));
    }
    //Proses Ubah data pengguna
    public function putPengguna(Request $request, $id){
        $validasi = Validator::make($request->all(),[
            'nama'=>'required',
            'username'=>'required'
        ],[
            'nama.required'=>'Nama tidak boleh kosong',
            'username.required'=>'Username tidak boleh kosong'
        ]);
        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi);
        } else {
            $data = [
                'nama'=>$request->nama,'username'=>$request->username
            ];
            $this->User->updateUser($id,$data);
            return redirect()->back()->with('putPengguna','Ubah pengguna berhasil');
        }
    }
    //Proses ubah password
    public function putPassword(Request $request, $id){
        $validasi = Validator::make($request->all(),[
            'password'=>'required|min:8|confirmed'
        ],[
            'password.required'=>'Password tidak boleh kosong',
            'password.min'=>'Password minimal 8 karakter',
            'password.confirmed'=>'Password dengan konfirmasi password tidak sama'
        ]);
        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi);
        } else {
            $data = [
                'password'=>Hash::make($request->password)
            ];
            $this->User->updatePassword($id,$data);
            return redirect()->back()->with('putPassword','Password berhasil d ubah');
        }
        
    }
    //Proses Hapus Pengguna
    public function deletePengguna($id){
        $this->User->deleteUser($id);
        return redirect()->back()->with('deletePengguna','Hapus pengguna berhasil');
    }
}
