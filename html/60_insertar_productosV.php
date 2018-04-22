<br></br>
<br></br>
<br></br>
<br></br>
<div align="center">
	<h3>Insertar producto</h3>
	<div class="formulario">
		<fieldset>
	    <legend>Insertar producto:</legend>
			<p>&#42;Nombre del producto: </p>
			<input type="text" name="nombre" id="nombre"><br>
			<p>&#42;Ingredientes: </p>
			<textarea name="ingredientes" id="ingredientes"></textarea>
			<p>&#42;Tipo de producto: </p>
			<select name="tipo_producto" id="tipo_producto"><option value="-">Tipo de producto</select>
			<p>&#42;Precio: </p>
			<input type="number" name="precio" id="precio"><br>
			<p>&#42;Disponible: </p>
			<select name="disponible" id="disponible">
				<option value="si">si</option>
				<option value="no">no</option>
			</select>
			<br/><br/>
			<button class="botonformulario" id="enviar">Enviar</button>
			<button class="botonformulario" id="cancelar">Cancelar</button>
		</fieldset>
	</div>
</div>
