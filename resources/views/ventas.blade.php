@extends('layouts.master')
@section('titulo','Interface de ventas')
@section('contenido')
	
<div id="apiVenta">
	
	
		<div class="row">
			<div class="col-md-4">

				<div class="input-group mb-3">
	  					<input type="text" class="form-control" placeholder="Escriba el codigo del producto" aria-label="Recipient's username" aria-describedby="basic-addon2" v-model="sku"
	  					v-on:keyup.enter="buscarProducto()">
	  				<div class="input-group-append">
	   					 <button class="btn btn-primary" type="button" @click="buscarProducto()">Buscar</button>
	  				</div>
        
                 <div class="input-group-append">
                 	<button class="btn btn-success" @click="mostrarCobro()">Cobrar</button>
                 	
                 </div>      


				</div>

			
				<!-- <h1>@{{prueba}}</h1> -->

			</div>
	</div>
	





<p :align=alineacion>@{{frase}}</p>

	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">
						<thead>
							<th style="background: #ffff66">SKU</th>
							<th style="background: #ffff66">PRODUCTO</th>
							<th style="background: #ffff66">OPER.</th>
							<th style="background: #ffff66">PRECIO</th>
							<th style="background: #ffff66">CANTIDAD</th>
							<th style="background: #ffff66">TOTAL</th>
						</thead>

						<tbody>
							<tr v-for="(v,index) in ventas">
								<td>@{{v.sku}}</td>
								<td>@{{v.nombre}} 
									<img v-bind:src=v.foto width="75" height="60">
								</td>
								
								<td>
									
									
									
									<button class="btn btn-default btn-sm" @click="eliminarProducto(index)">
										<i class="fas fa-trash"></i>
									</button>
								</td>
								<td>@{{v.precio}}</td>
								<td><input type="number" v-model.number="cantidades[index]"></td>
								<td>@{{totalProducto(index)}}</td>
							</tr>
						</tbody>
					</table>

				</div>

			</div>
			<!--  FIN DEL ROW  -->
	</div> 
	<!-- FIN DEL CARD BODY -->
</div>
<!-- FIN DEL CARD -->

@{{cantidades}}
<hr>
@{{ventas}}




<div class="row">
	<div class="col-md-8"></div>
	

	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				
					<table class="table table-bordered table-condensed">
					 	<tr>
					 		<th style="background: #ffff66">Subtotal</th>
					 		<td>$ @{{subTotal}}</td>
					 	</tr>

					 	<tr>
					 		<th style="background: #ffff66">IVA</th>
					 		<td> $ @{{iva}}</td>
					 	</tr>

					 	<tr>
					 		<th style="background: #ffff66">TOTAL</th>
					 		<td><b>$ @{{granTotal}}</b></td>
					 	</tr>
						
						<tr>
							<th style="background: #ffff66">Articulos :</th>
							<td>@{{noArticulos}}</td>
						</tr>
					</table>
				
			</div>
			<!-- FIN DEL CARD BODY -->
		</div> 
		<!-- FIN DEL CARD -->
	</div>
		
<!-- Modal para el formulario del registro de los moovimientos -->
<div class="modal fade" id="modalCobro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Aqui Titulo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-row">
            <div class="col">
              <label for="inputfolio">Total</label>
              <input type="text" class="form-control" disabled :value="granTotal">
            </div>
            <div class="col">
              <label for="inputfolio">Paga con</label>
              <input type="text" class="form-control" v-model="pagara_con">
            </div>
            <div class="col">
              <label for="inputEmail4"> Su Cambio</label>
              <input type="text" class="form-control" disabled :value="cambio">
            </div>
          </div>
          
             
        
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- aqui termina el modal-->


{{-- FIN DE VENTANA MODAL --}}

			<!-- FIN DEL COL-MD-4 -->
</div>

</div>

	
@endsection

@push('scripts')
	<script type="text/javascript" src="js/vue-resource.js"></script>
	<script type="text/javascript" src="js/apis/apiVenta.js"></script>
@endpush


<input type="hidden" name="route" value="{{url('/')}}">