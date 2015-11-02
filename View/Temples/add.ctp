<h2>寺を追加</h2>

<?php 
echo $this->Form->create('Temple');
echo $this->Form->input('name');
echo $this->Form->input('address');
echo $this->Form->input('body',array('rows'=>3));
echo $this->Form->end('追加する');

//$this->Form->input('フィールド名');
