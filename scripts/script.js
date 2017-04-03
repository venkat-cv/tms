$(document).ready(function(){
	$('.success-sec').hide();
	$('.create-btn').click(function(){
		$('.create-msg').hide();
		$('.success-sec').fadeOut("slow");
		var btnname = 	$(this).attr('name');
		$('.'+btnname+'Form').toggle("slow");
	});
	$('input#register').click(function(){
		$('#login-msg').html('<br/><br/><br/><br/>');
		$('.signup-form').slideToggle();
		$('.login-form').slideToggle();
	});
	$('.addSec').click(function(){
		$('.success-sec').hide();
		$('.sec-form').slideToggle("slow");
		$('.two-pane').slideToggle("slow");
	});
	$('form.signup-form').submit(function(e){
		e.preventDefault();
		var formser = $(this).serialize();
		$.ajax({
			url:'register.php',
			type:'post',
			data: formser,
			success:function(returndata){
				console.log(returndata);
				$('#login-msg').html(returndata+"<br/><br/>");
				if(returndata == 'User registered successfully')
				{
					$('.signup-form').hide();
					$('.login-form').show();
					$('.two-pane').show();
					$('.success-sec').show();
					$('.success-sec h4').html(returndata+'<br/>');
				}
			}
		});
	});
	$('form.myForm').submit(function(e){
		e.preventDefault();
		var category = $(this).attr('name');
		var formser = $(this).serialize()+'&cat='+category;
		$.ajax({
			url:'create.php',
			type:'post',
			data: formser,
			success:function(returndata){
				console.log(returndata);
				if(returndata == 'meetingform')
				{
					$('.create-msg-meet').show();
					$('.createForm').hide();
				}
				else if(returndata == 'taskform')
				{
					$('.create-msg-task').show();
					$('.createForm').hide();
				}
				location.href = 'home.php';
			}
		});
	});
	
	//Editable options
	$('td.name').editable({
		type: 'text',
		url: 'editable.php',
		params: function(params) {
			params.title = $(this).attr('data-title');
			return params;
		},
		 success: function(response, newValue) {
			//~ if(response.status == 'error') return response.msg;
		},
		validate: function(value) {
			if($.trim(value) == '') {
				return 'This field is required';
			}
		}
	});
	$('td.date').editable({
		type: 'combodate',
		url: 'editable.php',
		viewformat: "YYYY-MM-DD HH:mm:ss",
		template:"D MMM YYYY  HH:mm",
		format: "YYYY-MM-DD HH:mm",
		combodate: {
                minYear: 2000,
                maxYear: 2050,
                minuteStep: 1
           },
		params: function(params) {
			params.title = $(this).attr('data-title');
			return params;
		},
		 success: function(response, newValue) {
			 console.log(response);
			 console.log(newValue);
			//~ if(response.status == 'error') return response.msg;
		},
		validate: function(value) {
			if($.trim(value) == '') {
				return 'This field is required';
			}
		}
	});
	$('td.desc').editable({
		type: 'textarea',
		url: 'editable.php',
		params: function(params) {
			params.title = $(this).attr('data-title');
			return params;
		},
		 success: function(response, newValue) {
			 console.log(response);
			 console.log(newValue);
			//~ if(response.status == 'error') return response.msg;
		}
	});

});
