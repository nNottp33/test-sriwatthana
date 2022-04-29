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

    <!-- modal booking -->
    <div class="modal fade clear-modal" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">กรอกรายละเอียดการจอง</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fa-solid fa-user-large"></i>
                        </span>
                        <input id="booker" type="text" class="form-control" placeholder="ชื่อผู้จอง"
                            aria-label="ชื่อผู้จอง" aria-describedby="ชื่อผู้จอง">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิดหน้าต่าง</button>
                    <button id="saveBooking" type="button" class="btn btn-primary">บันทึกข้อมูลการจอง</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal booking end -->

    <!-- modal show Booked -->
    <div class="modal fade clear-modal" id="showBookingModal" tabindex="-1" aria-labelledby="showBookingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showBookingModalLabel">รายการจอง</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="section-table">
                        <table id="bookedTable" class="table caption-top table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ผู้จอง</th>
                                    <th scope="col">จองเมื่อ</th>
                                    <th scope="col">จัดการข้อมูล</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิดหน้าต่าง</button>

                </div>
            </div>
        </div>
    </div>
    <!-- modal show Booked end -->

    <!-- modal edit -->
    <div class="modal fade clear-modal" id="editBookingModal" tabindex="-1" aria-labelledby="editBookingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBookingModalLabel">แก้ไขรายการ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fa-solid fa-user-large"></i>
                        </span>
                        <input id="newBooker" type="text" class="form-control" placeholder="ชื่อผู้จอง"
                            aria-label="ชื่อผู้จอง" aria-describedby="ชื่อผู้จอง">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิดหน้าต่าง</button>
                    <button id="editBooking" type="button" class="btn btn-primary">แก้ไข</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal edit end -->

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
                "paging": false,
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
                            return `<input type="checkbox" onclick="" id="check_${data.id}" class="check" name="check" value="${data.id}">`;
                        },
                    },
                    {
                        "data": "roomName",
                        "className": 'text-center',
                    },
                    {
                        "data": "roomCapacity",
                        "className": 'text-center',
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data, type, full, meta) {
                            if (data.status == 0) {
                                return `<label> ${data.total} / ${data.roomCapacity} <span class="badge bg-warning text-dark">ว่าง</span> </label> `;
                            } else {
                                return `<span class="badge bg-danger">เต็ม</span>`;
                            }
                        },
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data, type, full, meta) {
                            return `<div class="row m-auto justify-content-center"> 
                                        <div class="col-6 col-sm-6"> 
                                            <a href="#" onclick="booking('${data.id}')" class="btn btn-sm btn-info">จอง</a> 
                                        </div> 
                                        <div class="col-6 col-sm-6"> 
                                             <a href="#" onclick="showBooking('${data.id}')" class="btn btn-sm btn-primary"><i class="fa-solid fa-list"></i></a> 
                                        </div> 
                                    </div>`;
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


        const booking = (id) => {
            $('#bookingModal').modal('show');
            $('#editBooking').click(function() {
                $.ajax({
                    url: "<?= base_url('/booking') ?>",
                    type: "POST",
                    data: {
                        id: id,
                        booker: $('#newBooker').val(),
                    },
                    success: function(response) {
                        if (response.status == '200') {
                            toastr.success(response.message, response.title);
                            $("#myTable").DataTable().ajax.reload();
                            $('#bookingModal').modal('hide');
                        } else {
                            toastr.error(response.message, response.title);
                        }
                    },
                    error: function(err) {
                        toastr.error('เกิดเหตุขัดข้อง', 'ผิดพลาด!');
                    }
                });
            })
        };


        const showBooking = (id) => {
            $('#showBookingModal').modal('show');
            var table = $("#bookedTable").dataTable({
                "processing": true,
                "paging": false,
                "responsive": true,
                "bDestroy": true,
                "ajax": {
                    "url": "<?= base_url('/booked') ?>",
                    "type": "POST",
                    "data": {
                        id: id,
                    },
                },
                "columns": [{
                        targets: 0,
                        data: null,
                        className: 'text-center',
                        searchable: true,
                        orderable: true,
                        render: function(data, type, full, meta) {
                            return `<input type="checkbox" onclick="" id="check_${data.id}" class="check" name="check" value="${data.id}">`;
                        },
                    },
                    {
                        "data": "booker",
                        "className": 'text-center',
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data, type, full, meta) {
                            return moment.unix(data.createAt).format("DD/MM/YYYY HH:mm");;
                        },
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data, type, full, meta) {
                            return `<div class="row"> 
                                        <div class="col-6 col-sm-6">
                                            <a href="#" onclick="editBooking('${data.id}')" class="btn btn-sm btn-warning">แก้ไข</a>
                                        </div> 
                                         <div class="col-6 col-sm-6">
                                             <a href="#" onclick="deleteBooking('${data.id}')" class="btn btn-sm btn-danger">ลบ</a>
                                        </div>
                                    </div>`;
                        },
                    },


                ],

            });
        };

        const editBooking = (id) => {
            $.ajax({
                url: "<?= base_url('/booked/bookername')?>",
                type: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.status == 200) {

                        $('#newBooker').val(data.data);
                        $('#editBookingModal').modal('show');

                        $('#editBooking').click(function() {
                            $.ajax({
                                url: "<?= base_url('/booked/edit') ?>",
                                type: "POST",
                                data: {
                                    id: id,
                                    booker: $('#newBooker').val(),
                                },
                                success: function(response) {
                                    if (response.status == '200') {
                                        toastr.success(response.message, response
                                            .title);
                                        $("#bookedTable").DataTable().ajax.reload();
                                        $('#editBookingModal').modal('hide');
                                    } else {
                                        toastr.error(response.message, response
                                            .title);
                                    }
                                },
                                error: function(err) {
                                    toastr.error('เกิดเหตุขัดข้อง', 'ผิดพลาด!');
                                }
                            });
                        })
                    } else {
                        toastr.error(data.message);
                    }
                },
                error: function(data) {
                    toastr.error(data.message);
                }
            });
        };

        const deleteBooking = (id) => {
            let text = "คุณต้องการลบรายการจองนี้ใช่หรือไม่?";
            if (confirm(text) == true) {
                $.ajax({
                    url: "<?= base_url('/booked/delete') ?>",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        if (response.status == '200') {
                            toastr.success(response.message, response.title);
                            $("#bookedTable").DataTable().ajax.reload();
                        } else {
                            toastr.error(response.message, response.title);
                        }
                    },
                    error: function(err) {
                        toastr.error('เกิดเหตุขัดข้อง', 'ผิดพลาด!');
                    }
                });
            } else {
                return false;
            }
        };
    </script>
    <!-- end ajax/js function -->

    <!-- select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
</body>

</html>