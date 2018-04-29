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
		
				<div id="listadelpedido"></div>
		

		<button class="botonformulario" id="enviar">Confirmar</button>
			<button class="botonformulario" id="cancelar">Cancelar</button>
		</fieldset>
	</div>
</div>
<div id="datospedido" style="display: inline">
		<p id="numlineas">0</p>
</div>