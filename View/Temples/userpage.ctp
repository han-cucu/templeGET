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

<!--
<?php// foreach ($user_temples as $user_temple) : 

//echo $user_temple['Temple']['latitude'];




//endforeach ;

?>-->




<!-- 緯度経度を取得した時 -->
<?php 
if(isset($this->params['url']['lati'])&&isset($this->params['url']['long'])){

    /*debug($mylati=$this->params['url']['lati']);
    debug($mylong=$this->params['url']['long']);
    $mylati=$mylati*10000000;
    $mylong=$mylong*10000000;
    

    debug($mylati);
    debug($mylong);
    
    //getaction
    foreach ($temples as $temple) : 
        $templelati=$temple['Temple']['latitude']*10000000;
        $templelong=$temple['Temple']['longitude']*10000000;
        $farlati=$mylati-$templelati;

        if($farlati>10000 || $farlati< -10000){
            $farlong=$mylong-$templelong;
            if($farlong>10000 || $farlong< -10000){
                debug($farlong);
                //get成功

                //$got = new Util\Got();
                //echo $got->getactioon($user['id'],$temple['Temple']['id']);
                
            }
        }
    endforeach;
    
*/
}
//$data = array('Users_temples' => array('user_id' => 1, 'temple_id' => 1));
//$fields = array('user_id', 'temple_id');
//$this->Users_temples->save($data, false, $fields);





?>


<!-- geolocationAPIにより緯度経度を取得し、URLに出力 -->
<?php $url = "http://localhost:8888/templeget/temples/userpage"; ?>
<script>
function do_submit(){/*ボタンを押すと処理を行う*/
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    function successCallback(position) {    /* 成功時の処理 */
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
<?php echo h($user['username']); ?>
<br>
<!-- リストへのリンク -->
<?php echo $this->Html->link("Temple List", array('controller'=>'temples','action'=>'templelist')); ?>
<br>

<!-- GETボタンの処理 -->
<input type="button" value="GET!!" onClick="do_submit();">

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
    //'markerIcon' => '104350b.png',     //マーカーのアイコン
    'markerShadow' => 'http://google-maps-icons.googlecode.com/files/shadow.png',  //マーカーアイコンの影
    'infoWindow' => true,           //マーカーをクリックしたときのウインドウ表示
    //'windowText' => h($temple['Temple']['name'])   //マーカーをクリックしたときのウインドウの中身
  );
?>
<div>
<?php echo $this->GoogleMap->map($map_options); ?><!-- 現在地を表示 -->
<?php foreach ($temples as $temple) : ?><!-- 登録された寺をマーカーで表示 -->
<?php  
  $marker_options = array(
    'showWindow' => true,         //クリックしたときのウィンドウを表示するか
    'windowText' => h($temple['Temple']['name']),     //クリックしたときのウィンドウのテキスト
    'markerTitle' => 'Title',     //マーカーのタイトル
    'markerIcon' => '104350b.png',  //マーカーアイコンの画像
 
  );
 echo $this->GoogleMap->addMarker('map', $temple['Temple']['id'], array('latitude' => $temple['Temple']['latitude'], 'longitude' => $temple['Temple']['longitude']),$marker_options); ?>
 <?php endforeach; ?>
</div>

</body>
</html>