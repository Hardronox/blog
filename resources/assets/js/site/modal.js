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

		// Check the file type.
		if (!file.type.match('image.*')) {
			continue;
		}

		// Add the file to the request.
		formData.append('avatar[]', file, file.name);
	}

	formData.append("firstname",firstname);
	formData.append("lastname",lastname);


	let xhr = new XMLHttpRequest();
	xhr.open('POST', '/profile/edit', true);

	// Set up a handler for when the request finishes.
	xhr.onload = function (response) {
		if (xhr.status === 200) {
			$('#myModal').modal('toggle');

			//console.log(response);


			$('#first').html(response[0]);
			$('#last').html(response[1]);
			$('#image').attr('src',response[2]);

			Noty({
				text: 'Profile has been updated!'
			});

		}
	};

	xhr.send(formData);

});