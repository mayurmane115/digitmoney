<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Customers</title>
    <style>
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Customers</a>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-between my-3">
                <h3>Manage Customers</h3>
                <form role="search" class="searchform">
                    <input class="form-control " id="studentsearch" type="search" placeholder="Search" aria-label="Search">
                </form>
            </div>
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="appendemployees">
                        <?php
                        if (count($customers) > 0) {
                            $count = 1;
                            foreach ($customers as $customer) {
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $count ?></th>
                                    <td><?php echo $customer['name'] ?></td>
                                    <td><?php echo $customer['email'] ?></td>
                                    <td><?php echo $customer['mobile'] ?></td>
                                    <td><?php if ($customer['status'] == 1) {
                                            echo "Active";
                                        } else {
                                            echo "InActive";
                                        } ?></td>
                                </tr>
                            <?php $count++;
                            }
                        } else { ?>
                            <tr>
                                <td colspan='5'>
                                    No record found.
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        $(document).on('input propertychange paste', '#studentsearch', function() {
            var searchtext = $(this).val();

            $.ajax({
                url: "<?php echo base_url();?>/search/"+searchtext,
                type: 'GET',
                success: function(response) {
                   $('#appendemployees').html(response);
                }
            });
        });
    </script>
</body>

</html>