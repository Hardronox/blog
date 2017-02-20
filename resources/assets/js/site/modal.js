$(document).ready( () => {
	$(".edit").click( () => {
		$("#myModal").modal('show');
	});
});

$(document).on('submit', '#edit-profile-form', function(event) {

	var form = document.getElementById('edit-profile-form');
	var fileSelect = document.getElementById('file');
	var uploadButton = document.getElementById('edit-profile-button');

//$('#file');

	event.preventDefault();

	var files = fileSelect.files;
	console.log(form, fileSelect, files);
	// Create a new FormData object.
	var formData = new FormData();


	// Loop through each of the selected files.
	for (var i = 0; i < files.length; i++) {
		var file = files[i];

		// Check the file type.
		if (!file.type.match('image.*')) {
			continue;
		}

		// Add the file to the request.
		formData.append('avatar[]', file, file.name);
	}

	// Files
	formData.append(name, file, files[0].name);


	// Set up the request.
	var xhr = new XMLHttpRequest();

	// Open the connection.
	xhr.open('POST', '/check', true);

	// Set up a handler for when the request finishes.
	xhr.onload = function () {
		if (xhr.status === 200) {
			$('#myModal').modal('toggle');

			Noty({
				//type: 'information',
				layout:'bottomRight',
				text: 'Profile has been updated!',
				//theme: 'defaultTheme',
				timeout: 2000,
				template: '<div class="noty_message" ><span class="noty_text"></span><div class="noty_close"></div></div>',
				animation: {
					open: {height: 'toggle'},
					close: {height: 'toggle'},
					easing: 'swing',
					speed: 400 // opening & closing animation speed
				}
			});
			// tried to override classes of noty but these options were unwilling to change :\
			$(".noty_message").css("text-align","center");
			$("li").css("border","none");


		} else {
			alert('An error occurred!');
		}
	};

	// Send the Data.
	xhr.send(formData);



	return false;

});