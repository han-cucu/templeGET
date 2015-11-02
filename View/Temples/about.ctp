<h2>About Temple Get</h2>
<p>this is game. get point by visiting temple.</p>

<!--
<ul>
<?php foreach ($temples as $temple) : ?>
<li id="temple_<?php echo h($temple['Temple']['id']); ?>">
<?php
//echo h($temple['Temple']['name']);
//echo "<br>".h($temple['Temple']['body']);

echo $this->Html->link($temple['Temple']['name'],'/temples/view/'.$temple['Temple']['id']);
//$this->Html->link(表示する文字,リンク先);
?>
 

</li>
<?php endforeach; ?>
</ul>

<h2>Add Temple</h2>
<?php //echo $this->Html->link('Add Temple', array('controller'=>'temples','action'=>'add')); ?>

<?php echo $this->Html->link("Let's Go Temple!!", array('controller'=>'users','action'=>'index')); ?>


<script>
$(function(){
	$('a.delete').click(function(e){
		if(confirm('削除してよろしいですか？')) {
			$.post('/temple/temples/delete/'+$(this).data('temple-id'), {}, function(res){
				$('#temple_'+res.id).fadeOut();
			},"json");
		}
		return false;
	});
});
</script>
-->
