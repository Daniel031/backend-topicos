function updateMap(estado, fecha) {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const data =  {
        estado,
        fecha
    };
    fetch('http://127.0.0.1:8000/api/index',{
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify(data)
    })
    .then(response =>response.json().then( value=>{
        console.log(` Esto me esta retornando ${estado} ${fecha} ${JSON.stringify(value)}`)
    let denuncias = value.datos;
    
    denuncias.forEach(elements => {
        elements.forEach(element=>{
            dato = element['tipo_denuncia'];
            console.log(dato);
            if(dato == '1'){
              let circle = L.circle([element['latitud'], element['longitud']], {
                      color: 'blue',
                      fillColor: 'blue',
                      fillOpacity: 0.5,
                      radius: 50
                  }).addTo(map);
      
            }
            if(dato == '2'){
              let circle = L.circle([element['latitud'], element['longitud']], {
                      color: 'red',
                      fillColor: 'red',
                      fillOpacity: 0.5,
                      radius: 50
                  }).addTo(map);
      
            }
            if(dato =='3'){
      
              let circle = L.circle([element['latitud'], element['longitud']], {
                      color: 'green',
                      fillColor: 'green',
                      fillOpacity: 0.5,
                      radius: 50
                  }).addTo(map);
            }
      
            if(dato =='4'){
              let circle = L.circle([element['latitud'], element['longitud']], {
                      color: 'black',
                      fillColor: 'black',
                      fillOpacity: 0.5,
                      radius: 50
                  }).addTo(map);
      
            }
            if(dato =="5"){
              let circle = L.circle([element['latitud'], element['longitud']], {
                      color: 'purple',
                      fillColor: 'purple',
                      fillOpacity: 0.7,
                      radius: 50
                  }).addTo(map);
      
            }
        });
       
  
    });
    })).catch((error)=>{

      console.log(error);

  });
}