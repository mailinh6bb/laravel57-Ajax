$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});
$(document).ready(function(){
	$('.qty').blur(function(){
		let rowid = $(this).data('id');
		let proid = $(".pro_id"+rowid).val();
		$.ajax({
			url : 'cart/'+rowid,
			type : 'put',
			dataType : 'json',
			data : {
				qty : $(this).val(),
				proid: proid,
			},
			success : function(data){
				if(data.error){
					toastr.error(data.error, 'Thông báo', {timeOut: 10000});
					location.reload();
				}else{
					toastr.success(data.result, 'Thông báo', {timeOut: 10000});
					location.reload();
				}
			}
		});
	});
	$('.close1').click(function(){
		$('#delete').modal('show');
		let rowid = $(this).data('id');
		$('.delProduct').click(function(){
			$.ajax({
				url : 'cart/'+rowid,
				type : 'delete',
				dataType : 'json',
				success : function(data){
					$('#delete').modal('hide');
					toastr.success(data.result, 'Thông báo', {timeOut: 10000});
					location.reload();
				}
			});
		});
	});

	// Add customer
	$('.errorEmail').hide();
	$('.errorName').hide();
	$('.errorPhone').hide();
	$('.errorAddress').hide();
	$('.addAddress').click(function(){
		var active = '';
		if ($('.actives').prop('checked')) 
		{
			active = 'on';
		}
		else {
			active = 'off';
		}
		$.ajax({
			url: ' customer',
			type: 'post',
			data: {
				email: $('.email').val(),
				phone: $('.phone').val(),
				address: $('.address').val(),
				active: active,
				name: $('.name').val(),
			},
			dataType: 'json',
			success:function(data){
				$('#address').hide();
				toastr.success(data.result, 'Thông báo', {timeOut: 10000});
				location.reload();
			},
			error:function(data){
				var error = $.parseJSON(data.responseText);
				if( typeof error.errors.email != 'undefined' && error.errors.email.length > 0 ){
					$('.errorEmail').show();
					$('.errorEmail').html(error.errors.email);
				}
				if (typeof error.errors.phone != 'undefined' && error.errors.phone.length > 0) {
					$('.errorPhone').show();
					$('.errorPhone').html(error.errors.phone);
				}
				if (typeof error.errors.address != 'undefined' && error.errors.address.length > 0) {
					$('.errorAddress').show();
					$('.errorAddress').html(error.errors.address);
				}
				if (typeof error.errors.name != 'undefined' && error.errors.name.length > 0) {
					$('.errorName').show();
					$('.errorName').html(error.errors.name);
				}
			}
		});
	});
// save order
$('.payment').click(function(){
	var email = '';
	var name = '';
	var phone = '';
	var address = '';
	var note = $('.note').val();
	var paytotal = $('.paytotal').text();
	paytotal = paytotal.replace("VNĐ", "");
	paytotal = paytotal.replace(".", "");
	var rdoAddress = $('input[name=rdoaddress]');
	$.each(rdoAddress,function(key,value){
		if (value.checked == true) {
			email = value.value;
			phone = $('.phone'+key).text();
			name = $('.name'+key).text();
			address = $('.address'+key).text();	
		}
	});
	$.ajax({
		url: 'cart',
		data: {
			email: email,
			phone: phone,
			name: name,
			address: address,
			note: note,
			money: paytotal
		},
		dataType: 'json',
		type: 'post',
		success:function(data){
			toastr.success(data.result, 'Thông báo', {timeOut: 10000});
			location.href = '/';
		}

	});
});
});