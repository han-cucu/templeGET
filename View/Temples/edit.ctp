<h2>Edit temple</h2>

<?php 
echo $this->Form->create('Temple',array('action'=>'edit'));
echo $this->Form->input('name');
echo $this->Form->input('body',array('rows'=>3));
echo $this->Form->end('寺を保存');

//$this->Form->input('フィールド名');
