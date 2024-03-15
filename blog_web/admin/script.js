const toggle = document.querySelector('.toggle');
toggle.addEventListener('click', function(){
	const sidebar = document.querySelector('.sidebar');
	sidebar.classList.toggle('active');
})