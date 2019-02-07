<?php

class UserMonitorController extends Controller
{
    public function actionMonitor()
    {
        
        if (!isset($manager_id)) {
            
            $status_old_s = 0;
            $status_new_s = 0;
            $manager_s = 0;
            $manager_id = 0;
            $tab = 11;                 // Стартовый отчёт для Новых
        }
        
        $status_new [0] = 'Новые';
        $status_new [1] = 'Корзина';
        
        $status_old [0] = 'Клиенты на привлечении';
        $status_old [1] = 'Закупаются';
        $status_old [2] = 'Не закупаются 15 дней';
        $status_old [3] = 'Не закупаются 30 дней';
        
        if (isset ($_POST['status_new'])) {
            $status_new_s = $_POST['status_new'];
        }
        if (isset ($_POST['status_old'])) {
            $status_old_s = $_POST['status_old'];
        }
        
        $t_start = microtime(true);
        $res = new ManagerListQuery();
        $manager_list_r = $res();
        $manager_list [0] = array("manager_id"=>"0");
        
        for ($i = 0; $i < count ($manager_list_r); $i++) {
            $manager [$i+1] = $manager_list_r [$i]['name'];
            $manager_list [$i+1]['manager_id'] = $manager_list_r [$i]['manager_id'];
        }
        
        $from_monitor = 0;
        
        if (isset($_GET['from_monitor']) and !isset($_POST['manager'])) {
            $from_monitor = $_GET['from_monitor'];
            $manager_s = $_GET['manager_s'];
            $manager_id = $manager_list [$manager_s]['manager_id'];           
        }

        if (isset ($_POST['manager']) and $_POST['manager'] == '0') {
            // Для $_POST['manager'] = 0 (Новые/Корзина) установить $tab = 11 или 12
            $tab = $status_new_s  + 11;
            $from_monitor = $tab;
            $manager_s = $_POST['manager'];
        }
        if (isset ($_POST['manager']) and $_POST['manager'] != '0') {
            // Для $_POST['manager'] > 0 (Реальный менеджер) установить $tab = 1, 2 ...
            $manager_s = $_POST['manager'];
            $tab = $status_old_s  + 1;
            $from_monitor = $tab;           
        }
                
        $manager_id = $manager_list [$manager_s]['manager_id'];       
        if (isset ($_GET['fromuserview']) and !isset ($_POST['manager']))  {
            $manager_id = $_GET['fromuserview'];
            for ($i = 0; $i < count ($manager_list); $i++) {
                if ($manager_list [$i] ['manager_id'] == $manager_id) $manager_s = $i;
            }
            $from_monitor = 1;
            
            $tab = $_GET['monitor_tabs'];
            if ($manager_s == 0) $from_monitor = 0;
            else $from_monitor = $_GET['monitor_tabs'];
        }
        
        // $table_type -Вариант формируемого Отчёта
        // $table_type = 1   Новые
        // $table_type = 3   На привлечении
        // $table_type = 4   Закупается
        // $table_type = 10  Не закупается больше 15 дней
        // $table_type = 11  Не закупается больше 30 дней
        // $table_type = 12  Нет сделок
        
        $dataProvider0 = '';
        $dataProvider1 = '';
        $dataProvider2 = '';
        $dataProvider3 = '';
        $dataProvider4 = '';
        $dataProvider5 = '';
        $dataProvider6 = '';
        $dataProvider7 = '';
        $dataProvider8 = '';
        $dataProvider9 = '';
        
        if ($manager_s == 0 and $tab != 12) $tab = 11;
        

        
        if ($tab == 11) {
            $query0 = new UsersMonitorQuery;
            $dataProvider0 = new CArrayDataProvider($query0 ('1', $manager_id ),
                ['pagination' => ['pageSize' => 700,]] );
        }
        
        if ($tab == 12) {
            $query6 = new UsersMonitorQuery;
            $dataProvider6 = new CArrayDataProvider($query6 ('21', $manager_id ),
                ['pagination' => ['pageSize' => 700,]] );
        }
        
        if ($tab == 12) {
            $query7 = new UsersMonitorQuery;
            $dataProvider7 = new CArrayDataProvider($query7 ('31', $manager_id ),
                ['pagination' => ['pageSize' => 700,]] );
        }
        
        if ($tab == 12) {
            $query8 = new UsersMonitorQuery;
            $dataProvider8 = new CArrayDataProvider($query8 ('41', $manager_id ),
                ['pagination' => ['pageSize' => 700,]] );
        }
        
        if ($tab == 12) {
            $query9 = new UsersMonitorQuery;
            $dataProvider9 = new CArrayDataProvider($query9 ('51', $manager_id ),
                ['pagination' => ['pageSize' => 700,]] );
        }
        
        if ($from_monitor == 1) {
            $query1 = new UsersMonitorQuery;
            $dataProvider1 = new CArrayDataProvider($query1 ('3', $manager_id ),
                ['pagination' => ['pageSize' => 700,]] );
            $query5 = new UsersMonitorQuery;
            $dataProvider5 = new CArrayDataProvider($query5 ('12', $manager_id ),
                ['pagination' => ['pageSize' => 700,]]);
        }
        
        if ($from_monitor == 2) {
            $query2 = new UsersMonitorQuery;
            $dataProvider2 = new CArrayDataProvider($query2 ('4', $manager_id ),
                ['pagination' => ['pageSize' => 700,]] );
        }
        
        if ($from_monitor == 3) {
            $query3 = new UsersMonitorQuery;
            $dataProvider3 = new CArrayDataProvider($query3 ('10', $manager_id ),
                ['pagination' => ['pageSize' => 700,]] );
        }
        
        if ($from_monitor == 4) {
            $query4 = new UsersMonitorQuery;
            $dataProvider4 = new CArrayDataProvider($query4 ('11', $manager_id ),
                ['pagination' => ['pageSize' => 700,]]);
        }
        
        
        $this->render('monitor', [
            'dataProvider0' => $dataProvider0,
            'dataProvider1' => $dataProvider1,
            'dataProvider2' => $dataProvider2,
            'dataProvider3' => $dataProvider3,
            'dataProvider4' => $dataProvider4,
            'dataProvider5' => $dataProvider5,
            'dataProvider6' => $dataProvider6,
            'dataProvider7' => $dataProvider7,
            'dataProvider8' => $dataProvider8,
            'dataProvider9' => $dataProvider9,
            'manager' => $manager,
            'manager_s' => $manager_s,
            'manager_id' => $manager_id,
            'from_monitor' => $from_monitor,
            't_start' => $t_start,
            'tab' => $tab,
            'status_new' => $status_new,
            'status_new_s' => $status_new_s,
            'status_old' => $status_old,
            'status_old_s' => $status_old_s,
        ]);
    }
}
