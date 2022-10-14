   <hr>

    <footer>
    <p> 动漫电影信息网站&copy; PHP程序设计课程</P>
    </footer>


<!--/.container-->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->


<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="assets/js/ie10-viewport-bug-workaround.js"></script>

<script src="offcanvas.js"></script>
<script>
    $('.carousel').carousel({
        interval: 3000 //changes the speed
    })
</script>
<script>
    $(function(){
	var re=<?php 
	echo $_GET["re"];
	?>
		/*根据$re值判断是否因为登录失败返回，如果是弹出登录模态框*/
		if(re==1){
        $('#login').modal({
			
        show:true,
        backdrop:true
        });	
		}
    });
</script>

<script>
    $(function(){
	var re1=<?php 
	echo $_GET["re1"];
	?>
	
		if(re1==1){
        $('#reg').modal({
			
        show:true,
        backdrop:true
				

        });	
		
		
		}
    });
</script>
<script>
    $(function(){
	var re2=<?php 
	echo $_GET["re2"];
	?>
	
		if(re2==1){
        $('#reg').modal({
			
        show:true,
        backdrop:true
				

        });	
		
		
		}
    });
</script>
<script>
    $(function(){
	var re3=<?php 
	echo $_GET["re3"];
	?>
	
		if(re3==1){
        $('#changePassword').modal({
			
        show:true,
        backdrop:true
				

        });	
		
		
		}
    });
</script>
<script>
    $(function(){
	var re4=<?php 
	echo $_GET["re4"];
	?>
	
		if(re4==1){
        $('#changePassword').modal({
			
        show:true,
        backdrop:true
				

        });	
		
		
		}
    });
</script>
<script>
    $(function(){
	var re5=<?php 
	echo $_GET["re5"];
	?>
	
		if(re5==1){
        $('#changePassword').modal({
			
        show:true,
        backdrop:true
				

        });	
		
		
		}
    });
</script>
<script>
    $(function(){
	var re6=<?php 
	echo $_GET["re6"];
	?>
	
		if(re6==1){
        $('#login').modal({
			
        show:true,
        backdrop:true
				

        });	
		
		
		}
    });
</script>
<script>
    $(function(){
	var re7=<?php 
	echo $_GET["re7"];
	?>
	
		if(re7==1){
        $('#changeInfor').modal({
			
        show:true,
        backdrop:true
				

        });	
		
		
		}
    });
</script>
<script>
    $(function(){
	var re8=<?php 
	echo $_GET["re8"];
	?>
	
		if(re8==1){
        $('#changeInfor').modal({
			
        show:true,
        backdrop:true
				

        });	
		
		
		}
    });
</script>

<script>
    $(function(){
	var re9=<?php 
	echo $_GET["re9"];
	?>
		/*根据$re值判断是否因为登录失败返回，如果是弹出登录模态框*/
		if(re9==1){
        $('#login').modal({
			
        show:true,
        backdrop:true
        });	
		}
    });
</script>
</body>
</html>
