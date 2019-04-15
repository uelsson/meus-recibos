<?php
    /**
     * @author Uelsson R <contact@uelsson.com>
     * @version v 1.0.0 
     */
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\User;

    class UserController extends Controller
    {
    	public function index(){
    		return view('login');
    	}

     	public function login(Request $request){
            $user = new User();

            $request->validate([
                'email' =>  'required|max:150',
                'password' => 'required|max:80'
            ]);

            $email = $request['email'];
            $password = hash('sha256', $request['password']);

            $login = $user->login($email, $password);

            if($login){
            	 $request->session()->put(array(
    	        	'login_status' => 'logged',
    	        	'user_data' => array(
    	        		'email' => $login->email,
    	        		'password' => $login->password
    	        	)
    	        ));
        		
        		if($request->session()->get('login_status') === 'logged'){
        			return redirect('/');
        		}
            } else {
            	return redirect('/login')->with('messageError', 'Usuário/senha incorreto.');
            }
        }
    }
