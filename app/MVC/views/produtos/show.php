<?php include ROOT_PATH.'/app/MVC/views/template/header.php';  ?>


<div class="row">
	<div class="pull-left">
		<h1>Produtos <small>Visualização</small></h1>
	</div>
</div>
<hr>
<div class="row">    		
    <div class="row">
    	<div class="col-md-4">
			<label>Título</label>
			<input class="form-control" type="text"  placeholder="Título" disabled value="<?php echo $produto['titulo'];  ?>">
		</div>
		<div class="col-md-8">
			<label>Descrição</label>
			<input class="form-control" type="text"  placeholder="Descrição" disabled value="<?php echo $produto['descricao'];  ?>">
		</div>
    </div>
    <div class="row">
    	<div class="col-md-2">
			<label>Status</label>
			<?php if($produto['status']==uppertrim('A')):?>
				<input class="form-control" type="text" value="Ativo" disabled>
			<?php else:?>
				<input class="form-control" type="text" value="Inativo" disabled>
			<?php endif;?>
		</div>
		<div class="col-md-2">
			<label>Estoque</label>
			<input class="form-control" type="number" disabled value="<?php echo $produto['estoque'];  ?>">
		</div>
		<div class="col-md-8">
			<label>Email</label>
			<input class="form-control" type="email" placeholder="Email" disabled value="<?php echo $produto['email'];  ?>">
		</div>		
    </div>
    <div class="row">
    	<div class="col-md-12">
			<?php if($produto['imagem']!=""):?>
				<label>Imagem</label><br>
				<img src="<?php echo asset('public/uploads/produtos/').$produto['imagem']; ?>" width="300px">
			<?php endif;?>
		</div>
    </div>
    <hr>
    <div class="row">
    	<div class="pull-right">
    		<a class="btn btn-danger btn-sm" href="<?php echo asset('produtos'); ?>">Voltar</a>     	
    		<a class="btn btn-primary btn-sm"  href="<?php echo asset('produtos/edit/').base64_encode($produto['id']); ?>">Editar</a>
    	</div>
    </div>
</div>

<?php include ROOT_PATH.'/app/MVC/views/template/footer.php';  ?>