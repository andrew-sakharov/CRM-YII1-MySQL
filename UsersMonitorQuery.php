<?php

class UsersMonitorQuery
{
    
    public function __invoke($table_type, $manager, $withoutFlag15Days = false)
    {
      
/**
 * 
 *    Выборка данных о статусах и активности закупок клиентов (в коробках) по менежджерам.
 *    Критерями выборки являются:
 *                               "Статус клиента для Менеджера"
 *                                  Новый
 *                                  В работе - Не дозвонились
 *                                  В работе - Общение
 *                                  Обработан - Клиент
 *                                  Обработан - Нецелевой
 *                                  Корзина - Новые
 *                                  Корзина - Старые
 *                                  Корзина - Редкие закупки
 *                                  Корзина - Должники
 *                                  
 *                               "Тип отчёта из которога запрашиваются данные"
 *                                    $table_type -     Вариант формируемого Отчёта 
 *                                    $table_type = 1   Новые
 *                                    $table_type = 3   На привлечении
 *                                    $table_type = 4   Закупается
 *                                    $table_type = 10  Не закупается больше 15 дней
 *                                    $table_type = 11  Не закупается больше 30 дней
 *                                    $table_type = 12  Нет сделок, Корзины
 *                              "Id" менеджера для которого выполняется запрос                                         
 *                                    
 */                              
        
        
        $result = [];
        
        $sql = "SELECT users.id, users.name, cities.name as city_name, users_status_for_manager.name_ru as status_for_manager,
                   users.manager_id, users.status_for_manager_id, users.role as role, users.tax,
                   DATE_FORMAT(users.create_date,'%d.%m.%Y') as create_date, DATE_FORMAT(users.updated,'%d.%m.%Y') as updated, a.name as account_manager,
                   users.activated, CONCAT(m.name, ' ', IFNULL(m.surname, ' ')) AS manager_name 
                   FROM users
                   LEFT JOIN cities ON users.city_id = cities.id
                   LEFT JOIN users_status_for_manager ON users.status_for_manager_id = users_status_for_manager.id
                   LEFT JOIN users a ON users.account_manager_id = a.id
                   LEFT JOIN users m ON users.manager_id = m.id
                   WHERE users.role = 'buyer' AND users.type = 'common' AND (users.master_user_id = 0 OR users.master_user_id IS NULL)";    
        
        
        // type = common
        
        if($withoutFlag15Days) $sql .= " AND users.notActiveIn15Days = 0";
        
        if  ($table_type == 1) $sql = $sql . " ORDER BY users.create_date DESC";
        
        $array = yii::app()->getDb()->createCommand($sql)->query();
        
        foreach ($array as $i=>$names) {
            $id = $names['id'];
            $manager_id = $names['manager_id'];
            $tax = $names['tax'];
            $name = $names ['name'];
            $city_name = $names['city_name'];
            $status_for_manager = $names['status_for_manager'];
            $status_for_manager_id = $names['status_for_manager_id'];
            $role = $names ['role'];
            $first_date = $names ['create_date'];
            $last_date = $names ['updated'];
            $account_manager = $names['account_manager'];
            $manager_name = $names['manager_name'];
            $activated_id = $names['activated'];
            if ($activated_id == 0) $activated = 'Не активирован';
            if ($activated_id == 1) $activated = 'Активирован';
            if ($activated_id == 2) $activated = 'Заблокирован';
            
            //           $balance = new Money($user->getBalanceRelationWithCurrencyWithoutPromised($currency->id, 0) * 10000);
            //           getSummaryBalance($user_id, $currency_id)
            //              BalanceHelper
            

            if ($manager_id == $manager or ($table_type == '1' or $table_type == '21' or $table_type == '31'
                or $table_type == '41' or $table_type == '51')) {
                $fl = 0;
                                                        // $table_type -Вариант формируемого Отчёта 
                                                        // $table_type = 1   Новые
                                                        // $table_type = 3   На привлечении
                                                        // $table_type = 4   Закупается
                                                        // $table_type = 10  Не закупается больше 15 дней
                                                        // $table_type = 11  Не закупается больше 30 дней
                                                        // $table_type = 12  Нет сделок
                 
                if ($table_type == '4' and $status_for_manager_id == users::CUSTOMER_PROCESSED)  $fl = 4;
                if ($table_type == '10' and $status_for_manager_id == users::CUSTOMER_PROCESSED) $fl = 10;
                if ($table_type == '11' and $status_for_manager_id == users::CUSTOMER_PROCESSED) $fl = 11;
                if ($table_type == '12' and $status_for_manager_id == users::CUSTOMER_PROCESSED) $fl = 12;
                if ($table_type == '3' and $status_for_manager_id == users::CUSTOMER_IN_WORK)  $fl = 2;
                if ($table_type == '3' and $status_for_manager_id == users::CUSTOMER_NOT_PHONED)  $fl = 3;
                if ($table_type == '1' and $status_for_manager_id == users::CUSTOMER_NEW)  $fl = 1;    
                
                if ($table_type == '21' and $status_for_manager_id == users::BASKET_NEW)  $fl = 21;  
                if ($table_type == '31' and $status_for_manager_id == users::BASKET_OLD)  $fl = 31; 
                
                if ($table_type == '41' and $status_for_manager_id == users::BASKET_RARE_PURCHASES)  $fl = 41;
                if ($table_type == '51' and $status_for_manager_id == users::BASKET_OBLIGOR)  $fl = 51; 
                
                $fl_dto = 0;                
                if ($fl > 0) {
                    $problem_users =0;
                    $problem_users2 =0;
                    $problem_users3 = 0;
                    $comment ='';
                    $marker = '-';
                    $count_boxes = 0;
                    $count_boxes15 = 0;
                    $problem_users =0;
                    $problem_users2 =0;
                    $problem_users3 = 0;                     
                    
                    $comment_count = yii::app()->getDb()->createCommand("SELECT COUNT(*) FROM users_comments WHERE entity_id = '$id'  ORDER BY create_date DESC limit 1")->queryScalar();
                    if ($comment_count > 0) {
                        $comment = yii::app()->getDb()->createCommand("SELECT  SUBSTRING(CONCAT(DATE_FORMAT(create_date,'%d.%m.%Y'), ': ', message), 1, 50) FROM users_comments WHERE entity_id = '$id'  ORDER BY create_date DESC limit 1")->queryScalar();
                        $comment = '(' . $comment_count . ' из ' . $comment_count . ') ' . $comment;
                    }
                    
                    if ($fl >= 4 and $role == 'buyer') {
                        $marker = yii::app()->getDb()->createCommand("SELECT marker FROM users_relations WHERE user_id_to = '$id' limit 1 ")->queryScalar();                     
                        
                        $count = yii::app()->getDb()->createCommand("SELECT SUM(boxes_amount) as count_boxes,
                                           MIN(create_date) as min_date, MAX(create_date) as max_date
                                           FROM billing_deals_log WHERE buyer_id = '$id'")->queryAll();
                        
                        $date_first = $count[0]['min_date'];
                        $date_last = $count[0]['max_date'];
                        $count_boxes = $count[0]['count_boxes'];
                                                
                        $datetime1 = date_create(substr($date_first,0,10));
                        $datetime2 = date_create(substr($date_last,0,10));
                        $interval = date_diff($datetime1, $datetime2);
                                               
                        $delta = $interval->format('%R%a')/15;
                       
                        if (strlen(substr($date_first,0,10)) > 0) {
                            $first_date = substr($date_first,8,2) . '.' . substr($date_first,5,2) . '.' . substr($date_first,0,4);
                            $last_date = substr($date_last,8,2) . '.' . substr($date_last,5,2) . '.' . substr($date_last,0,4);
                        }                                                                              // Среднее за 15 дней                        
                        $timestamp = $delta;

                        if (is_null($marker)) $marker = '-';
                        $fl_truck = 0;
                        if (strrpos ($marker, 'TRUCK') > 0) $fl_truck = 1;
                        if ($fl_truck == 0) {             
                           
                            if   ($timestamp == 0) $timestamp = 1;
                            $count_boxes15 = $count_boxes/$timestamp;
                            $count_boxes15 = round ($count_boxes15, 0);
                           
                            $problem_users = yii::app()->getDb()->createCommand("SELECT SUM(boxes_amount) FROM billing_deals_log 
                                WHERE buyer_id = '$id' 
                                AND TO_DAYS(NOW()) - TO_DAYS(create_date) <= 15 ")->queryScalar();                            
                           
                            $problem_users2 = yii::app()->getDb()->createCommand("SELECT SUM(boxes_amount) FROM billing_deals_log 
                                WHERE buyer_id = '$id' 
                                AND TO_DAYS(NOW()) - TO_DAYS(create_date) <= 30 AND TO_DAYS(NOW()) - TO_DAYS(create_date) > 15")->queryScalar();
                            
                            $problem_users3 = $count_boxes;
                                                       
                            if ($fl == 4 and $problem_users >= 1) $fl_dto = 4;                          
                            if ($fl == 10 and $problem_users == 0 and $problem_users2 != 0) $fl_dto = 10;                            
                            if ($fl == 11 and $problem_users2 == 0  and $problem_users == 0 and $problem_users3 > 0 ) $fl_dto = 11;
                            if ($fl == 12 and $problem_users3 == 0)  $fl_dto = 12;
                            
                            if ($fl == 21 and $status_for_manager_id == users::BASKET_NEW)  $fl_dto = 21;
                            if ($fl == 31 and $status_for_manager_id == users::BASKET_OLD)  $fl_dto = 31;
                            
                            if ($fl == 41 and $status_for_manager_id == users::BASKET_RARE_PURCHASES)  $fl_dto = 41;
                            if ($fl == 51 and $status_for_manager_id == users::BASKET_OBLIGOR)  $fl_dto = 51;
                            
                        }
                    }
                    else {
                        $fl_dto = 1;                       
                        
                    }                     
                }
                if ($fl_dto > 0)
                    $result[] = new UserMonitorDTO ($id, $activated, $manager_id, $name, $city_name, $status_for_manager, $marker, 
                        $count_boxes, $count_boxes15, $problem_users, $problem_users2, $problem_users3, $comment, $first_date, $last_date, 
                        $account_manager, $tax, $manager_name);
            }
        }
        
        return $result;
    }
}