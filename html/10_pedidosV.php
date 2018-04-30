<br></br>
<br></br>
<br></br>
<br></br>
<br></br>
<div  id="centro" align="center">
	<h3>Pedidos</h3>
	<div class="formulariopedido">
		<fieldset>
	<legend>Realizar pedido:</legend>
		<form name="registro">
			<p>&#42;Pizzas: 
				<select name="pizza" id="pizza" ><option value="-">&nbsp; Pizzas</select>
				&nbsp;&nbsp;&nbsp;&nbsp;Cantidad:<input type="number" value="1" id="pizzacantidad"></input>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" value="Añadir" id="anadirpizza"></input>
			</p>
			<br/><br/>

			<p>&#42;Bebidas: 
				<select name="bebida" id="bebida"><option value="-">Bebidas</select>
				&nbsp;&nbsp;&nbsp;&nbsp;Cantidad:<input type="number" value="1" id="bebidacantidad"></input>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" value="Añadir" id="anadirbebida"></input>
			</p>
			<br/><br/>

			<p>&#42;Postres:
				<select name="postre" id="postre"><option value="-">Postres</select>
				&nbsp;&nbsp;&nbsp;&nbsp;Cantidad:<input type="number" value="1" id="postrecantidad"></input>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" value="Añadir" id="anadirpostre"></input>
			</p>
			<br/><br/>	
		</form>
		</fieldset>
	</div>
	<div class="formulariopedido">
		<fieldset>
			<legend>Detalle del pedido:</legend>
		
				<div id="listadelpedido"><p>Ningún producto seleccionado</p></div>
		

		<button class="botonformulario" id="confirmar">Confirmar</button>
		<button class="botonformulario" id="cancelar">Cancelar</button>
		<br></br>
		</fieldset>
	</div>
</div>
<div id="datospedido" style="display: none">
	<p id="cargardetallepedido"></p>
</div>
<div id="transparencia" class="transparencia" style="display: none"></div>
<div id="datosenvio" class="datosenvio" style="display: none">
	<div class="formulariopedido">
		<button class="cierraModal" id="cerrarmodal"> &#10060; </button>
		<fieldset>
		<legend>Datos del cliente:</legend>
			</br>
			Nombre del cliente: <input type="text" id="nombrecliente"></input>
			</br>
			Hora de activación: <input type="timeline" id="horaactivacion"></input>
			</br>
			Comentarios: <textarea id="comentarios"></textarea>
			</br>
			Dirección de entrega: <textarea type="text" id="direccion"></textarea>
			</br>
			Teléfono: <input type="text" id="telefono"></input>
			</br>
			</br>
			<button class="botonformulario" id="confirmardatosenvio">Confirmar</button>
		</fieldset>
	</div>
</div>