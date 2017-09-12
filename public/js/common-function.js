$(document).ready(function(){
	<!-- Dialog show event handler -->
	$('#confirmDelete').on('show.bs.modal', function (e) {
		$message = $(e.relatedTarget).attr('data-message');
		$(this).find('.modal-body p').text($message);
		$title = $(e.relatedTarget).attr('data-title');
		$(this).find('.modal-title').text($title);

		// Pass form reference to modal for submission on yes/ok
		var form = $(e.relatedTarget).closest('form');
		$(this).find('.modal-footer #confirm').data('form', form);
	});

	<!-- Form confirm (yes/ok) handler, submits form -->
	$('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
		$(this).data('form').submit();
	});
	
	$('#postal_code,#state_code').keypress(function (event) {
		var keycode = event.which;
		if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57) ))) {
			event.preventDefault();
		}
	});	 
	
	 $("#indentor_name,#department_name,#uom_name,#carrier_name").keypress(function(event){
        var inputValue = event.charCode;
        //alert(inputValue);
        if(!((inputValue > 64 && inputValue < 91) || (inputValue > 96 && inputValue < 123)||(inputValue==32) || (inputValue==0))){
            event.preventDefault();
        }
    });

	function checkNumber(check) {   
		var a = document.getElementById("txt_contact_no").value;
		var x = a.keyCode;
		if(!(a >= 48 || a <= 57))
		{
			//alert("enter only numbers");
			document.getElementById("txt_contact_no").value = '';
			return false;
		}       
		return true;        
	}

 }); 

 function checkVechileNumber(){
		var number = document.getElementById("vechile_number").value;
		expr="^[a-zA-Z]{2} [0-9]{2} [a-zA-Z]{2} [0-9]{4}$";
		expr1="^[a-zA-Z]{2} [0-9]{2} [a-zA-Z]{1} [0-9]{4}$";
		r = new RegExp(expr);
		r1 = new RegExp(expr1);
		b = r.test(number);
		b2 = r1.test(number);
		if(b) {
			$("#vechile_number").removeClass('errorItems');
			return true;
		} else if(b2){
		    $("#vechile_number").removeClass('errorItems');
			return true;		
		} 
		alert('Invalid Format Use this Format Vechicle Number : TN 00 BM 0000');
		$("#vechile_number").addClass('errorItems');
		return false; 
	}