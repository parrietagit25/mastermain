
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
      function modal_dinamica(x){
          const datos = new URLSearchParams();
          datos.append('listado_placas_datos_faltantes', '1');
          const opciones = {
              method: 'POST', 
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded' 
              },
              body: datos 
          };
          fetch('views/carga_dinamica.php', opciones)
                  .then(response => response.text()) 
                  .then(data => {
                      const div = document.getElementById('modal_dinamico');
                      div.innerHTML = data;
                  })
                  .catch(error => console.error('Error al cargar el archivo dinamico:', error));
      }
    </script>

  </body>
</html>