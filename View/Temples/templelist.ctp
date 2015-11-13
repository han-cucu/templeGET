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

<br>
<?php echo $this->Html->link('back', array('controller'=>'temples','action'=>'userpage')); ?>



<?php debug($user_temples); ?>
<?php $count = 0;?>
<?php foreach ($user_temples as $usertemple) : ?>
<?php echo $usertemple['UserTemple']['temple_id'];?>
<?php $count = $count + 1;?>
<?php endforeach; ?>
<br>
<?php echo 'coumt got temple ->'.$count;?>



