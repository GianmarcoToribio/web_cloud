document.getElementById('loginbtn').addEventListener('click', function() {
    var modal = new bootstrap.Modal(document.getElementById('loginModal'));
    modal.show();
});

// Cerrar el modal al hacer clic en el botón de cerrar
document.querySelector('.close').addEventListener('click', function() {
    document.getElementById('loginModal').style.display = 'none';
});

// Cerrar el modal si el usuario hace clic fuera del contenido
window.addEventListener('click', function(event) {
    var modal = document.getElementById('loginModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});
