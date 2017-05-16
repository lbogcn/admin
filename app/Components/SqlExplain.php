<?php

namespace App\Components;


class SqlExplain
{

    public static function explain()
    {
        $sqls = \DB::getQueryLog();
        $rows = array();

        foreach ($sqls as $sql) {
            $results = \DB::select("Explain {$sql['query']}", $sql['bindings']);
            foreach ($results as $key => $result) {
                $result = (array)$result;
                $result['query'] = $sql['query'];
                $result['bindings'] = $sql['bindings'];
                $results[$key] = $result;
            }

            $rows = array_merge($rows, $results);
        }

        exit(view('sql_explain', ['rows' => $rows]));
    }

}