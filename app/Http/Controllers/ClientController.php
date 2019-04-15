<?php
    /**
     * @author Uelsson R <contact@uelsson.com>
     * @version v 1.0.0 
     */
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;
    use App\Client;
    use App\Receipt;

    class ClientController extends Controller
    {
    	public function messages(){
    		return [
    			'name.max' => 'Nome: Máximo de caracteres 150.',
    			'name.required' => 'Nome: Obrigatório.',
    			'cpf.max' => 'CPF: Máximo de caracteres 14.',
    			'cpf.required' => 'CPF: Obrigatório.',
    			'note.max' => 'Observações: Máximo de caracteres 2000.',
                'year.min' => 'Ano: Mínimo de caracteres 4, ex: 2018, 2019...'
    		];
    	}

    	public function index(){
    		$client = new Client();
    		$results = $client->clientReport();

    		$data = [
    			'results' => $results
    		];

    		return view('client-report', $data);
    	}

        public function csv(Request $request){
            $client = new Client();

            $request->validate([
                'month' =>  'required|max:2',
                'year' => 'required|min:4|max:4'
            ], $this->messages()); 

            $month = $request['month'];
            $year = $request['year'];
            $percent_discount = $request['percent_discount'];

            $clients = $client->get();

            $csv = [];
            
            foreach($clients as $client){
                if($this->csvMonth($client->id, $month, $year) !== null){
                    array_push($csv, $this->csvMonth($client->id, $month, $year));
                }
            }

            $file = md5(rand(1,1000000))."_clients.csv";
          
            
            $repo = '';
            $repo .= "nome,cpf,montante,referência\n";
            
            foreach($csv as $csv){
                $repo .= $csv->name.','.$csv->cpf.','.$csv->amount.','.$csv->month.'/'.$csv->year."\n";
            }

            $report_file = Storage::disk('local')->put('files/reports/'.$file, $repo); // save file

            $exists = Storage::disk('local')->exists('files/reports/'.$file);
            if($exists){
                return Storage::download('files/reports/'.$file);
            } else {
                return redirect('/')->with('messageError', 'Arquivo não encontrdo.');
            }
        }

        public function create(){
        	return view('client');
        }

        public function store(Request $request){
        	$client = new Client();

        	$request->validate([
        		'name' =>  'required|max:150',
        		'cpf' => 'required|max:14',
                'phone' => 'max:16',
                'email' => 'max:100',
        		'note' => 'max:2000'
        	], $this->messages());

        	$client->name = $request['name'];
        	$client->cpf = $request['cpf'];
            $client->phone = $request['phone'];
            $client->email = $request['email'];
        	if($request['note'] !== null){
        		$client->note = $request['note'];
        	}

            $exists = $client->where('cpf', '=', $request['cpf'])->first();
            
            if($exists !== null){
                return redirect('/client')->with('messageError', 'CPF já existe.');
            }

        	$client->dt_created = date('Y-m-d H:i:s', time());
        	
        	try{
        		$client->save();
        		return redirect('/')->with('messageSuccess', 'Cliente criado com sucesso.');
        	} catch(\Exception $e) {
        		return redirect('/')->with('messageError', 'Um erro ocorreu, tente novamente.');
        	}
        }

        public function edit(Request $request, $id){
            $client = new Client();

            $id = (int)$id;
            
            $clientData = $client->where('id', '=', $id)->first();

            $data = [
                "data" => $clientData
            ];

            return view('client', $data);
        }

        public function update(Request $request, $id){
            $client = new Client();

            $request->validate([
                'name' =>  'required|max:150',
                'cpf' => 'required|max:14',
                'phone' => 'max:16',
                'email' => 'max:100',
                'note' => 'max:2000'
            ], $this->messages());

            $update = $client->findOrFail($id); //make 404 page

            $update->name = $request['name'];
            $update->cpf = $request['cpf'];
            $update->phone = $request['phone'];
            $update->email = $request['email'];
            if($request['note'] !== null){
                $update->note = $request['note'];
            }

            try{
                $update->save();
                return redirect('/client/'.$id.'/edit')->with('messageSuccess', 'Cliente atualizado com sucesso.');
            } catch(\Exception $e) {
                return redirect('/client/'.$id.'/edit')->with('messageError', 'Um erro ocorreu, tente novamente.');
            }
        }


        public function csvMonth($client_id, $month, $year){
            $receipt = new Receipt();       

            $results = $receipt->receiptCsv($client_id, $month, $year);

            return $results;
        }

        public function destroy(Request $request, $id){
            $client = new Client();

            $delete = $client->findOrFail($id);

            try{
                $delete->delete();
                return redirect('/')->with('messageSuccess', 'Cliente deletado com sucesso.');
            } catch(\Exception $e) {
                if(isset($e->errorInfo[1]) && $e->errorInfo[1] === 1451){
                    return redirect('/')->with('messageError', 'Cliente possui recibos.');
                }
                return redirect('/')->with('messageError', 'Um erro ocorreu, tente novamente.');
            }
        }
    }
