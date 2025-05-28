document.addEventListener('DOMContentLoaded', function () {
	var searchInput = document.getElementById('s');

	searchInput.addEventListener('keypress', function (event) {
		if (event.key === 'Enter') {
			event.preventDefault();
			document.getElementById('form-busqueda').submit();
		}
	});
});
