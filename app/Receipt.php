<?php
	/**
     * @author Uelsson R <contact@uelsson.com>
     * @version v 1.0.0 
     */
	namespace App;

	use Illuminate\Support\Facades\DB;
	use Illuminate\Database\Eloquent\Model;

	class Receipt extends Model
	{
		public $table = 'receipts';
		public $timestamps = false;

		public function receiptReport($client_id){
			$receipts = DB::table('receipts')->join('clients', 'receipts.client_id', '=', 'clients.id')
							->select('receipts.id', DB::raw('CAST(receipts.amount AS CHAR) as amount'), 'receipts.client_id', 'receipts.receipt_file', 'receipts.dt_created', 'receipts.dt_receipt', 'clients.name', 'clients.cpf')
							->orderBy('id', 'desc')
							->where('receipts.client_id', '=', $client_id)
							->get();

			return $receipts;
		}

		public function receiptCsv($client_id, $month, $year){
			$receipts = DB::table('receipts')->join('clients', 'receipts.client_id', '=', 'clients.id')
							->select(DB::raw('CAST(sum(receipts.amount) AS CHAR) as amount'), DB::raw('MONTH(receipts.dt_receipt) as month'), DB::raw('YEAR(receipts.dt_receipt) as year'), 'receipts.client_id', 'clients.name', 'clients.cpf')
							->where('receipts.client_id', '=', $client_id)
							->whereRaw('MONTH(receipts.dt_receipt) = '.$month)
							->whereRaw('YEAR(receipts.dt_receipt) = '.$year)
							->groupBy('receipts.client_id')
							->groupBy('month')
							->groupBy('year')
							->first();

			return $receipts;
		}
	}
