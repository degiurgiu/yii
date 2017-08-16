<?php
/* @var $this PhotoController */
/* @var $data Photo */
?>

<div class="view">

    <div class="imgWrap">
        <?php 
          echo CHtml::link(
                    CHtml::image(Yii::app()->baseUrl.$data->getThumb(),
                            CHtml::encode($data->alt_text),array()) ,
                    Yii::app()->baseUrl.$data->getUrl(),
                    array('rel'=>'colorBox','title'=>CHtml::encode($data->alt_text))
                    );
        ?>
        
    </div>
	
    <div class="caption">
           <?php echo CHtml::encode($data->caption); ?>
    </div>
    <div class="imglcons">
        <?php
        echo "<span class='textIcon'>{$data->commentCount}</span>";
        ?>
    </div>
</div>