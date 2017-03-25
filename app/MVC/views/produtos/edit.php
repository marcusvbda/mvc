<?php include ROOT_PATH.'/app/MVC/views/template/header.php';  ?>


<div class="row">
	<div class="pull-left">
		<h1>Produtos <small>Edição</small></h1>
	</div>
</div>
<hr>
<div class="row">    		
    <form onsubmit="validaImagem()" method="POST" action="<?php echo asset('produtos/edit');?>"  enctype="multipart/form-data" onsubmit="return validaimagem();" id="form">
    	<input type="text" name="__TOKEN" id="__TOKEN" value="<?php echo __TOKEN; ?>" style="display: none;">
    	<input type="text" name="id" id="id" value="<?php echo $produto['id'];  ?>" style="display: none;">
    	<div class="row">
    		<div class="col-md-4">
	    		<label>Título</label>
	    		<input class="form-control" type="text" name="titulo" id="titulo" placeholder="Título" maxlength="50" required="" value="<?php echo $produto['titulo'];  ?>">
	    	</div>
	    	<div class="col-md-8">
	    		<label>Descrição</label>
	    		<input class="form-control" type="text" name="descricao" id="descricao" placeholder="Descrição" maxlength="150" value="<?php echo $produto['descricao'];  ?>">
	    	</div>
    	</div>
    	<div class="row">
    		<div class="col-md-2">
	    		<label>Status</label>
	    		<select class="form-control" name="status" id="status" required="">
	    			<option value="A" <?php if($produto['status']=="A"):?> selected <?php endif; ?> >Ativo</option>
	    			<option value="I" <?php if($produto['status']=="I"):?> selected <?php endif; ?> >Inativo</option>
	    		</select>
	    	</div>
	    	<div class="col-md-2">
	    		<label>Estoque</label>
	    		<input class="form-control" type="number" step="1" id="estoque" name="estoque" placeholder="Estoque" required="" value="<?php echo $produto['estoque'];  ?>">
	    	</div>
	    	<div class="col-md-8">
	    		<label>Email</label>
	    		<input class="form-control" type="email" id="email" name="email" placeholder="Email" maxlength="250" value="<?php echo $produto['email'];  ?>">
	    	</div>
	    </div>
	    <div class="row">
	    	<div class="col-md-4">
	    		<?php if($produto['imagem']!=""):?>
					<label>Imagem Atual</label><br>
					<img src="<?php echo asset('public/uploads/produtos/').$produto['imagem']; ?>" width="300px">
					<a class="btn btn-danger btn-sm" href="<?php echo asset('produtos/excluirimg/').base64_encode($produto['id']);?>">Excluir imagem</a>
				<?php endif;?>
	    	</div>
	    	<div class="col-md-4">
	    		<label>Nova Imagem</label>
	    		<input class="form-control" type="file" name="imagem" id="imagem" accept="image/*">
	    	</div>
    	</div>
    	<input type="submit" value="submit" id="btn_submit" style="display: none">  	
    </form>
    <hr>
    <div class="row">
    	<div class="pull-right">
    		<a class="btn btn-danger btn-sm" href="<?php echo asset('produtos'); ?>">Voltar</a> 
    		<button class="btn btn-primary btn-sm" onclick="validaimagem()">Alterar</button> 
    	</div>    
    </div>
</div>
<?php include ROOT_PATH.'/app/MVC/views/template/footer.php';  ?>

<script type="text/javascript">
function validaimagem() 
{
	var extensoesOk = ",.png,.jpg,.jpeg,";
	var arquivo     =  document.getElementById("imagem");
	var extensao	= arquivo.value;
	if(arquivo.value!="")
	{
		extensao = extensao.substr(extensao.length-4, 4);
		if( extensoesOk.indexOf( extensao ) == -1 )
		{ 
		 	alert("Extensão inválida !!");
		 	return false;
		}
		else 
		{
			$tamanho_max = 1000000;
			console.log(arquivo.files[0].size);
			if(arquivo.files[0].size>$tamanho_max)
			{
				alert("Tamanho máximo para imagem excedido !!!")
				return false;
			}
		}
	}
	submiter();	 
}
function submiter()
{
	document.getElementById("btn_submit").click();
}

</script>