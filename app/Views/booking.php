<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a meeting room</title>

    <!-- bootstap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- font awesome 6.1.1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- datatable -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- toast alert -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" rel="stylesheet" media="all">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

    <style>
        .header-web {
            margin-top: 5rem !important;
            margin-bottom: 2rem !important;
            color: #00a418;
            padding: 10px;
        }

        .section-table {
            margin: auto;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 700px;
        }
    </style>
</head>

<body>
    <!-- app content -->
    <div id="app" class="container">

        <div class="header-web text-center m-auto">
            <h1>จองห้องประชุม</h1>
        </div>

        <div class="body-centent">
            <div class="section-table">
                <table id="myTable" class="table caption-top table-striped" style="width:100%">
                    <caption>รายการห้องประชุม</caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ชื่อห้องประชุม</th>
                            <th scope="col">ความจุของห้อง</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">จัดการข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

    </div>


    <!-- modal section-->



    <!-- end modal section -->

    <!-- end app content -->

    <!-- bootstap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>

    <!-- datatables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.jqueryui.min.js"></script>

    <!-- toast alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

    <!-- sweet alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- moment -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- ajax/js function -->
    <script>
        $(document).ready(function() {
            var table = $("#myTable").dataTable({
                "processing": true,
                "stateSave": true,
                "searching": true,
                "responsive": true,
                "bDestroy": true,
                "ajax": "<?= base_url('/room/list')?>",
                "columns": [{
                        targets: 0,
                        data: null,
                        className: 'text-center',
                        searchable: true,
                        orderable: true,
                        render: function(data, type, full, meta) {
                            console.log(data);
                            return `<input type="checkbox" onclick="getWeb()" id="check_${data.id}" class="check" name="check" value="${data.id}">`;
                        },
                    },
                    {
                        "data": "roomName",
                        "className": 'text-center',
                    },
                    {
                        "data": "roomCapacity",
                        "className": 'text-center'
                    },
                    {
                        "data": "null",
                        "className": "text-center",
                        render: function(data, type, full, meta) {

                        },
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data, type, full, meta) {
                            if (data.status == 1) {
                                return `<a href="#" onclick="onoffStatus('off', ${data.id})" id="onoff" class="active"><i class="fa fa-check text-success text-active"></i></a>`;
                            } else {
                                return `<a href="#" id="onoff" onclick="onoffStatus('on', ${data.id})"><i class="fa fa-times text-danger text"></i></a>`;
                            }
                        },
                    },

                ],

            });

            table.on('responsive-resize', function(e, datatable, columns) {
                var count = columns.reduce(function(a, b) {
                    return b === false ? a + 1 : a;
                }, 0);
            });

            // clear input when modal hide
            $('.clear-modal').on('hidden.bs.modal', function(e) {
                $(this)
                    .find("input,textarea,select")
                    .val('')
                    .end()
            });

        });
    </script>
    <!-- end ajax/js function -->

    <!-- select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
</body>

</html>