$(document).ready(function(){

//only hide rows if JS is enabled, otherwise it's hidden for non-JS users
toggleStub();

$("#apply_button").attr("disabled", true);

updateVoucherStatus();
$("#voucher-code").keyup(function(){
	updateVoucherStatus();
});

$("#voucher-code").change(function(){
	updateVoucherStatus();
});


});

function updateVoucherStatus()
{
	var RE_VOUCHER = /^[0-9]{5}\-[0-9]{5}\-[A-Z]{2}$/;
	
	var inputVoucher = $("#voucher-code").val();
	if (!RE_VOUCHER.test(inputVoucher))
	{
		$("#apply_button").attr("disabled", true);
	}
	else
	{
		$("#apply_button").attr("disabled", false);
	}
}