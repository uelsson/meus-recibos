<?php
	/**
     * @author Uelsson R <contact@uelsson.com>
     * @version v 1.0.0 
     */
	namespace App;

	use Illuminate\Support\Facades\DB;
	use Illuminate\Database\Eloquent\Model;

	class User extends Model
	{
		public $table = 'users';
		public $timestamps = false;

	    public function login($email, $password){
			$client = DB::table('users')
							->where('email', '=', $email)
							->where('password', '=', $password)
							->first();
			return $client;
		}
	}
