<?php
    /**
     * @author Uelsson R <contact@uelsson.com>
     * @version v 1.0.0 
     */
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;
    use App\Receipt;

    class ReceiptController extends Controller
    {
        //
        public function index(Request $request, $client_id){
            $receipt = new Receipt();
            $results = $receipt->receiptReport($client_id);

            $data = [
                'results' => $results
            ];


            return view('receipt-report', $data);
        }    

        public function create(){
        	return view('receipt');
        }

        public function store(Request $request){
        	$receipt = new Receipt();
        	
            $request->validate([
                'receipt_file' =>  'required|mimes:pdf,jpg,png',
                'client_id' => 'required',
                'amount' => 'required',
                'dt_receipt' => 'required'
            ]);

            $dt_receipt = $request["dt_receipt"];
            $dt_receipt = date('Y-d-m', strtotime($dt_receipt));
            
        	$receipt_file = $request->file('receipt_file')->store('files/receipts');

        	$receipt->client_id = $request["client_id"];
        	$receipt->amount =  str_replace(',', '.', str_replace('.', '', $request["amount"]));
            $receipt->dt_receipt = $dt_receipt;
        	$receipt->receipt_file = $receipt_file;
        	$receipt->dt_created = date('Y-m-d H:i:s', time());

            try{
                $receipt->save();
                return redirect('/client/'.$request["client_id"].'/receipt')->with('messageSuccess', 'Recibo criado com sucesso.');
            } catch(\Exception $e) {
                return redirect('/client/'.$request["client_id"].'/receipt')->with('messageError', 'Um erro ocorreu, tente novamente.');
            }
        }

        public function download(Request $request, $client_id, $receipt_id){
            $receipt = new Receipt();

            $result = $receipt->where('id', '=', $receipt_id)->first();

            if($result){
                $exists = Storage::disk('local')->exists($result->receipt_file);
                if($exists){
                    return Storage::download($result->receipt_file);
                } else {
                    return redirect('/receipt/'.$client_id.'/')->with('messageError', 'Arquivo não encontrado.');
                }
            } else {
                return redirect('/receipt/'.$client_id.'/')->with('messageError', 'Arquivo não encontrado.');
            }
        }
    }
