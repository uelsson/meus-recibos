function TestaCPF(strCPF) {

	strCPF = strCPF.replace(/[^\d]+/g,'');
	let soma = 0;
    let resto;

  	if(
  		strCPF == "00000000000" ||
  		strCPF == "11111111111" ||
  		strCPF == "22222222222" ||
  		strCPF == "33333333333" ||
  		strCPF == "44444444444" ||
  		strCPF == "55555555555" ||
  		strCPF == "66666666666" ||
  		strCPF == "77777777777" ||
  		strCPF == "88888888888" ||
  		strCPF == "99999999999"
  	){
  		return false
  	};
     
  	for (i=1; i<=9; i++) {
  		soma = soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
  	}
  	
  	resto = (soma * 10) % 11;
   
    if((resto == 10) || (resto == 11)){
    	resto = 0;
    }

    if(resto != parseInt(strCPF.substring(9, 10))) {
    	return false;	
    }
   
 	soma = 0;
    
    for(i = 1; i <= 10; i++) {
    	soma = soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    }
    
    resto = (soma * 10) % 11;
   
    if((resto == 10) || (resto == 11)){
    	resto = 0;
    }

    if(resto != parseInt(strCPF.substring(10, 11))){
    	return false;
    }

    return true;
}

$(document).ready(function(){
	//masks
	$('.cpf_mask').mask('000.000.000-00');
	$('.phone_mask').mask('(00) 0 0000-0000');
	$('.fee_mask').mask('##0.00', {reverse: true});
	$('.money_mask').mask('0.000.000,00', {reverse: true});
	$('.date_mask').mask('00/00/0000');

	$('#receipt_file').change(function(){
		$('.file_selected').text($(this).val());
	});

	// 

	// login
	$('#login').click(function(){
		let email = $('#email').val();
		let password = $('#password').val();

		let fields = [];
		if(email === ''){
			fields.push('email');
			$('#email').addClass('is-invalid');	
		} else {
			$('#email').removeClass('is-invalid');	
			$('#email').addClass('is-valid');	
		}

		if(password === ''){
			fields.push('password');
			$('#password').addClass('is-invalid');	
		} else {
			$('#password').removeClass('is-invalid');
			$('#password').addClass('is-valid');
		}

		if(fields.length > 0){
			return false;
		} else {
			return true;
		}
	});

	// client form
	$('#create_client').click(function(){
		let name = $('#name').val();
		let cpf = $('#cpf').val();

		let fields = [];
		if(name === ''){
			fields.push('name');
			$('#name').addClass('is-invalid');
		} else {
			$('#name').removeClass('is-invalid');
			$('#name').addClass('is-valid');
		}

		if(cpf === '' || TestaCPF(cpf) === false){
			fields.push('cpf');
			$('#cpf').addClass('is-invalid');
		} else {
			$('#cpf').removeClass('is-invalid');
			$('#cpf').addClass('is-valid');
		}

		if(fields.length > 0){
			return false;
		} else {
			return true;
		}
	});

	// receipt download form
	$('#download_report').click(function(){
		let month = $('#month').val();
		let year = $('#year').val();

		let fields = [];
		if(month === ''){
			fields.push('month');
			$('#month').addClass('is-invalid');
		} else {
			$('#month').removeClass('is-invalid');
			$('#month').addClass('is-valid');
		}

		if(year === ''){
			fields.push('year');
			$('#year').addClass('is-invalid');
		} else {
			$('#year').removeClass('is-invalid');
			$('#year').addClass('is-valid');
		}

		if(fields.length > 0){
			return false;
		} else {
			$('#month').addClass('is-valid');
			return true;
		}
	});

	// create new receipt
	$('#create_receipt').click(function(){
		let amount = $('#amount').val();
		let dt_receipt = $('#dt_receipt').val();
		let receipt_file = $('#receipt_file').val();

		let fields = [];
		
		if(amount === ''){
			fields.push('amount');
			$('#amount').addClass('is-invalid');
		} else {
			$('#amount').removeClass('is-invalid');
			$('#amount').addClass('is-valid');
		}

		if(dt_receipt === ''){
			fields.push('dt_receipt');
			$('#dt_receipt').addClass('is-invalid');
		} else {
			$('#dt_receipt').removeClass('is-invalid');
			$('#dt_receipt').addClass('is-valid');
		}

		if(receipt_file === ''){
			fields.push('receipt_file');
			$('#receipt_file').addClass('is-invalid');
		} else {
			$('#receipt_file').removeClass('is-invalid');
			$('#receipt_file').addClass('is-valid');
		}

		if(fields.length > 0){
			return false;
		} else {
			return true;
		}
	});
});