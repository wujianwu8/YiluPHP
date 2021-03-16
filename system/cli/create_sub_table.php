<?php
/*
 * 创建新的分表，按照目前全表实现规则，只需要在每天的凌晨3点半和4点各执行一次就行
 * 运行方式如：/usr/local/php8.0.2/bin/php /data/web/api.hey-cyber.com/yilu create_sub_table
 * YiluPHP vision 2.0
 * User: Jim.Wu
 * Date: 2021.01.01
 * Time: 11:19
 */

//获取所有主表名称
if($table_list = model_sub_table_manage::I()->select_all([],'','DISTINCT main_table')){
    foreach ($table_list as $item){
        //获取正在使用的表名
        $where = [
            'main_table' => $item['main_table'],
            'start_time' => [
                'value' => time(),
                'symbol' => '<=',
            ],
        ];
        if(!$sub_tables = model_sub_table_manage::I()->paging_select($where,1,2,'start_time DESC','id,sub_table,connection,model_name')){
            continue;
        }
        $sub_table = $sub_tables[0];
        $main_tab = $item['main_table'];
        $model = $sub_table['model_name'];
        if (empty($model::I()->_max_quantity_per_table)){
            continue;
        }

        //获取表中已有数量
        $count = $model::I()->find_table([],'COUNT(1) AS c');
        $count = $count['c'];
        $where = ['id'=>$sub_table['id']];
        $data = ['count'=>$count];
        model_sub_table_manage::I()->update_table($where,$data);
        if ($count>=$model::I()->_max_quantity_per_table){
            $start_time = strtotime('tomorrow');
            $tab_name = $main_tab.date('_Ymd', $start_time);
            $connection = $model::I()->get_connection();
            //创建新的数据表
            $sql = "CREATE TABLE IF NOT EXISTS {$tab_name} SELECT * FROM {$main_tab} WHERE 1=2";
            $stmt = mysql::I($connection)->prepare($sql);
            $stmt->execute();
            $effect_count = $stmt->rowCount();

            if (!$tmp=model_sub_table_manage::I()->find_table(['main_table' => $main_tab,'sub_table' => $tab_name])) {
                //添加创建新表的配置
                $data = [
                    'main_table' => $main_tab,
                    'sub_table' => $tab_name,
                    'connection' => $connection,
                    'model_name' => $sub_table['model_name'],
                    'start_time' => $start_time,
                    'create_time' => time(),
                ];
                model_sub_table_manage::I()->insert_table($data);
                //更新当前表的结束
                $where = ['id'=>$sub_table['id']];
                $data = ['end_time'=>$start_time];
                model_sub_table_manage::I()->update_table($where,$data);
            }
        }

        if (count($sub_tables)>1) {
            //更新上一个数据表的冗余数据量
            $sub_table = $sub_tables[1];
            $tab_name = $sub_table['sub_table'];
            $connection = $sub_table['connection'];
            $sql = "SELECT COUNT(1) AS c FROM {$tab_name}";
            $stmt = mysql::I($connection)->prepare($sql);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            $res['c'];
            $where = ['id'=>$sub_table['id']];
            $data = ['count'=>$res['c']];
            model_sub_table_manage::I()->update_table($where,$data);
        }
    }
}
