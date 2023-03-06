/*import TableToExcel from "@linways/table-to-excel";*/
$(function() {
    $('#excel-class').click(function() {
        var tableToExcel = (function() {
            var uri = 'data:application/vnd.ms-excel;base64,'
                , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
                , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
                , format = function(s, c) {
                return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; })
            }
                , downloadURI = function(uri, name) {
                var link = document.createElement("a");
                link.download = name;
                link.href = uri;
                link.click();
            }

            return function(table, name, fileName) {
                if (!table.nodeType) table = document.getElementById(table)
                var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
                var resuri = uri + base64(format(template, ctx))
                downloadURI(resuri, fileName);
            }
        })();
        tableToExcel('sch-by-class','Расписание по классам', 'Расписание_по_классам.xls');
    });
    $('#excel-teacher').click(function() {
        var tableToExcel = (function() {
            var uri = 'data:application/vnd.ms-excel;base64,'
                , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
                , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
                , format = function(s, c) {
                return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; })
            }
                , downloadURI = function(uri, name) {
                var link = document.createElement("a");
                link.download = name;
                link.href = uri;
                link.click();
            }

            return function(table, name, fileName) {
                if (!table.nodeType) table = document.getElementById(table)
                var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
                var resuri = uri + base64(format(template, ctx))
                downloadURI(resuri, fileName);
            }
        })();
        tableToExcel('sch-by-teacher','Расписание по учителям', 'Расписание_по_учителям.xls');
    })
});
$(function () {

    // Инициализация
    $('#datepicker-start').datepicker({timepicker: true, dateFormat: "yyyy-mm-dd", timeFormat: "hh:ii"});
    $('#datepicker-finish').datepicker({timepicker: true, dateFormat: "yyyy-mm-dd", timeFormat: "hh:ii"});
    $('#datepicker-deadline').datepicker({timepicker: true, dateFormat: "yyyy-mm-dd", timeFormat: "hh:ii"});

    $('#timepicker-start-create').datepicker({timepicker: true, onlyTimepicker: true, dateFormat: '',
        timeFormat: "hh:ii", classes: 'only-timepicker'});
    $('#timepicker-end-create').datepicker({timepicker: true, onlyTimepicker: true, dateFormat: '',
        timeFormat: "hh:ii", classes: 'only-timepicker'});

    $('#start-date-term').datepicker({dateFormat: "yyyy-mm-dd"});
    $('#finish-date-term').datepicker({dateFormat: "yyyy-mm-dd"});

    $('.select2').select2();





    //Диалог сохранения 1 этапа
    $('#dialog-step-1').dialog({
        autoOpen: false,
        title: 'ШАГ 1 (сохранение)',
        resizable: false,
        buttons: [{text: "OK", class: "btn btn-info", id: "ok_step_1",
            click: function() {
                $(this).dialog("close");
                createDraftOnStep1();
            }},
            {text: "Отмена", class: "btn btn-outline-secondary", click: function() {$(this).dialog("close")}}],
        modal: true,
        dialogClass: "no-close no-border",
        autoFocus: false,
        width: '40%',
    });
    //Диалог выбора учителя
    $('#dialog-chose-teacher').dialog({
        autoOpen: false,
        title: 'Выберите учителя',
        resizable: true,
        buttons: [{text: "Выбрать", class: "btn btn-info", id: "ok_chose_teacher", disabled:true,
            click: function() {
                choseTeacher();
                $(this).dialog("close");
            }},
            {text: "Отмена", class: "btn btn-outline-secondary", click: function() {$(this).dialog("close")}}],
        modal: true,
        dialogClass: "no-close no-border",
        autoFocus: false,
        width: '40%',
    });
    //Диалог выбора предмета
    $('#dialog-chose-subject').dialog({
        autoOpen: false,
        title: 'Выберите предмет',
        resizable: true,
        buttons: [{text: "Выбрать", class: "btn btn-info", id: "ok_chose_subject", disabled:true,
            click: function() {
                choseSubject();
                $(this).dialog("close");
            }},
            {text: "Отмена", class: "btn btn-outline-secondary", click: function() {$(this).dialog("close")}}],
        modal: true,
        dialogClass: "no-close no-border",
        autoFocus: false,
        width: '40%',
    });
    //Диалог выбора класса
    $('#dialog-chose-class').dialog({
        autoOpen: false,
        title: 'Выберите класс',
        resizable: true,
        buttons: [{text: "Выбрать", class: "btn btn-info", id: "ok_chose_class", disabled:true,
            click: function() {
                choseClass();
                $(this).dialog("close");
            }},
            {text: "Отмена", class: "btn btn-outline-secondary", click: function() {$(this).dialog("close")}}],
        modal: true,
        dialogClass: "no-close no-border",
        autoFocus: false,
        width: '40%',
    });
});

function choseTeacher() {
    let data = $('.chose-tr :checked').val();
    $('#staff-chose option[value=' + data+ ']').prop('selected', true);
}
function choseSubject() {
    let data = $('.chose-tr :checked').val();
    $('#subject-chose option[value=' + data+ ']').prop('selected', true);
}
function choseClass() {
    let data = $('.chose-tr :checked').val();
    $('#class-chose option[value=' + data+ ']').prop('selected', true);
}

$(function () {
    $('#staff-chose').on('click', function (e) {
        $('#dialog-chose-teacher').dialog("open");
    });
    $('#subject-chose').on('click', function (e) {
        $('#dialog-chose-subject').dialog("open");
    });
    $('#class-chose').on('click', function (e) {
        $('#dialog-chose-class').dialog("open");
    });
    $('.dialog-tbody').on('click', '.chose-tr', function (e) {
        $('.form-check-input').prop('checked', false);
        $('.chose-tr').css({'backgroundColor':'', 'color':'#000'});
        $(this).find('.form-check-input').prop('checked', true);
        $(this).css({'backgroundColor':'rgb(47,166,199)', 'color':'#fff'});
        $('#ok_chose_teacher').removeAttr('disabled');
        $('#ok_chose_subject').removeAttr('disabled');
        $('#ok_chose_class').removeAttr('disabled');
    });
});

function createDraftOnStep1() {
    let number = $('#number-term').find('option:selected').text();
    let yearId = $('#academic-year option:selected').text().replace('/', '');
    let data = $('#step-1').serialize() + '&yearId=' + yearId +'&number=' + number;
    $.ajax({
        type: 'PUT',
        url: '/schedule/draft/store',
        dataType: 'json',
        data: data,
        success: function (data) {
            if (data.message === 'success') {
                let schId = data.schId;
                window.location.replace("/schedule/make/" + schId + "/distribution");
            } else {
                alert('Произошла ошибка!');
            }
        },
        error: function (data) {
            alert('ошибка!');
        },
    });
}

function initTimepickerEditCall () {
    $('#timepicker-start-edit').datepicker({timepicker: true, onlyTimepicker: true, dateFormat: '',
        timeFormat: "hh:ii", classes: 'only-timepicker'});
    $('#timepicker-end-edit').datepicker({timepicker: true, onlyTimepicker: true, dateFormat: '',
        timeFormat: "hh:ii", classes: 'only-timepicker'});
}

function hideSuccess(time) {
    $("#edit-success").fadeOut(time);
    $("#create-success").fadeOut(time);
    $("#delete-success").fadeOut(time);
    $(".success-response").fadeOut(time);
}

jQuery( function($) {
    $('tbody tr[data-href]').addClass('clickable').click( function() {
        window.location = $(this).attr('data-href');
    }).find('a').hover( function() {
        $(this).parents('tr').unbind('click');
    }, function() {
        $(this).parents('tr').click( function() {
            window.location = $(this).attr('data-href');
        });
    });
});

$(function() {
    $('#number-term').on('change', function(){
        let number = $(this).find('option:selected').text();
        let yearId = $('#academic-year option:selected').text().replace('/', '');
        $('#start-date-term').prop('disabled',false);
        $('#finish-date-term').prop('disabled',false);
        $.ajax({
            type: 'GET',
            url: '/schedule/make/term-dates',
            dataType: 'json',
            beforeSend: function () {
                /*dropExpandCard();
                $('.disable-click').css('display', 'block');
                $('#loader').css("display", "block");*/
            },
            data: {'number' : number, 'yearId' : yearId},
            success: function (data) {
                /*replaceHeaderCreateToEdit();
                $(formEdit).prepend(data);*/
                $('#start-date-term').val(data.startDate);
                $('#finish-date-term').val(data.finishDate);
                $('#arrow-right').animate({
                    opacity : '0.6',
                    color : "#2fa6c7",
                    marginRight : '0'
                }, 300);
                $('#start-date-term, #finish-date-term').animate({
                    backgroundColor : '#c6eeff'
                }, 150, function () {
                    $('#start-date-term, #finish-date-term').animate({
                        backgroundColor : ''
                    }, 150);
                });
            },
            error: function (res) {
                alert('ОШИБКА');
            }
        }).done(function () {
            /*$('#loader').css("display", "none");
            $('.disable-click').css('display', 'none');*/
        });
    });

    $('#store-step-1').on('click', function (e) {
        let number = $('#number-term').find('option:selected').text();
        let yearId = $('#academic-year option:selected').text().replace('/', '');
        let data = $('#step-1').serialize() + '&yearId=' + yearId +'&number=' + number;
        $.ajax({
            type: 'PUT',
            url: '/schedule/make/term-dates/update',
            dataType: 'json',
            data: data,
            beforeSend: function() {
            },
            success: function (data) {
                $('#dialog-step-1').dialog("open");
            },
            error: function (data) {
                alert(data.error);
            },
        });
    });
});

$(function () {
    $('#btn-store-workload').on('click', function (e) {
        let urlStore = this.getAttribute("data-url-store");
        let urlUpdate = $('#ref-tbody').attr('data-url-update');
        let data = $('#store-workload').serialize();
        $.ajax({
            type: 'POST',
            url: urlStore,
            dataType: 'json',
            data: data,
            success: function (data) { if (data.message === "error") {alert("Ошибка! " + data.result)} },
            error: function () { alert("Ошибка!"); },
        }).done(function () { updateTable(urlUpdate); });
    });
    $('#clear-inputs').on('click', function () {
        $(':input','#store-workload')
            .not(':button, :submit, :reset, :hidden')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected');
    });
});

function updateTable(urlUpdate) {
    $.ajax({
        type: 'GET',
        url: urlUpdate,
        beforeSend: function () {
            $('#ref-tbody').empty();
            $('#ref-loader').css("display", "block");
        },
        success: function (response) {
            $('#ref-tbody').prepend(response);
            dropSort();
        },
        error: function () {
            alert('error');
        }
    }).done(function () {
        $('#ref-loader').css("display", "none");
    });
}

//Выбор распределения нагрузки
$(function () {
    $('#ref-tbody').on('click', '.chose-dist-tr', function (e) {
        $('.form-check-input').prop('checked', false);
        $('.chose-dist-tr').css({'backgroundColor':'', 'color':'#000'});
        $(this).find('.form-check-input').prop('checked', true);
        $(this).css({'backgroundColor':'rgb(47,166,199)', 'color':'#fff'});
        $('#chose-distribution').removeAttr('disabled');
    });
    //Создание распределения нагрузки
    $('#store-distribution').on('click', '#create-distribution', function (e) {
        e.preventDefault();
        let urlStore = this.getAttribute("data-url-store");
        let urlUpdate = $('#ref-tbody').attr('data-url-update');
        let data = $('#store-distribution').serialize();
        $.ajax({
            type: 'POST',
            url: urlStore,
            dataType: 'json',
            data: data,
            beforeSend: function() {
            },
            success: function (data) {
            },
            error: function (data) {
                alert("Ошибка!");
            },
        }).done(function () {
            $.ajax({
                type: 'GET',
                url: urlUpdate,
                beforeSend: function () {
                    $('#ref-tbody').empty();
                    $('#ref-loader').css("display", "block");
                },
                success: function (response) {
                    $('#ref-tbody').prepend(response);
                    dropSort();
                    $("#ref-tbody:first > tr:first").trigger('click');
                },
                error: function () {
                    alert('error');
                }
            }).done(function () {
                $('#ref-loader').css("display", "none");
            });
        });
    });
    //Далее на 3 этап
    $('#chose-distribution').on('click', function (e) {
        let data = $('#step-2-dist').serialize();
        let urlStore = $(this).attr('data-url-approp');
        let elem = this;
        $.ajax({
            type: 'POST',
            url: urlStore,
            dataType: 'json',
            data: data,
            beforeSend: function() {
            },
            success: function (response) {
                if (response.message === "success") {
                    let urlApprop = $(elem).attr('data-url-redirect');
                    window.location.replace(urlApprop);
                } else {
                    alert(response.error + response.result);
                }
            },
            error: function () {
                alert("Ошибка!");
            },
        });
    });
    //Далее на 4 этап
    $('#on-restricts').on('click', function (e) {
        /*let data = $('#step-2-dist').serialize();
        let urlStore = $(this).attr('data-url-approp');*/
        let elem = this;
        let urlRedirect = $(elem).attr('data-url-redirect');
        window.location.replace(urlRedirect);
    });
    //Далее на 5 этап
    $('#on-calc').on('click', function (e) {
        /*let data = $('#step-2-dist').serialize();
        let urlStore = $(this).attr('data-url-approp');*/
        let elem = this;
        let urlRedirect = $(elem).attr('data-url-redirect');
        window.location.replace(urlRedirect);
    });

    $('#by-teacher-presentation').on('click', function (e) {
        $('#section-by-class').addClass('hide');
        $('#section-by-teacher').removeClass('hide');
        $('#by-teacher-presentation').removeClass('btn-outline-dark').addClass('btn-dark');
        $('#by-class-presentation').removeClass('btn-dark').addClass('btn-outline-dark');
        $('#import-class').addClass('hide');
        $('#excel-class').addClass('hide');
        $('#import-teacher').removeClass('hide');
        $('#excel-teacher').removeClass('hide');
    });
    $('#by-class-presentation').on('click', function (e) {
        $('#section-by-teacher').addClass('hide');
        $('#section-by-class').removeClass('hide');
        $('#by-class-presentation').removeClass('btn-outline-dark').addClass('btn-dark');
        $('#by-teacher-presentation').removeClass('btn-dark').addClass('btn-outline-dark');
        $('#import-teacher').addClass('hide');
        $('#excel-teacher').addClass('hide');
        $('#import-class').removeClass('hide');
        $('#excel-class').removeClass('hide');
    });
    $('#color-switch').on('click', function () {
        $('.lesson-color').css({backgroundColor: ''});
    });
});



$(function($){
    $(".action-print").click(function(){
        alert('l');
        window.print();
        return false;
    });
});


    function PrintElem(elem)
    {
        $('table td, tr, th, tbody').css({border: '1px solid grey', margin: '0', padding: '0'});
        setTimeout(function () {
            Popup($(elem).html());
        }, 1000);

    }
    function Popup(data)
    {
        var mywindow = window.open('', '#section-by-class', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Расписание</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write('<table></table>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10
        mywindow.print();
        mywindow.close();
        return true;
    }



function replaceHeaderEditToCreate() {
    $('#header-edit').addClass('hide');
    $('#header-create').removeClass('hide');
}
function replaceHeaderCreateToEdit() {
    $('#header-create').addClass('hide');
    $('#header-edit').removeClass('hide');
}

$(document).ready(function () {
    $('#expand-cart').click(function () {
        ExpandCard(0);
    });
    $('#compress-cart').click(function () {
        CompressCard(200);
    });
});

$(document).ready(function () {
    fullInitRefActions('call', 'calls', '.showCall');
    fullInitRefActions('building', 'buildings', '.showBuilding');
    fullInitRefActions('cabinet', 'cabinets', '.showCabinet');
    fullInitRefActions('profile', 'profiles', '.showProfile');
    fullInitRefActions('subject', 'subjects', '.showSubject');
    fullInitRefActions('position', 'positions', '.showPosition');
    fullInitRefActions('staff', 'staffs', '.showStaff');
    fullInitRefActions('teacher', 'teachers', '.showTeacher');
    fullInitRefActions('class', 'classes', '.showClass');
});

function dropExpandCard() {
    clearTimeout(timer);
    $('#action-form').stop('fx', true, true);
    /*$('#data-table').stop('fx', true, true);*/
    $('#data-table').css('width', '60%');
    $('#compress-cart').fadeOut(0);
    $('#expand-cart').fadeIn(0);
    $('#action-form').fadeIn(0).css('width', '40%');
}

function ExpandCard(time) {
    $('.disable-click').css('display', 'block');
    let blw = '100%';
    $('#action-form').fadeOut(time);
    setTimeout(function () {
        $('#data-table').animate({width: blw}, 500);
        setTimeout(function () {
            $('.disable-click').css('display', 'none');
        }, 500);
    }, time);
    $('#expand-cart').fadeOut(0);
    $('#compress-cart').fadeIn(0);

}

let timer;

function CompressCard(time) {
    $('.disable-click').css('display', 'block');
    let blw = '60%';
    $('#data-table').animate({width: blw}, 500);
    setTimeout(function () {
        $('.disable-click').css('display', 'none');
    }, 500);
    setTimeout(function () {
        $('#action-form').fadeIn(time);
    }, time);
    $('#compress-cart').fadeOut(0);
    $('#expand-cart').fadeIn(0);
}

function fullInitRefActions(ref, refs, showRef) {
    let formCreate = '#form-create-' + ref;
    let formEdit = '#form-edit-' + ref;
    getEditRef (showRef, formCreate, formEdit, refs);
    saveEditRef(ref, formEdit);
    deleteEditRef(ref, formEdit);
    initActionsCreateRef(ref, formEdit, formCreate);
    storeCreateRef(ref, formCreate);
}

//функция получения формы edit записи справочника
function getEditRef (showRef, formCreate, formEdit, obj) {
    let tbody = "#ref-tbody";
    $(tbody).on('click', showRef, function (e) {
        e.preventDefault();
        dropExpandCard();
        hideSuccess(0);
        $('.prompt').fadeOut(0);
        $(formCreate).fadeOut(0);
        $(formEdit).empty();
        let attr = this.getAttribute("data-value");
        $.ajax({
            type: 'GET',
            url: '/' + obj + '/' + attr + '/edit',
            beforeSend: function () {
                dropExpandCard();
                $('.disable-click').css('display', 'block');
                $('#loader').css("display", "block");
            },
            data: attr,
            success: function (data) {
                replaceHeaderCreateToEdit();
                $(formEdit).prepend(data);
            },
            error: function (res) {
                alert('die');
            }
        }).done(function () {
            $('#loader').css("display", "none");
            $('.disable-click').css('display', 'none');
        });
    });

}

function saveEditRef(ref, formEdit) {
    $(formEdit).on('click', '#save-edit-' + ref, function (e) {
        e.preventDefault();
        let tbody = "#ref-tbody";
        let refLoader = '#ref-loader';
        var data = $('#update').serialize();
        var urlUpdate = this.getAttribute("data-url-update");
        var url = this.getAttribute("data-url");
        hideSuccess(0);
        $(formEdit).empty();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PUT',
            url: urlUpdate,
            beforeSend: function () {
                $('#loader').css("display", "block");
                $('.disable-click').css('display', 'block');
            },
            data: data,
            success: function (result) {
                $('#header-edit').addClass('hide');
                setTimeout(function() {
                    $(".success-response").fadeIn(500);
                    $("#edit-success").fadeIn(500);
                }, 10);
                timer = setTimeout(function(){
                    hideSuccess(500);
                    ExpandCard(500);
                },2000);

                $.ajax({
                    type: 'GET',
                    url: url,
                    beforeSend: function () {
                        $(tbody).empty();
                        $(refLoader).css("display", "block");
                    },
                    success: function (response) {
                        $(tbody).prepend(response);
                        dropSort();
                    },
                    error: function () {
                        alert('die');
                    }
                }).done(function () {
                    $(refLoader).css("display", "none");
                });
            },
            error: function () {
                $(formEdit).prepend('<span class="text-danger">Ошибка! Изменения не сохранены</span>');
            }
        }).done(function () {
            $('.disable-click').css('display', 'none');
            $('#loader').css("display", "none");
        });
    });
}

//--сортировка--
$(document).ready(function ($) {
    $('.tr-w-sort').on('click', '.th-w-sort', function (e) {
        let tbody = "#ref-tbody";
        let parent = this;
        let refLoader = '#ref-loader';
        let url = this.getAttribute('data-url');
        let type = this.getAttribute('data-type');
        let elem = this;
        if (elem.getAttribute('data-status') == 0) {
            $.ajax({
                type: 'GET',
                url: url + '?type=' + type +'&status=0',
                beforeSend: function () {
                    $(tbody).empty();
                    $(refLoader).css("display", "block");
                },
                success: function (response) {
                    $(tbody).prepend(response);
                    dropSort();
                    $(parent).find('.fa-angle-down').fadeOut(0);
                    $(parent).find('.fa-angle-up').fadeIn(0);
                    elem.setAttribute('data-status', 1);
                },
                error: function () {
                    alert('d');
                }
            }).done(function () {
                $(refLoader).css("display", "none");
            });
        } else {
            $.ajax({
                type: 'GET',
                url: url + '?type=' + type +'&status=1',
                beforeSend: function () {
                    $(tbody).empty();
                    $(refLoader).css("display", "block");
                },
                success: function (response) {
                    $(tbody).prepend(response);
                    dropSort();
                    $(parent).find('.fa-angle-up').fadeOut(0);
                    $(parent).find('.fa-angle-down').fadeIn(0);
                    elem.setAttribute('data-status', 0);
                },
                error: function () {
                    alert('d');
                }
            }).done(function () {
                $(refLoader).css("display", "none");
            });
        }
    });
});

//-сброс сортировки--
function dropSort() {
    $('.fa-angle-up').fadeOut(0);
    $('.fa-angle-down').fadeIn(0);
    $('.th-w-sort').attr('data-status', 0);
}

function deleteEditRef(ref, formEdit) {
    $(formEdit).on('click', '#delete-' + ref, function (e) {
        e.preventDefault();
        let tbody = "#ref-tbody";
        let refLoader = '#ref-loader';
        var urlDelete = this.getAttribute("data-url-delete");
        var url = this.getAttribute("data-url");
        var data = this.getAttribute("data-value");
        hideSuccess(0);
        $(formEdit).empty();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'DELETE',
            url: urlDelete,
            data: data,
            beforeSend: function () {
                $('#loader').css("display", "block");
                $('.disable-click').css('display', 'block');
            },
            success: function () {
                setTimeout(function() {
                    $(".success-response").fadeIn(500);
                    $("#delete-success").fadeIn(500);
                }, 100);
                timer = setTimeout(function(){
                    hideSuccess(500);
                    ExpandCard(500);
                },2000);
                $('#header-edit').addClass('hide');

                $.ajax({
                    type: 'GET',
                    url: url,
                    beforeSend: function () {
                        $(tbody).empty();
                        $(refLoader).css("display", "block");
                    },
                    success: function (response) {
                        $(tbody).prepend(response);
                        dropSort();
                    },
                    error: function () {
                        alert('d');
                    }
                }).done(function () {
                    $(refLoader).css("display", "none");
                });
            }
        }).done(function () {
            $('#loader').css("display", "none");
            $('.disable-click').css('display', 'none');
        });
    });
}

function initActionsCreateRef(ref, formEdit, formCreate) {
    let disClick = $('.disable-click');
    $('#add-' + ref).click(function (e) {
        dropExpandCard();
        hideSuccess(0);
        $('.prompt').fadeOut(0);
        $(formEdit).empty();
        replaceHeaderEditToCreate();
        $(formCreate).fadeIn(200);
    });
    $('#undo-create-' + ref).click(function (e) {
        disClick.css('display', 'block');
        $(formCreate).fadeOut(200);
        $('#header-create').addClass('hide');
        ExpandCard(0);
    });
}

function storeCreateRef(ref, formCreate) {
    $('#store-create-' + ref).click(function (e) {
        e.preventDefault();
        let tbody = '#ref-tbody';
        let refLoader = '#ref-loader';
        let data = $('#create').serialize();
        let urlStore = this.getAttribute("data-url-store");
        let url = this.getAttribute("data-url");
        $(formCreate).fadeOut(0);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: urlStore,
            beforeSend: function () {
                $('#loader').css("display", "block");
            },
            data: data,
            success: function (response) {
                if (response.success) {
                    setTimeout(function() {
                        $(".success-response").fadeIn(500);
                        $("#create-success").fadeIn(500);
                    }, 100);
                    timer = setTimeout(function(){
                        hideSuccess(500);
                    },2000);
                    $('#header-create').addClass('hide');

                    $.ajax({
                        type: 'GET',
                        url: url,
                        beforeSend: function () {
                            $(tbody).empty();
                            $(refLoader).css("display", "block");
                            $('.disable-click').css('display', 'block');
                        },
                        success: function (response) {
                            $(tbody).prepend(response);
                            dropSort();
                        },
                        error: function () {
                            alert('d');
                        }
                    }).done(function () {
                        $(refLoader).css("display", "none");
                        $('.disable-click').css('display', 'none');
                    });
                }
                else {
                    if (response.error) {
                        $('#loader').css("display", "none");
                        $(formCreate).fadeIn(0).prepend(
                            '<span class="text-danger">' + response.error + '</span>');
                    }
                }
            },
            error: function (response) {
                $('#loader').css("display", "none");
                $(formCreate).fadeIn(0).prepend('<span class="text-danger">'+response.error+'</span>');
            }
        }).done(function () {
            $('#loader').css("display", "none");
        });
    });
}

//--Справка--
$(document).ready(function($) {
    $('.popup-open').click(function() {
        $('.popup-fade').fadeIn();
        return false;
    });

    $('.popup-close').click(function() {
        $(this).parents('.popup-fade').fadeOut();
        return false;
    });

    $(document).keydown(function(e) {
        if (e.keyCode === 27) {
            e.stopPropagation();
            $('.popup-fade').fadeOut();
        }
    });

    $('.popup-fade').click(function(e) {
        if ($(e.target).closest('.popup').length == 0) {
            $(this).fadeOut();
        }
    });
});

//--Всплываюещее окно просмотра--
/*$(document).ready(function($) {
    $('.popup-open-show').click(function() {
        $('.popup-fade-show').fadeIn();
        return false;
    });

    $('.popup-close-show').click(function() {
        $(this).parents('.popup-fade-show').fadeOut();
        return false;
    });

    $(document).keydown(function(e) {
        if (e.keyCode === 27) {
            e.stopPropagation();
            $('.popup-fade-show').fadeOut();
        }
    });

    $('.popup-fade-show').click(function(e) {
        if ($(e.target).closest('.popup-show').length == 0) {
            $(this).fadeOut();
        }
    });
});*/

/*$(document).ready(function () {
    $("#calls-tbody").on('click', '.showCall', function (e) {
        e.preventDefault();
        hideSuccess(0);
        $('#form-create-call').fadeOut(0);
        $('#form-edit-call').empty();
        var attr = this.getAttribute("data-value");
        $.ajax({
            type: 'GET',
            url: '/calls/' + attr + '/edit',
            beforeSend: function () {
                $('#loader').css("display", "block");
            },
            data: attr,
        success: function (data) {
            $('#form-edit-call').prepend(data);
            initTimepickerEditCall();
        },
        error: function () {
            alert('d');
        }
    }).done(function () {
            $('#loader').css("display", "none");
        });
    });

});

$(document).ready(function () {
    $('#form-edit-call').on('click', '#save-edit-call-btn', function (e) {
        e.preventDefault();
        var data = $('#update').serialize();
        var urlUpdate = this.getAttribute("data-url-update");
        var url = this.getAttribute("data-url");
        hideSuccess(0);
        $('#form-edit-call').empty();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PUT',
            url: urlUpdate,
            beforeSend: function () {
                $('#loader').css("display", "block");
            },
            data: data,
            success: function (result) {
                setTimeout(function() {
                    $(".success-response").fadeIn(500);
                    $("#edit-success").fadeIn(500);
                }, 10);
                setTimeout(function(){
                    hideSuccess(500);
                },3000);

                $.ajax({
                    type: 'GET',
                    url: url,
                    beforeSend: function () {
                        $('#calls-tbody').empty();
                        $('#loader-calls').css("display", "block");
                    },
                    success: function (response) {
                        $('#calls-tbody').prepend(response);
                    },
                    error: function () {
                        alert('d');
                    }
                }).done(function () {
                    $('#loader-calls').css("display", "none");
                });
            },
            error: function () {
                $('#form-edit-call').prepend('<span class="text-danger">Ошибка! Изменения не сохранены</span>');
            }
        }).done(function () {
            $('#loader').css("display", "none");
        });
    });

    $('#form-edit-call').on('click', '#delete-call-btn', function (e) {
        e.preventDefault();
        var urlDelete = this.getAttribute("data-url-delete");
        var url = this.getAttribute("data-url");
        var data = this.getAttribute("data-value");
        hideSuccess(0);
        $('#form-create-call').fadeOut(0);
        $('#form-edit-call').empty();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'DELETE',
            url: urlDelete,
            data: data,
            beforeSend: function () {
                $('#loader').css("display", "block");
            },
            success: function () {
                setTimeout(function() {
                    $(".success-response").fadeIn(500);
                    $("#delete-success").fadeIn(500);
                }, 100);
                setTimeout(function(){
                    hideSuccess(500);
                },3000);

                $.ajax({
                    type: 'GET',
                    url: url,
                    beforeSend: function () {
                        $('#calls-tbody').empty();
                        $('#loader-calls').css("display", "block");
                    },
                    success: function (response) {
                        $('#calls-tbody').prepend(response);
                    },
                    error: function () {
                        alert('d');
                    }
                }).done(function () {
                    $('#loader-calls').css("display", "none");
                });
            }
        }).done(function () {
            $('#loader').css("display", "none");
        });
    });
});

$(function () {
    $('#add-call-btn').click(function (e) {
        hideSuccess(0);
        $('#form-edit-call').empty();
        $('#form-create-call').fadeIn(200);
    });
    $('#undo-create-call').click(function (e) {
        $('#form-create-call').fadeOut(200);
    });

    $('#store-call').click(function (e) {
        e.preventDefault();
        var data = $('#create').serialize();
        var urlStore = this.getAttribute("data-url-store");
        var url = this.getAttribute("data-url");
        $('#form-create-call').fadeOut(0);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: urlStore,
            beforeSend: function () {
                $('#loader').css("display", "block");
            },
            data: data,
            success: function (response) {
                if (response.success) {
                    setTimeout(function() {
                        $(".success-response").fadeIn(500);
                        $("#create-success").fadeIn(500);
                    }, 100);
                    setTimeout(function(){
                        hideSuccess(500);
                    },3000);

                    $.ajax({
                        type: 'GET',
                        url: url,
                        beforeSend: function () {
                            $('#calls-tbody').empty();
                            $('#loader-calls').css("display", "block");
                        },
                        success: function (response) {
                            $('#calls-tbody').prepend(response);
                        },
                        error: function () {
                            alert('d');
                        }
                    }).done(function () {
                        $('#loader-calls').css("display", "none");
                    });
                }
                else {
                    if (response.error) {
                        $('#loader').css("display", "none");
                        $('#form-create-call').fadeIn(0).prepend(
                            '<span class="text-danger">' + response.error + '</span>');
                    }
                }
            },
            error: function (response) {
                $('#loader').css("display", "none");
                $('#form-create-call').fadeIn(0).prepend('<span class="text-danger">'+response.error+'</span>');
            }
        }).done(function () {
            $('#loader').css("display", "none");
        });
    });
});*/
