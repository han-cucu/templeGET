<h2><?php echo h($temple['Temple']['name']); ?></h2>
<p><?php echo h($temple['Temple']['address']); ?></p>
<p><?php echo h($temple['Temple']['body']); ?></p>

<?php echo $this->Html->script('http://maps.google.com/maps/api/js?sensor=true', false); ?>
<?php echo $this->Html->script('http://maps.google.com/maps/api/js?key=AIzaSyDD0eZg02jyHglz36sEsNWvtQRIRRUW9bI &sensor=true', false); ?>
<?php
  //マップのオプション指定
  $map_options = array(
    'id' => 'map',           //地図表示させたいID名
    'width' => '500px',    //地図表示させたいIDの幅
    'height' => '500px',   //地図表示させたいIDの高さ
    'style' => '',            //地図表示のCSS
    'zoom' => 17,              //地図表示のズームレベル
    'type' => 'HYBRID',       //地図表示のタイプ
    'custom' => null,         //地図コントローラなどのオプション
    'localize' => false,       //地図表示の時にGPSで現在地を使うかどうか
    'latitude' => h($temple['Temple']['latitude']),   //地図表示の時の緯度(localizeがtrueの場合は現在地が優先されます)
    'longitude' => h($temple['Temple']['longitude']),   //地図表示の時の経度(localizeがtrueの場合は現在地が優先されます)
    //'address' => h($temple['Temple']['address']),   //地図表示の時の住所(localizeがtrueの場合は現在地が優先されます)
    'marker' => true,         //マーカーの使用
    'markerTitle' => 'This is my position',      //マーカーのタイトル
    'markerIcon' => '104350b.png',     //マーカーのアイコン
    'markerShadow' => 'http://google-maps-icons.googlecode.com/files/shadow.png',  //マーカーアイコンの影
    'infoWindow' => true,           //マーカーをクリックしたときのウインドウ表示
    'windowText' => h($temple['Temple']['name'])   //マーカーをクリックしたときのウインドウの中身
  );
?>
<div>
<?php echo $this->GoogleMap->map($map_options); ?>
</div>

<br>
<?php echo $this->Html->link('back','/temples/userpage/'); ?>
