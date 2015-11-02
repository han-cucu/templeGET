<h2>Temple List</h2>

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
<?php echo $this->Html->link('Add Temple', array('controller'=>'temples','action'=>'add')); ?>
<h2>Temple List</h2>
<?php echo $this->Html->link('Temple List',array('controller'=>'temples','action'=>'templelist'));
//$this->Html->link(表示する文字,リンク先);
?>