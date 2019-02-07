<?php


/** @var UserMonitor $data */


echo '<div class="wrapper">';
echo '<div id="tabs">';
echo '<ul class="tabs">';

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'UserMonitor',
    'method' => 'POST',
    'enableAjaxValidation' => false,
));

echo  'Менеджер ';
echo CHtml::dropDownList('manager', $manager_s, array('0' => "Новые / Корзина") + $manager);
echo ' ';
echo  ' Статус ';
if ($manager_s == 0) {
    echo CHtml::dropDownList('status_new', $status_new_s, $status_new);
}
else {
    echo CHtml::dropDownList('status_old', $status_old_s, $status_old);
}
echo ' ';

echo CHtml::submitButton('Применить' ,array('id'=>'filters-apply',));
$this->endWidget();

if ($tab == 11) {
    $from_monitor = 0;
    echo '<br>';echo '<br>';
    echo '<b>"Новые"</b>';
    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $dataProvider0,
        'columns' => array(
            array(
                'type'   => 'raw',
                'value'  => '$data->getId()',
                'header' => 'Id',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getFirstDate()',
                'header' => 'Create date',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getLastDate()',
                'header' => 'Updated',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getName()',
                'header' => 'Name',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getCityName()',
                'header' => 'City',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getStatusForManager()',
                'header' => 'Status for Manager',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getActivated()',
                'header' => 'Activated',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getComment()',
                'header' => 'Last message (comment)',
            ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}',
                'viewButtonUrl'=>'Yii::app()->getUrlManager()->createUrl("/admin/users/view/",
                         array("id" => $data->id, "usermonitor" => "YES", "monitor_tabs" => "11" ))',
            )
        )
    ));
}

if ($tab == 12) {
    $from_monitor = 0;
    echo '<br>';echo '<br>';
    echo '<b>"Корзина - Новые"</b>';
    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $dataProvider6,
        'columns' => array(
            array(
                'type'   => 'raw',
                'value'  => '$data->getId()',
                'header' => 'Id',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getFirstDate()',
                'header' => 'Create date',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getLastDate()',
                'header' => 'Updated',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getName()',
                'header' => 'Name',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getMarker()',
                'header' => 'Marker',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getCityName()',
                'header' => 'City',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getCountBoxes()',
                'header' => 'Boxes (All)',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getStatusForManager()',
                'header' => 'Status for Manager',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getManagerName()',
                'header' => 'Manager',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getActivated()',
                'header' => 'Activated',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getComment()',
                'header' => 'Last message (comment)',
            ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}',
                'viewButtonUrl'=>'Yii::app()->getUrlManager()->createUrl("/admin/users/view/",
                         array("id" => $data->id, "usermonitor" => "YES", "monitor_tabs" => "12" ))',
            )
        )
    ));
}

if ($tab == 12) {
    $from_monitor = 0;
    echo '<br>';echo '<br>';
    echo '<b>"Корзина - Старые"</b>';
    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $dataProvider7,
        'columns' => array(
            array(
                'type'   => 'raw',
                'value'  => '$data->getId()',
                'header' => 'Id',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getFirstDate()',
                'header' => 'Create date',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getLastDate()',
                'header' => 'Updated',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getName()',
                'header' => 'Name',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getMarker()',
                'header' => 'Marker',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getCityName()',
                'header' => 'City',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getCountBoxes()',
                'header' => 'Boxes (All)',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getStatusForManager()',
                'header' => 'Status for Manager',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getManagerName()',
                'header' => 'Manager',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getActivated()',
                'header' => 'Activated',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getComment()',
                'header' => 'Last message (comment)',
            ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}',
                'viewButtonUrl'=>'Yii::app()->getUrlManager()->createUrl("/admin/users/view/",
                         array("id" => $data->id, "usermonitor" => "YES", "monitor_tabs" => "12" ))',
            )
        )
    ));
}

if ($tab == 12) {
    $from_monitor = 0;
    echo '<br>';echo '<br>';
    echo '<b>"Корзина - Редкие закупки"</b>';
    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $dataProvider8,
        'columns' => array(
            array(
                'type'   => 'raw',
                'value'  => '$data->getId()',
                'header' => 'Id',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getFirstDate()',
                'header' => 'Create date',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getLastDate()',
                'header' => 'Updated',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getName()',
                'header' => 'Name',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getMarker()',
                'header' => 'Marker',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getCityName()',
                'header' => 'City',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getCountBoxes()',
                'header' => 'Boxes (All)',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getStatusForManager()',
                'header' => 'Status for Manager',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getManagerName()',
                'header' => 'Manager',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getActivated()',
                'header' => 'Activated',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getComment()',
                'header' => 'Last message (comment)',
            ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}',
                'viewButtonUrl'=>'Yii::app()->getUrlManager()->createUrl("/admin/users/view/",
                         array("id" => $data->id, "usermonitor" => "YES", "monitor_tabs" => "12" ))',
            )
        )
    ));
}

if ($tab == 12) {
    $from_monitor = 0;
    echo '<br>';echo '<br>';
    echo '<b>"Корзина - Должники"</b>';
    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $dataProvider9,
        'columns' => array(
            array(
                'type'   => 'raw',
                'value'  => '$data->getId()',
                'header' => 'Id',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getFirstDate()',
                'header' => 'Create date',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getLastDate()',
                'header' => 'Updated',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getName()',
                'header' => 'Name',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getMarker()',
                'header' => 'Marker',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getCityName()',
                'header' => 'City',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getCountBoxes()',
                'header' => 'Boxes (All)',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getStatusForManager()',
                'header' => 'Status for Manager',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getManagerName()',
                'header' => 'Manager',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getActivated()',
                'header' => 'Activated',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getComment()',
                'header' => 'Last message (comment)',
            ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}',
                'viewButtonUrl'=>'Yii::app()->getUrlManager()->createUrl("/admin/users/view/",
                         array("id" => $data->id, "usermonitor" => "YES", "monitor_tabs" => "12" ))',
            )
        )
    ));
}

if ($from_monitor == 1 and is_array($dataProvider1->rawData)) {
    
    echo '<br>';echo '<br>';
    echo '<b>"На привлечении"</b>';
    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $dataProvider1,
        'columns' => array(
            array(
                'type'   => 'raw',
                'value'  => '$data->getId()',
                'header' => 'Id',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getFirstDate()',
                'header' => 'Create date',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getLastDate()',
                'header' => 'Updated',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getName()',
                'header' => 'Name',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getCityName()',
                'header' => 'City',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getStatusForManager()',
                'header' => 'Status for Manager',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getActivated()',
                'header' => 'Activated',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getComment()',
                'header' => 'Last message (comment)',
            ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}',
                'viewButtonUrl'=>'Yii::app()->getUrlManager()->createUrl("/admin/users/view/",
                         array("id" => $data->id, "usermonitor" => $data->getManagerid(), "monitor_tabs" => "1" ))',
            )
        )
    ));
}

if ($from_monitor == 1 and is_array($dataProvider5->rawData)) {
    echo '<br>';echo '<br>';
    echo '<b>"Нет сделок"</b>';
    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $dataProvider5,
        'columns' => array(
            array(
                'type'   => 'raw',
                'value'  => '$data->getId()',
                'header' => 'Id',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getFirstDate()',
                'header' => 'Create date',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getLastDate()',
                'header' => 'Updated',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getMarker()',
                'header' => 'Marker',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getName()',
                'header' => 'Name',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getCityName()',
                'header' => 'City',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getCountBoxes()',
                'header' => 'Boxes (All)',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getTax()',
                'header' => 'Tax',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getAccountManager()',
                'header' => 'Acc. manager',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getActivated()',
                'header' => 'Activated',
            ),
            array(
                'type'   => 'raw',
                'value'  => '$data->getComment()',
                'header' => 'Last message (comment)',
            ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}',
                'viewButtonUrl'=>'Yii::app()->getUrlManager()->createUrl("/admin/users/view/",
                         array("id" => $data->id, "usermonitor" => $data->getManagerid(), "monitor_tabs" => "1" ))',
            )
        )
    ));
}

if ($from_monitor == 2) {
    echo '<br>';echo '<br>';
    echo '<b>"Закупается"</b>';
    echo '<br>';echo '<br>';
    if (is_array($dataProvider2->rawData)) {
        $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider' => $dataProvider2,
            'columns' => array(
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getId()',
                    'header' => 'Id',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getFirstDate()',
                    'header' => 'First deal',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getLastDate()',
                    'header' => 'Last deal',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getMarker()',
                    'header' => 'Marker',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getName()',
                    'header' => 'Name',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getCityName()',
                    'header' => 'City',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getCountBoxes()',
                    'header' => 'Boxes (All)',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getCountBoxes15()',
                    'header' => 'Average 15',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getProblemUsers2()',
                    'header' => '30-15',
                ),        array(
                    'type'   => 'raw',
                    'value'  => '$data->getProblemUsers()',
                    'header' => 'Last 15',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getTax()',
                    'header' => 'Tax',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getAccountManager()',
                    'header' => 'Acc. manager',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getActivated()',
                    'header' => 'Activated',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getComment()',
                    'header' => 'Last message (comment)',
                ),
                array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}',
                    'viewButtonUrl'=>'Yii::app()->getUrlManager()->createUrl("/admin/users/view/",
                         array("id" => $data->id, "usermonitor" => $data->getManagerid(), "monitor_tabs" => "2" ))',
                )
            )
        ));
    }
}

if ($from_monitor == 3) {
    
    if (is_array($dataProvider3->rawData)) {
        echo '<br>';echo '<br>';
        echo '<b>"Не закупается больше 15 дней"</b>';
        $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider' => $dataProvider3,
            'columns' => array(
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getId()',
                    'header' => 'Id',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getFirstDate()',
                    'header' => 'First deal',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getLastDate()',
                    'header' => 'Last deal',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getMarker()',
                    'header' => 'Marker',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getName()',
                    'header' => 'Name',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getCityName()',
                    'header' => 'City',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getCountBoxes()',
                    'header' => 'Boxes (All)',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getCountBoxes15()',
                    'header' => 'Average 15',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getProblemUsers2()',
                    'header' => '30-15',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getTax()',
                    'header' => 'Tax',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getAccountManager()',
                    'header' => 'Acc. manager',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getActivated()',
                    'header' => 'Activated',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getComment()',
                    'header' => 'Last message (comment)',
                ),
                array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}',
                    'viewButtonUrl'=>'Yii::app()->getUrlManager()->createUrl("/admin/users/view/",
                         array("id" => $data->id, "usermonitor" => $data->getManagerid(), "monitor_tabs" => "3" ))',
                )
            )
        ));
    }
}

if ($from_monitor == 4) {
    if (is_array($dataProvider4->rawData)) {
        echo '<br>';echo '<br>';
        echo '<b>"Не закупается больше 30 дней"</b>';
        $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider' => $dataProvider4,
            'columns' => array(
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getId()',
                    'header' => 'Id',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getFirstDate()',
                    'header' => 'First deal',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getLastDate()',
                    'header' => 'Last Deal',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getMarker()',
                    'header' => 'Marker',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getName()',
                    'header' => 'Name',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getCityName()',
                    'header' => 'City',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getCountBoxes()',
                    'header' => 'Boxes (All)',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getCountBoxes15()',
                    'header' => 'Average 15',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getTax()',
                    'header' => 'Tax',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getAccountManager()',
                    'header' => 'Acc. manager',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getActivated()',
                    'header' => 'Activated',
                ),
                array(
                    'type'   => 'raw',
                    'value'  => '$data->getComment()',
                    'header' => 'Last message (comment)',
                ),
                array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}',
                    'viewButtonUrl'=>'Yii::app()->getUrlManager()->createUrl("/admin/users/view/",
                         array("id" => $data->id, "usermonitor" => $data->getManagerid(), "monitor_tabs" => "4" ))',
                )
            )
        ));
    }
}

echo '<br> Время выполнения запроса = ' . round((microtime(true)-$t_start),2);



