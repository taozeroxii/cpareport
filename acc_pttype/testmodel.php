<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include "navbar.php";
    include("../config/my_con.class.php");
    include("../config/pg_con.class.php");

    $reportmenyu = "select * from ovst limit 10";
    $qreportmenyu = pg_query($conn, $reportmenyu);
    ?>
    <div class="container">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">vn</th>
                    <th scope="col">hn</th>
                    <th scope="col">vstdate</th>
                    <th scope="col">vsttime</th>
                    <th scope="col">button</th>
                </tr>
            </thead>
            <tbody>

                <?php while ($property = pg_fetch_assoc($qreportmenyu)) { ?>
                    <tr>
                        <td><?php echo $property['vn'] ?></td>
                        <td><?php echo $property['hn'] ?></td>
                        <td><?php echo $property['vstdate'] ?></td>
                        <td><?php echo $property['vsttime'] ?></td>
                        <td><button type="button" class="btn btn-primary edit"> test modal <?php echo $property['vn']; ?> </button></td>
                    </tr>
                <?php } ?>


            </tbody>
        </table>





        <!-- Modal -->
        <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">test EDIT</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="vn">vn</label>
                        <input id="vn" type="text" class="form-control" />

                        <label for="hn">hn</label>
                        <input id="hn" type="text" class="form-control" />

                        <label for="vstdate">vstdate</label>
                        <input id="vstdate" type="text" class="form-control" />

                        <label for="vsttime">vsttime</label>
                        <input id="vsttime" type="text" class="form-control" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <script>
        $(document).ready(function() {
            $('.edit').on('click', function() {
                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                $('#vn').val(data[0]);
                $('#hn').val(data[1]);
                $('#vstdate').val(data[2]);
                $('#vsttime').val(data[3]);

                console.log(data);
            });
        });
    </script>
</body>

</html>