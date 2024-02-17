
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script> // modal dinamica
      function cargarContenidoModal() {
        fetch('carga_dinamica.php')
          .then(response => response.text()) 
          .then(html => {
            document.querySelector('#miModalDinamico .modal-body').innerHTML = html;
          })
          .catch(error => {
            console.error('Error al cargar el contenido de la modal:', error);
          });
      }
    </script>
    <script>
      $('#miModalDinamico').on('show.bs.modal', function (e) {
        cargarContenidoModal();
      });
    </script>

  </body>
</html>