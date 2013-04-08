<!--Nav bar area-->

<div class="navbar">
	<div class="navbar-inner">
		<a class="brand" href="<?php echo $this->config->base_url();?>"><?php echo $common_title;?></a>
		<div class="container">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="nav-collapse collapse  navbar-responsive-collapse">
				<ul class="nav">
				<li <?php if($this->router->class == "tables"){ echo "class=\"active\"";}?>>
					<a href="<?php echo $this->config->base_url();?>index.php/tables/index/"><?php echo $common_table_list;?></a>
				</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!--Nav bar area end-->