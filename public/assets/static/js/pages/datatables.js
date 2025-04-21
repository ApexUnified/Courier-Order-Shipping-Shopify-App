let jquery_datatable = $("#table1").DataTable({
    responsive: true
})

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    let orders_datatable = $("#orders").DataTable({
        responsive: true,
        columnDefs: [{
            orderable: false,
            targets: [0]
        }],
        dom: "<'row mb-3'<'col-4'l><'col-4 d-flex justify-content-center'f><'col-4 text-end'>>" +
            "<'row dt-row'<'col-sm-12'tr>>" +
            "<'row'<'col-4'i><'col-8'p>>",
        buttons: [


            {
                text: 'Send Orders <i class="bi bi-send-check-fill"></i>',
                title: 'Send Orders',
                className: 'btn btn-sm font-sm btn-success',
                attr: {
                    id: "order_transfer_btn"
                }
            },

            {
                extend: 'collection',
                text: 'Export',
                className: 'btn btn-sm btn-primary',
                buttons: [{
                    extend: 'copy',
                    className: 'text-primary',
                    title: "Orders",
                    exportOptions: {
                        columns: ':visible:not(.no-print)'
                    }
                },
                {
                    extend: 'csv',
                    className: 'text-primary',
                    title: "Orders",
                    exportOptions: {
                        columns: ':visible:not(.no-print)'
                    }
                },
                {
                    extend: 'excel',
                    className: 'text-primary',
                    title: "Orders",
                    exportOptions: {
                        columns: ':visible:not(.no-print)'
                    }
                },
                {
                    extend: 'pdf',
                    className: 'text-primary',
                    title: "Orders",
                    exportOptions: {
                        columns: ':visible:not(.no-print)'
                    }
                },
                {
                    extend: 'print',
                    className: 'text-primary',
                    title: "Orders",
                    exportOptions: {
                        columns: ':visible:not(.no-print)'
                    }
                },
                ],
            }

        ],
        initComplete: function () {
            setTimeout(() => {
                $('.dt-buttons').removeClass('dt-buttons');
            }, 0);
        },
    });


    orders_datatable
        .buttons()
        .container()
        .appendTo('#orders_wrapper .col-4.text-end')
        .parent()
        .addClass('d-flex justify-content-end flex-wrap');




    $("#select_all").on("change", function () {
        const isChecked = $(this).is(":checked");
        $(".each_select").prop("checked", isChecked);
    });

    $("#order_transfer_btn").on("click", function () {

        const selected_ids = [];
        $(".each_select:checked").each(function () {
            selected_ids.push($(this).val());
        });

        if (selected_ids.length < 1) {
            alert("Please select any Order");
        } else {
            console.log(selected_ids);
            const conf = confirm("Are you sure you want to Share these Orders");
            if (conf) {
                $.ajax({
                    url: '/send-order',
                    type: 'POST',
                    data: {
                        order_ids: selected_ids
                    },
                    success: function (response) {
                        if (response.status) {
                            alert("Selected Orders Sent successfully");
                        } else {
                            alert("Failed to Send Selected Orders");
                        }
                    },
                    error: function (xhr, status, error) {
                        alert("Failed to Send Selected Orders ");
                    }
                });
            }
        }


    });



});





const setTableColor = () => {
    document.querySelectorAll('.dataTables_paginate .pagination').forEach(dt => {
        dt.classList.add('pagination-primary')
    })
}
setTableColor()
jquery_datatable.on('draw', setTableColor)

