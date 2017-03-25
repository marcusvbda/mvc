<?php include ROOT_PATH.'/app/MVC/views/template/header.php';  ?>


<div class="row">
	<div class="pull-left">
		<h1>Produtos</h1>
	</div>
	<div class="pull-right">
		<h1><button class="btn btn-primary btn-sm" onclick="Novo()">Cadastrar</button></h1>
	</div>
</div>
<hr>
<div class="row">    		
    <table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Descrição</th>
				<th>Status</th>
				<th>Estoque</th>
				<th>Email</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($produtos as $prod): ?>
			<tr>
				<td><?php echo $prod['id']; ?></td>
				<td><?php echo $prod['descricao']; ?></td>
				<td><?php echo $prod['status']; ?></td>
				<td><?php echo $prod['estoque']; ?></td>
				<td><?php echo $prod['email']; ?></td>
				<td>
					<button class="btn btn-danger btn-sm" onclick="Excluir(<?php echo $prod['id']; ?>)">Excluir</button>
					<button class="btn btn-primary btn-sm" onclick="Ver(<?php echo $prod['id']; ?>)">Visualizar</button>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
	<!-- row -->
<script type="text/javascript">
function Excluir(id)
{
	if (confirm("Excluir ?"))
	{
		send('POST',"<?php echo asset('produtos/delete');  ?>",{id},"<?php echo __TOKEN;  ?>");
	}
}
</script>


<?php include ROOT_PATH.'/app/MVC/views/template/footer.php';  ?>