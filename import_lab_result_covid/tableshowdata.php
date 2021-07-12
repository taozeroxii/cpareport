<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All data In Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="row ">
            <div class="col-3"><a href="./"> <button class="btn btn-success">กลับหน้าแรก</button> </a></div>
            <div class="col-9">
                <h5>ข้อมูลทั้งหมดในฐานข้อมูล</h5>
            </div>
        </div>

        <hr>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-dark">
                    <th> #</th>
                    <th> vn_lab</th>
                    <th> send_department</th>
                    <th> recieve_department</th>
                    <th> objective</th>
                    <th> cid</th>
                    <th> sent_date</th>
                    <th> status</th>
                    <th> passport</th>
                    <th> birth</th>
                    <th> pre_name</th>
                    <th> name</th>
                    <th> lname</th>
                    <th> name_eng</th>
                    <th> lname_eng</th>
                    <th> collection_date</th>
                    <th> results</th>
                    <th> results_date</th>
                    <th> approve_results</th>
                    <th> approve_date</th>
                    <th> remark </th>

                </thead>

                <tbody>
                    <?php
                    $r = 1;
                    $mysqli = new mysqli("172.18.2.2", "webcvhost", "WebCpa10665Hos!", "lab_rs_covid_19");
                    $select = "select * FROM lab_result ";
                    $query  = mysqli_query($mysqli, $select);
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?php echo  $r++;?></td>
                            <td><?php echo $row['vn_lab'] ?></td>
                            <td><?php echo $row['send_department'] ?></td>
                            <td><?php echo $row['recieve_department'] ?></td>
                            <td><?php echo $row['objective'] ?></td>
                            <td><?php echo $row['cid'] ?></td>
                            <td><?php echo $row['sent_date'] ?></td>
                            <td><?php echo $row['status'] ?></td>
                            <td><?php echo $row['passport'] ?></td>
                            <td><?php echo $row['birth'] ?></td>
                            <td><?php echo $row['pre_name'] ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['lname'] ?></td>
                            <td><?php echo $row['name_eng'] ?></td>
                            <td><?php echo $row['lname_eng'] ?></td>
                            <td><?php echo $row['collection_date'] ?></td>
                            <td><?php echo $row['results'] ?></td>
                            <td><?php echo $row['results_date'] ?></td>
                            <td><?php echo $row['approve_results'] ?></td>
                            <td><?php echo $row['approve_date'] ?></td>
                            <td><?php echo $row['remark'] ?></td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>