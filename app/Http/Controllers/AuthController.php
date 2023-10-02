<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\EmailController;

use App\Models\User;
use App\Models\Notification;
use App\Mail\Email;

class AuthController extends Controller
{

    /**
	 * [Método responsável por retornar a view de login.]
	 * @return [View]
	 */
    public function login()
    {
        return view('auth/login');
    }
  

    /**
	 * [Método responsável por realizar o login no sistema.]
	 * @return [redirect] [Realiza a autenticação e redireciona para a Dashboard]
	 */
    public function loginAuth(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) 
        {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }
  
        $request->session()->regenerate();
  
        return redirect()->route('dashboard');
    }
  

    /**
	 * [Método responsável por encerrar a sessão do usuário.]
	 * @return [redirect] [Redireciona para a página de login]
	 */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        
        return redirect('/');
    }


    /**
	 * [Método responsável por atualizar dados de um usuário.]
	 * @return [View]
	 */
    public function dashboard()
    {
        return view('dashboard');
    }


    /**
	 * [Método responsável por retornar o perfil do usuário.]
	 * @return [View]
	 */
    public function profile()
    {
        return view('users/profile');
    }


    /**
	 * [Método responsável por realizar a alteração do perfil do usuário.]
	 * @return [redirect]
	 */
    public function updateProfile(Request $REQUEST)
    {
        try {
            $user = User::findOrFail(auth()->user()->id);
    
            $user->update($REQUEST->all());  
            
            return redirect()->route('profile')->with('success', 'Alterado dados do perfil com sucesso!');     
        } 
        catch (\Exception $e) {
            return redirect()->route('profile')->with('error', $e->getMessage());
        }
    }


    /**
	 * [Método responsável por realizar a alteração de senha do usuário.]
	 * @return [redirect]
	 */
    public function changePassword(Request $REQUEST)
    {
        try {
            $user = User::findOrFail(auth()->user()->id); // Busca os dados do usuário

            $user->update(['password' => Hash::make($REQUEST->newPassword)]); // Atualiza no BD

            return redirect()->route('profile')->with('success', 'Senha de usuário alterada com sucesso!');
        } 
        catch (\Exception $e) {
            return redirect()->route('profile')->with('error', $e->getMessage());
        }
    }
    
    
    /**
	 * [Método responsável por retornar a view de todas as notificações de um usuário.]
	 * @return [View]
	 */
    public function notifications()
    {
        try {
            $notifications = Notification::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
    
            return view('notifications', compact('notifications'));
        } 
        catch (\Exception $e) {
            return redirect()->route('users')->with('error', $e->getMessage());
        }
    }
    
}
