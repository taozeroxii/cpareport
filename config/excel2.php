<?php
require "pg_con.class.php";

$result = " SELECT  a.pdx,i.tname,count(a.*) as cc
                  from an_stat a
                  left outer join icd101 i on a.pdx=i.code
                  where a.dchdate between '2019-03-01' AND '2019-03-30'
                  AND a.pdx not like 'Z%%' AND a.pdx <> '' AND a.pdx is not null
                  group by a.pdx,i.tname
                  order by count(a.*) desc
                  limit 10'";

$i = 0;
while ($i < pg_num_fields($result)) {
    echo "Information for column $i:<br />\n";
    $meta = pg_fetch_field($result, $i);
    if (!$meta) {
        echo "No information available<br />\n";
    }
    echo "<pre>
blob:         $meta->blob
max_length:   $meta->max_length
multiple_key: $meta->multiple_key
name:         $meta->name
not_null:     $meta->not_null
numeric:      $meta->numeric
primary_key:  $meta->primary_key
table:        $meta->table
type:         $meta->type
unique_key:   $meta->unique_key
unsigned:     $meta->unsigned
zerofill:     $meta->zerofill
</pre>";
    $i++;
}
pg_free_result($result);
?>