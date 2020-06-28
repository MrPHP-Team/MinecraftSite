function checkprice() {
	var msg   = $('#form').serialize();
	$.ajax({
		type: 'POST',
		url: '/core/payment.php',
		data: msg+'&checkprice=1',
		success: function(data) {
			$('#result').html(data);
		}
	});
};

function sendform() {
	$.ajax({
		type: 'POST',
		url: '/core/payment.php',
		data: $('#form').serialize(),
		success: function(data) {
			$('#sendf').html(data);
		}
	});
};