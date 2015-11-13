<?php

?>
<!DOCTYPE html>
<html>
<head>
<style>
    body { padding:5px; }
    h1 { font-size:18pt; background-color:#EEEEFF; }
</style>
<body>

<!-- geolocationAPIにより緯度経度を取得し、URLに出力 -->
<?php $url = "http://localhost:8888/templeget/temples/userpage"; ?>
<script>
function do_submit(){/*ボタンを押すと処理を行う*/
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    /* 成功時の処理 */
    function successCallback(position) {    
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        if(latitude){   
            location.href = "<?php echo $url; ?>?lati=" + latitude + "&long=" + longitude;
        }
        
    }
    function errorCallback(error) { /* 失敗時の処理 */
        location.href = "<?php echo $url; ?>?alart=on";
    }
}
</script>

<!-- ユーザー情報を表示 -->
<p>
<font size="7">
<?php echo h($user['username']); 
$count = 0;
foreach ($user_temples as $usertemple) :
    $count = $count + 1;
endforeach; ?>
<?php echo '   '.$count.'00 pt';?>
</font>
</p>

<!-- 更新 -->
<button type="button" name="update" value="update">
<font size="6">
<?php echo $this->Html->link('update', array('controller'=>'temples','action'=>'userpage')); ?>
</font>
</button>
<br>
<!-- リストへのリンク -->
<button type="button" name="templelist" value="templelist">
<font size="6">
<?php echo $this->Html->link("Temple List", array('controller'=>'temples','action'=>'templelist')); ?>
</font>
</button>
<br>
<!-- GETボタンの処理 -->
<p><input type="button" value="GET!!" onClick="do_submit()";></p>

<p><?php echo $this->Html->image('acq_temple.png'); ?><font size="3">・・・Acquired temple   </font>
<?php echo $this->Html->image('unacq_temple.png'); ?><font size="3">・・・Unacquired temple</font></p>




<!-- マップを表示 -->
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
    'localize' => true,       //地図表示の時にGPSで現在地を使うかどうか
    //'latitude' => h($temple['Temple']['latitude']),   //地図表示の時の緯度(localizeがtrueの場合は現在地が優先されます)
    //'longitude' => h($temple['Temple']['longitude']),   //地図表示の時の経度(localizeがtrueの場合は現在地が優先されます)
    'marker' => true,         //マーカーの使用
    'markerTitle' => 'This is my position',      //マーカーのタイトル
    'markerIcon' => 'user.png',     //マーカーのアイコン
    'markerShadow' => 'http://google-maps-icons.googlecode.com/files/shadow.png',  //マーカーアイコンの影
    'infoWindow' => true,           //マーカーをクリックしたときのウインドウ表示
    'windowText' => 'Hello, Iam '.$user['username'].'!'   //マーカーをクリックしたときのウインドウの中身
  );
?>
<div>
<!-- 現在地を表示 -->
<?php echo $this->GoogleMap->map($map_options); ?>
<!-- 取得済の寺、未取得の寺をマーカーで表示 -->
<?php foreach ($temples as $temple){ ?>
    <?php $acq_or_unacq = 0; ?>
    <?php foreach ($user_temples as $usertemple){ ?>
        <?php if($temple['Temple']['id'] == $usertemple['UserTemple']['temple_id']){
            $acq_or_unacq = 1;
        } ?>    
    <?php } ?>
    <?php if($acq_or_unacq == 1){
            $acq_marker_options = array(
                'showWindow' => true,         //クリックしたときのウィンドウを表示するか
                'windowText' => $temple['Temple']['name'],     //クリックしたときのウィンドウのテキスト
                'markerTitle' => 'Title',     //マーカーのタイトル
                'markerIcon' => 'acq_temple.png',  //マーカーアイコンの画像
            );
            echo $this->GoogleMap->addMarker('map', $temple['Temple']['id'], array('latitude' => $temple['Temple']['latitude'], 'longitude' => $temple['Temple']['longitude']),$acq_marker_options); 
    } ?>
    <?php if($acq_or_unacq == 0){
        $unacq_marker_options = array(
        'showWindow' => true,         //クリックしたときのウィンドウを表示するか
        'windowText' => h($temple['Temple']['name']),     //クリックしたときのウィンドウのテキスト
        'markerTitle' => 'Title',     //マーカーのタイトル
        'markerIcon' => 'unacq_temple.png',  //マーカーアイコンの画像
        );
        echo $this->GoogleMap->addMarker('map', $temple['Temple']['id'], array('latitude' => $temple['Temple']['latitude'], 'longitude' => $temple['Temple']['longitude']),$unacq_marker_options);
    } ?>
<?php } ?>

</div>

</body>
</html>