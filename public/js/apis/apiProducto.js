var ruta = document.querySelector("[name=route]").value;

var apiProducto = ruta + '/apiProducto';  

new Vue({
    http: {
        headers: {
          'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
      },
      el:"#producto",

      data:{
          productos:[],
          nombre:'',
          precio:'',
          cantidad:'',
          agregando:true,
          sku:'',
          buscar:'',
      },

      //Cuando se cree la pagina
      created:function(){
        this.obtenerProductos();
      },

      methods:{
        obtenerProductos:function(){
          this.$http.get(apiProducto).then(function(json){
            this.productos=json.data;
            console.log(json.data)
          }).catch(function(json){
            console.log(json);
          });
        },
        mostrarModal:function(){
          this.agregando=true;
          this.nombre='';
          this.precio='';
          this.cantidad=''; 
          $('#modalMascota').modal('show');
        },
        guardarProducto:function(){

          //Se prepara los datos del json para enviarlos al controlador
          var producto = {
            sku:this.sku,
            nombre:this.nombre,
            precio:this.precio,
            cantidad:this.cantidad
          };

          //se envian los datos dados anteriormente y se envian en formato json al controlador
          this.$http.post(apiProducto,producto).then(function(json){
            this.obtenerProductos();
            this.sku='';
            this.nombre='';
            this.precio='';
            this.cantidad='';
          }).catch(function(json){
            //console.log(json);
          });

          $('#modalMascota').modal('hide');
          console.log(producto);
        },

        eliminarProducto:function(id){
            var confir = confirm('¿Esta seguro de eliminar el producto?');

            if (confir) {
               this.$http.delete(apiProducto + '/' + id).then(function(json){
                 this.obtenerProductos();
               }).catch(function(json){
                 console.log(json);
               });
            }
        },

        editandoProducto:function(id){
          this.agregando=false;
          this.sku=id;
          this.$http.get(apiProducto + '/' + id).then(function(json){
            this.nombre=json.data.nombre;
            this.precio=json.data.precio;
            this.cantidad=json.data.cantidad;
          });
          $('#modalMascota').modal('show');
        },

        actualizarProducto:function(){
          var jsonProducto = {nombre:this.nombre,
                              precio:this.precio,
                              cantidad:this.cantidad};
          this.$http.patch(apiProducto + '/' + this.sku,jsonProducto).then(function(json){
            this.obtenerProductos();
          });
          $('#modalMascota').modal('hide');
        }

      },
      //FIN DE METHODS
})