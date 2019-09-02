$(document).ready(function() {
	$(document).on('change', '#user', function(event) {
	    event.preventDefault();
	    /* Act on the event */
		var userId = $(this).val();
		$('input:checkbox').prop('checked', false);
		if (userId.length <= 0) {
			return;
		}

		var url = '/admin/core/user/user-info/' + userId;

		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'json',
			data: {}
		}).done(function(response) {
			var roles = response.roles;
			roles.forEach(function (value, key) {
				$('input#role_' + value.role_id).prop('checked', true);
			})
		});
	});
});