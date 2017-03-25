		</div>
	<!-- container -->

  </body>
</html>


<script type="text/javascript">
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


	function send(method,url,JSON = {},token)
	{
		var form = "<form hidden action='"+url+"' name='___FORM___' id='___FORM___' method='"+method+"'>";
		for (var campo in JSON) 
		{
		   form+="<input id='"+campo+"' name='"+campo+"'  value='"+JSON[campo]+"'>";
		}
		 form+="<input id='__TOKEN' name='__TOKEN'  value='"+token+"'>";

		form+="</form>";
		var form_ =  document.createElement("h1")
		form_.innerHTML = form;
		document.body.appendChild(form_);
		document.___FORM___.submit();
	}


</script>