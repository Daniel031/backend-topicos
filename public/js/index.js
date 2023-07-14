
function onChangeSelect() {
    
    const selectFecha = document.getElementById('fecha');
    const selectEstado = document.getElementById('estado');
    const valor1 = selectFecha.value;
    const valor2 = selectEstado.value;

    // // Objeto con los valores a enviar
    console.log("Fecha: "+valor1);
    console.log("Estado: "+valor2);
    const data = {
      estado: valor1,
      fecha: valor2
    };
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    // Realizar la petición utilizando fetch
    fetch(`${getApiUrl()}/api/filtrar-denuncias`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token
      },
      body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
    
     let denuncias = data.datos;
     
    console.log(denuncias);
     if(puntos.length>0){       // ELIMINAR PUNTOS ANTERIORES Y MOSTRAR NUEVOS
       
          puntos.forEach(ele=>{
            map.removeLayer(ele);
          });
          
       puntos =[];
     }
     denuncias.forEach(elements=>{
      elements.forEach(element=>{
      let circle = null;
      dato = element['tipo_denuncia'];
      

        if(dato == '1'){
          circle = L.circle([element['latitud'], element['longitud']], {
                  color: 'blue',
                  fillColor: 'blue',
                  fillOpacity: 0.5,
                  radius: 50
              }).addTo(map);
          
        }
        if(dato == '2'){
          circle = L.circle([element['latitud'], element['longitud']], {
                  color: 'red',
                  fillColor: 'red',
                  fillOpacity: 0.5,
                  radius: 50
              }).addTo(map);
            
        }
        if(dato =='3'){

          circle = L.circle([element['latitud'], element['longitud']], {
                  color: 'green',
                  fillColor: 'green',
                  fillOpacity: 0.5,
                  radius: 50
              }).addTo(map);
          
        }

        if(dato =='4'){
          circle = L.circle([element['latitud'], element['longitud']], {
                  color: 'black',
                  fillColor: 'black',
                  fillOpacity: 0.5,
                  radius: 50
              }).addTo(map);
            

        }
        if(dato =="5"){
          circle = L.circle([element['latitud'], element['longitud']], {
                  color: 'purple',
                  fillColor: 'purple',
                  fillOpacity: 0.7,
                  radius: 50
              }).addTo(map);
          
        }

        if (circle) {
          puntos.push(circle);
        }


        circle.bindPopup(`Denuncia:${element['descripcion']} <br>
                                    Titulo: ${element['titulo']} <br>
                                    Fecha : ${element['fecha']}<br>
                                   <a class="btn btn-sm btn-warning" href="${getApiUrl()}/buzon/showDenuncia/${element['id']}">Ver Denuncia</a><br>

                                    
                                    `);

    });// aqui va
  });

    })
    .catch(error => {
      
    });

}