<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;

use App\Mail\Email;
use App\Models\User;
use App\Models\Notification;

use DateTime;

/**
 * Classe responsável pelo Gerenciamento de Usuários no portal, somente o usuário do tipo Admin tem acesso.
 */
class UserController extends Controller
{

    /**
	 * [Método responsável por carregar a view/table de gerenciamento de usuários.]
	 * @return [View]
	 */
    public function index()
    {
        $users = User::all();

        return view('users/users', compact('users'));
    }

    
    /**
	 * [Método responsável pelo cadastro de um novo usuário.]
	 * @return [redirect] [Redireciona para a tabela de usuários e cria um flashdata com mensagem de sucesso ou erro]
	 */
    public function create(Request $request)
    {  
        try {      
            User::create([
                'name'       => $request->name,
                'role'       => $request->role,
                'email'      => $request->email,
                'password'   => Hash::make('1234'),
                'permission' => $request->permission,
            ]);

            Mail::to($request->email)->send(new Email($request)); // Envia um e-mail usando a classe Mail e o Mailable.
    
            return redirect()->route('users')->with('success', 'Usuário cadastrado com sucesso!');
        } 
        catch (\Exception $e) {
            return redirect()->route('users')->with('error', $e->getMessage());
        }
    }


    /**
	 * [Método responsável por carregar a view de detalhes de um usuário.]
	 * @return [View]
	 */
    public function show(string $ID)
    {
        $user = User::findOrFail($ID);

        return view('users/details', compact('user'));
    }
    

    /**
	 * [Método responsável por atualizar dados de um usuário.]
	 * @return [redirect] [Atualiza a tela e cria um flashdata com mensagem de sucesso ou erro]
	 */
    public function update(Request $REQUEST, string $ID)
    {
        try {
            $user = User::findOrFail($ID);
    
            $user->update($REQUEST->all());  
            
            Notification::create(['user_id' => $ID, 'message' => 'O Administrador do sistema alterou dados do seu usuário.']);

            return redirect()->route('users.show', $ID)->with('success', 'Alterado dados do usuário com sucesso!');     
        } 
        catch (\Exception $e) {
            return redirect()->route('users.show', $ID)->with('error', $e->getMessage());
        }
    }


    /**
	 * [Método responsável por excluir um usuário.]
	 * @return [redirect] [Redireciona para a tabela de usuários e cria um flashdata com mensagem]
	 */
    public function destroy(string $ID)
    {
        try {
            $user = User::findOrFail($ID);
    
            $user->delete();
    
            return redirect()->route('users')->with('success', 'Usuário excluído com sucesso!');
        } 
        catch (\Exception $e) {
            return redirect()->route('users')->with('error', $e->getMessage());
        }
    }
    
}
