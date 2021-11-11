$(document).ready(function(){
	$('.btn-form').click(function(){
		Swal.fire({
		title: 'Ingrese correo o número de telefono para contestar',
		input: 'text',
		inputAttributes: {
			autocapitalize: 'off'
			},
		showCancelButton: true,
		confirmButtonText: 'Enviar',
		showLoaderOnConfirm: true,
  		preConfirm: (login) => {
  			var data = new URLSearchParams({
                contact: login,
                message: $('#icon_prefix2').val(),
            });
            var url = window.location+'public/form';
            return fetch(url, {
				method: 'POST',
				headers: { 'Content-Type': 'application/x-www-form-urlencoded', Authentication: 'secret'},
				body: data.toString()
			})
      		.then(response => {
      			// console.log(response.json())
        		if (!response.ok) {
          			throw new Error(response.statusText)
        		}
        		return response.json()
      		})
      		.catch(error => {
        		Swal.showValidationMessage(
          			`Request failed: ${error}`
        		)
      		})
    		// return fetch(`//api.github.com/users/${login}`)
  		},
  		allowOutsideClick: () => !Swal.isLoading()
		}).then((result) => {
			console.log(result);
  			if (result.isConfirmed) {
    			// Swal.fire({
      	// 			title: `${result.value.login}'s avatar`,
      	// 			imageUrl: result.value.avatar_url
    			// })
  			}
		})
	})
})