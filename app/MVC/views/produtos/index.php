<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo APP_NAME;?></title>
    <link href="<?php echo asset('/assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
  </head>
  <body>

    <div class="container">
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
	</div>
	<!-- container -->

  </body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
	$.fn.FormData = function()
	{
	    var o = {};
	    var a = this.serializeArray();
	    $.each(a, function() {
	        if (o[this.name] !== undefined) {
	            if (!o[this.name].push) {
	                o[this.name] = [o[this.name]];
	            }
	            o[this.name].push(this.value || '');
	        } else {
	            o[this.name] = this.value || '';
	        }
	    });
	    return o;
	};	


	function ajax(method,url,data,callback)
	{
		method=method.toLowerCase();
		$.ajax(
		{
			url  : url,
			type : method,
			data : data,
			dataType: "json",
			success: function(response) 
			{	
			  	return callback(response);				  	
			},
			error: function (request, error) 
			{
		        console.log(request.statusText);
		    }
		});   
	}


	function reload(refresh=true)
	{
		var url = document.location.pathname;
		if(refresh)
			location.reload();
		else
	      $("body").load(url);		
	}

	function reload_div(div)
	{
	    $(div).load(location.href+' '+div);
	}

	function load(url,refresh=true)
	{
		if(refresh)
			location.href=url;
		else
	       $("body").load(url);				
	}


	function Excluir(id)
	{
		if (confirm("Excluir ?"))
		{
			ajax("POST","<?php echo asset('destroy');?>",{id},function(response)
			{
				reload(false);
			});
		}
	}
</script>