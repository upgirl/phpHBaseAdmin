<script>
$.getJSON('<?php echo $this->config->base_url();?>index.php/tables/tablelist/', function(json){
	var names = json.table_names;
	var html="";
	$('#tablenames').empty();
	$.each(names,function(index, content){
		html += '<tr><td> <i class="icon-zoom-in"></i> ';
		html += '<a href="<?php echo $this->config->base_url();?>index.php/tables/gettableregions/' + content + '">'+ content +'</a>';
		html += '</td></tr>';
	});
	$('#tablenames').append(html);
});
</script>

<div class="span2">
	<table class="table table-hover" id="tablenames">
		
	</table>
</div>