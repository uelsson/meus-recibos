<?php
	/**
     * @author Uelsson R <contact@uelsson.com>
     * @version v 1.0.0 
     */
	namespace App;

	use Illuminate\Support\Facades\DB;
	use Illuminate\Database\Eloquent\Model;

	class Client extends Model
	{
		public $table = 'clients';
		public $timestamps = false;
	    
	    /**
	     *
	     */
		public function clientReport(){
			$clients = DB::table('clients')->leftJoin('receipts', 'clients.id', '=', 'receipts.client_id')
							->select('clients.*', DB::raw('count(receipts.client_id) as qt_receipts'), DB::raw('CAST(sum(receipts.amount) AS CHAR) as amount'))
							->groupBy('clients.id')
							->orderBy('clients.id', 'desc')
							->get();

			return $clients;
		}
	}
