// JavaScript Validacion de registro

$('document').ready(function(){ 		
		 // Validacion de nombres
		 var nameregex = /^[a-zA-ZñÑ ]+$/;
		 $.validator.addMethod("validname", function( value, element ) {
		     return this.optional( element ) || nameregex.test( value );
		 });
		 var uregex =  /^[a-zA-Z0-9ñÑ_]+$/;
		 $.validator.addMethod("validusername", function( value, element ) {
		     return this.optional( element ) || uregex.test( value );
		 });
		 $("#register-form").validate({			
		  rules:
		  {
				name: {
					required: true,
					validname: true,
					minlength: 4
				},
           lastname: {
					required: true,
					validname: true,
					minlength: 4
				},
				username: {
					required: true,
					validusername: true,
					minlength: 4
				},
			
				
				password: {
					required: true,
					minlength: 6
				}
		   },
		   messages:
		   {
					name: {
						required: "El nombre es requerido",
						validname: "El nombre debe contener solo alfabetos y espacio",
						minlength: "El nombre es muy corto"
					},
					lastname: {
						required: "Sus apellidos son requeridos",
						validname: "Los apellidos deben contener solo alfabetos y espacio",
						minlength: "Sus apellidos son muy cortos"
					},
					username: {
						required: "Ingrese un nombre de usuario",
						validusername: "El nombre de usuario debe contener solo alfabetos y numeros",
						minlength: "Su nombre de usuario es muy corto"
					},
					password:{
						required: "Contraseña es requerida",
						minlength: "La contraseña debe tener como minimo 6 caracteres"
					}
					

		   },
		   errorPlacement : function(error, element) {
				$(element).closest('.form-group').find('.help-block').html(error.html());
				    
		   },
		   highlight : function(element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
				
				 
		   },
		   unhighlight: function(element, errorClass, validClass) {
			  $(element).closest('.form-group').removeClass('has-error');
				$(element).closest('.form-group').find('.help-block').html('');
				   
		   }
			
			});
		
		$("#update-form").validate({	
		rules:
		{
			upname: {
				required: true,
				validname: true,
				minlength: 4
			},
			uplastname: {
				required: true,
				validname: true,
				minlength: 4
			},
			upusername: {
				required: true,
				validusername: true,
				minlength: 4
			},
		
			
			uppassword: {
				
				minlength: 6
			}
			},
			messages:
			{
				upname: {
					required: "El nombre es requerido",
					validname: "El nombre debe contener solo alfabetos y espacio",
					minlength: "El nombre es muy corto"
				},
				uplastname: {
					required: "Sus apellidos son requeridos",
					validname: "Los apellidos deben contener solo alfabetos y espacio",
					minlength: "Sus apellidos son muy cortos"
				},
				upusername: {
					required: "Ingrese un nombre de usuario",
					validusername: "El nombre de usuario debe contener solo alfabetos y numeros",
					minlength: "Su nombre de usuario es muy corto"
				},
				uppassword:{
					
					minlength: "La contraseña debe tener como minimo 6 caracteres"
				}
				

			},
			errorPlacement : function(error, element) {
			$(element).closest('.form-group').find('.help-block').html(error.html());
					
			},
			highlight : function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			
				
			},
			unhighlight: function(element, errorClass, validClass) {
			$(element).closest('.form-group').removeClass('has-error');
			$(element).closest('.form-group').find('.help-block').html('');
					
			}
		
			});


		$("#create-camp").validate({
		
			rules:
			{
				campname: {
					required: true,
					validname: true,
					minlength: 4
				}
				},
				messages:
				{
					campname: {
						required: "El nombre de la campaña es requerido",
						validname: "El nombre debe contener solo alfabetos y espacio",
						minlength: "El nombre es muy corto"
					}
					
	
				},
				errorPlacement : function(error, element) {
				$(element).closest('.form-group').find('.help-block').html(error.html());
						
				},
				highlight : function(element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
				
					
				},
				unhighlight: function(element, errorClass, validClass) {
				$(element).closest('.form-group').removeClass('has-error');
				$(element).closest('.form-group').find('.help-block').html('');
						
				}
			
			});
		
		$("#update-camp").validate({

			rules:
			{
				upcampname: {
					required: true,
					validname: true,
					minlength: 4
				}
				},
				messages:
				{
					upcampname: {
						required: "El nombre de la campaña es requerido",
						validname: "El nombre debe contener solo alfabetos y espacio",
						minlength: "El nombre es muy corto"
					}
					
	
				},
				errorPlacement : function(error, element) {
				$(element).closest('.form-group').find('.help-block').html(error.html());
						
				},
				highlight : function(element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
				
					
				},
				unhighlight: function(element, errorClass, validClass) {
				$(element).closest('.form-group').removeClass('has-error');
				$(element).closest('.form-group').find('.help-block').html('');
						
				}
			
			});
		

		$("#create-tarea").validate({

			rules:
			{
				tarname: {
					required: true,
					validname: true,
					minlength: 4
				}
				},
				messages:
				{
					tarname: {
						required: "El nombre de la tarea es requerido",
						validname: "El nombre debe contener solo alfabetos y espacio",
						minlength: "El nombre de la tarea es muy corto"
					}
					
	
				},
				errorPlacement : function(error, element) {
				$(element).closest('.form-group').find('.help-block').html(error.html());
						
				},
				highlight : function(element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
				
					
				},
				unhighlight: function(element, errorClass, validClass) {
				$(element).closest('.form-group').removeClass('has-error');
				$(element).closest('.form-group').find('.help-block').html('');
						
				}
			
			});	  
});