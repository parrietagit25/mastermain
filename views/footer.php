
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
      $(document).ready(function() {
          $('#tabla_date').DataTable();
      });
    </script>
    <script>
      function modal_dinamica(x){
          const datos = new URLSearchParams(x);
          datos.append('jobs', x);
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

      function modal_dinamica_edit(x, y){
          console.log('pasamdo');
          const datos = new URLSearchParams(x);
          datos.append('id_edit', x);
          datos.append('edit', y);
          const opciones = {
              method: 'POST', 
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded' 
              },
              body: datos 
          };
          fetch('views/carga_dinamica_edit.php', opciones)
                  .then(response => response.text()) 
                  .then(data => {
                      const div = document.getElementById('modal_dinamico_edit' + x);
                      div.innerHTML = data;
                  })
                  .catch(error => console.error('Error al cargar el archivo dinamico:', error));
      }

      function modal_dinamica_elim(x, y){
          const datos = new URLSearchParams(x);
          datos.append('eli_id', x);
          datos.append('elimnar', 1);
          const opciones = {
              method: 'POST', 
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded' 
              },
              body: datos 
          };
          fetch('views/carga_dinamica_elim.php', opciones)
                  .then(response => response.text()) 
                  .then(data => {
                      const div = document.getElementById('modal_dinamico_elim' + x);
                      div.innerHTML = data;
                  })
                  .catch(error => console.error('Error al cargar el archivo dinamico:', error));
      }

      function ocultar_boton(){
        document.querySelector("#subir_comision").style.display = "none";
      }

    

     $(document).ready(function() {
            $('#miSelect').select2();
      });
    </script>
  </body>
</html>