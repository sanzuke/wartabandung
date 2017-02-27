// JavaScript Document

	$("#frmLogin").submit(function(){
		$.ajax({
			type	:"POST",
			url		:$(this).attr("action"),
			data	:$(this).serialize(),
			success : function(){
				$("#container").load("module/home.php")
				
			}
		})
		return 
	})


