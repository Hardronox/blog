$(document).ready( () => {
	$(".edit").click( () => {
		$("#myModal").modal('show');
	});
});

$(document).on('submit', '#edit-profile-form', (event) => {

	let form = document.getElementById('edit-profile-form');
	let fileSelect = document.getElementById('file');
	let files = fileSelect.files;

	let formData = new FormData();
	let firstname = $('#firstname').val();
	let lastname = $('#lastname').val();

	event.preventDefault();

	// Loop through each of the selected files.
	for (let i = 0; i < files.length; i++) {
		let file = files[i];

		// Add the file to the request.
		formData.append('avatar[]', file, file.name);
	}

	formData.append("firstname",firstname);
	formData.append("lastname",lastname);


	$.ajax({
		url: '/profile/edit',
		data: formData,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(response){
			$('#myModal').modal('toggle');

			$('#first').html(response[0]);
			$('#last').html(response[1]);

			if(response[2] !== ''){
				let image = response[2].replace("public", "storage");
				$('.profile_image').attr('src',image);
				$('#image').attr('src',image);
			}

			Noty({
				text: 'Profile has been updated!'
			});
		}
	});
});

