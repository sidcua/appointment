import './bootstrap';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.fn.reloadDataTable = function (callback) {
    if (!$(this).DataTable().ajax) {
        $(this).clearDataTable();
    }
    $(this).DataTable().ajax.reload(function () {
        if (callback) {
            callback();
        }
    });
    return $(this);
};

$.fn.addRow = function (data) {
    $(this).DataTable().row.add(data).draw(false);
    return $(this);
};

$.fn.addRows = function (data) {
    $(this).DataTable().rows.add(data).draw(false);
    return $(this);
};

$.fn.getRowByElement = function () {
    return $(this).parents('table').DataTable().row($(this).parents('tr')).data();
};

$.fn.deleteRowByElement = function () {
    return $(this).parents('table').DataTable().row($(this).parents('tr')).remove().draw();
};

$.fn.clearDataTable = function () {
    $(this).DataTable().clear().draw();
    return $(this);
};

$.fn.getRowCount = function () {
    return $(this).DataTable().rows().data().length;
};

$.fn.getRow = function (index) {
    return $(this).DataTable().row(':eq(' + index + ')').data();
};

$.fn.getRowElement = function (index) {
    return $($(this).DataTable().row(':eq(' + index + ')').node());
};

$.fn.getRows = function () {
    return $(this).DataTable().rows().data().toArray();
};

$.fn.modifyRow = function (index, data) {
    $(this).DataTable().row(':eq(' + index + ')').data(data);
    return $(this);
};

$.fn.isTableEmpty = function () {
    return !$(this).DataTable().rows().any();
};

$.fn.getSelectedRow = function () {
    return $(this).DataTable().row('.selected').data();
};

$.fn.getSelectedRowElement = function () {
    return $($(this).DataTable().row('.selected').node());
};

$.fn.deleteSelectRow = function () {
    return $(this).DataTable().row('.selected').remove().draw();
};

$.fn.getSelectedRows = function () {
    return $(this).DataTable().rows('.selected').data();
};

$.fn.getSelectedRowsIndex = function () {
    return $(this).DataTable().rows('.selected').indexes();
};


$.fn.deleteRow = function (index) {
    $(this).DataTable().row(':eq(' + index + ')').remove().draw();
    return $(this);
};

$.fn.enableMultipleSelection = function (selected, unselected) {
    var table = $(this);
    $(this).find('tbody').on('click', 'tr', function () {
        var row = $(this).parents('table').DataTable().row($(this)).data();
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            if (unselected) {
                unselected(row, $(this));
            }
        } else {
            $(this).addClass('selected');
            if (selected) {
                selected(row, $(this));
            }
        }
    });
};

$.fn.enableSingleSelection = function (selected, unselected) {
    var table = $(this);
    $(this).find('tbody').on('click', 'tr', function (e) {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            if (unselected) {
                unselected(table.getSelectedRow(), $(this));
            }
        } else {
            table.find('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            if (selected) {
                if (typeof table.getSelectedRow() === "undefined") {
                    return;
                }
                selected(table.getSelectedRow(), $(this));
            }
        }
    });
};

$.fn.setSelectedRow = function (index) {
    $(this).find('tr.selected').removeClass('selected');
    $(this).getRowElement(index).addClass('selected')
};

$.fn.getTableData = function () {
    return $(this).DataTable().rows().data().toArray();
};

$.fn.searchDataTable = function (value) {
    $(this).DataTable().search(value).draw();
};

$.fn.getRowIndexByKeysValues = function (kv = {}) {
    var rows = $(this).getTableData();
    var i = -1;
    $.each(rows, function (index, row) {
        var match = true;
        $.each(kv, function (k, v) {
            if (row[k] != v) {
                match = false;
            }
        });
        if (match) {
            i = index;
            return false;
        }
    });
    return i;
};

$.fn.getRowIndexByKeyValue = function (key, value) {
    var rows = $(this).getTableData();
    var i = -1;
    $.each(rows, function (index, row) {
        if (row[key] == value) {
            i = index;
            return false;
        }
    });
    return i;
};
