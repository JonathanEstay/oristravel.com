// JavaScript Document
function enviarMensajeCorreo(classFrm, php, btn, div)
{
    $("#" + btn).attr('disabled', 'disabled');

    initLoad();

    var formData = new FormData($("." + classFrm)[0]);
    //hacemos la petición ajax  
    $.ajax({
        url: php,
        type: 'POST',
        //Form data
        //datos del formulario
        data: formData,
        //necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
        //mientras enviamos el archivo
        beforeSend: function () {
        },
        //una vez finalizado correctamente
        success: function (data)
        {
            endLoad();
            if (data == 'OK')
            {
                $("#" + div).delay(1500).queue(function (n)
                {
                    $("#" + div).html('<div class="alert alert-dismissable alert-success"><strong>Terminado</strong><br/><img src="iconos/ok.png" width="32" border="0" /> Proceso realizado con &eacute;xito.</div>');
                    //n();
                });
            }
            else
            {
                $('#mensajeWar').html(data);
                $('#divAlertWar').delay(1000).fadeIn(500);
                $('#divAlertWar').animate({
                    'display': 'block'
                });

                $('#divAlertWar').delay(5000).fadeOut(500);
                $('#divAlertWar').animate({
                    'display': 'none'
                });

                $("#" + btn).delay(2000).queue(function (m)
                {
                    $("#" + btn).removeAttr("disabled");
                    m();
                });
            }
        },
        //si ha ocurrido un error
        error: function ()
        {
            endLoad();

            $('#mensajeWar').html('Error error');
            $('#divAlertWar').delay(1000).fadeIn(500);
            $('#divAlertWar').animate({
                'display': 'block'
            });

            $('#divAlertWar').delay(5000).fadeOut(500);
            $('#divAlertWar').animate({
                'display': 'none'
            });
        }
    });
}


function procesoConServ(classFrm, php, btn)
{
    $("#" + btn).attr('disabled', 'disabled');

    initLoad();


    //alertError(btn, 'Error al tratar de confirmar ', 2000);
    //return false;

    /*for(rP=1; rP>=1; rP++)
     {
     txtPasaporte= document.getElementById("rP_chkPas_"+rP);
     txtRut= document.getElementById("rP_txtRut_"+rP);
     if(txtRut!=null)
     {
     if($.trim($("#rP_txtNom_"+rP).val())=='')
     {
     alertError(btn, 'Debe ingresar un nombre', 2000);
     $("#rP_txtNom_"+rP).focus();
     return false;
     break;
     }
     }
     else
     {
     break;
     }
     }*/


    var formData = new FormData($("." + classFrm)[0]);
    //hacemos la petici�n ajax  
    $.ajax({
        url: php,
        type: 'POST',
        //Form data
        //datos del formulario
        data: formData,
        //necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
        //mientras enviamos el archivo
        beforeSend: function () {
        },
        //una vez finalizado correctamente
        success: function (data)
        {
            var myArrayData = data.split('&');
            if ($.trim(myArrayData[0]) == 'OK')
            {
                endLoad();

                $('#divAlertExito').delay(1000).fadeIn(500);
                $('#divAlertExito').animate({
                    'display': 'block'
                });

                $('#divAlertExito').delay(1000).fadeOut(500);
                $('#divAlertExito').animate({
                    'display': 'none'
                });
            }
            else
            {
                alertError(btn, $.trim(myArrayData[1]), 5000);
            }
        },
        //si ha ocurrido un error
        error: function ()
        {
            endLoad();

            $('#mensajeWar').html('Error error');
            $('#divAlertWar').delay(1000).fadeIn(500);
            $('#divAlertWar').animate({
                'display': 'block'
            });

            $('#divAlertWar').delay(5000).fadeOut(500);
            $('#divAlertWar').animate({
                'display': 'none'
            });
        }
    });
}


function alertError(btn, msg, time)
{
    endLoad();

    $('#mensajeWar').html(msg);
    $('#divAlertWar').delay(1000).fadeIn(500);
    $('#divAlertWar').animate({
        'display': 'block'
    });

    $('#divAlertWar').delay(time).fadeOut(500);
    $('#divAlertWar').animate({
        'display': 'none'
    });

    $("#" + btn).delay(2500).queue(function (m)
    {
        $("#" + btn).removeAttr("disabled");
        m();
    });
}


function initLoad()
{
    $('#divAlertInfo').fadeIn(500);
    $('#divAlertInfo').animate({
        'display': 'block'
    });
}

function endLoad()
{
    $('#divAlertInfo').delay(100).fadeOut(500);
    $('#divAlertInfo').animate({
        'display': 'none'
    });
}


function procesoEnviaFormPopup(classFrm, php, div, divTit, titulo)
{
    initLoad();

    $("#" + div).html("");
    $("#" + divTit).html(titulo);
    var formData = new FormData($("." + classFrm)[0]);
    //hacemos la petición ajax  
    $.ajax({
        url: php,
        type: 'POST',
        //Form data
        //datos del formulario
        data: formData,
        //necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
        //mientras enviamos el archivo
        beforeSend: function () {
        },
        //una vez finalizado correctamente
        success: function (data)
        {
            $("#" + div).html(data);
            endLoad();
        },
        //si ha ocurrido un error
        error: function ()
        {
            $("#" + div).html("Ha ocurrido un error");
        }
    });
}



function buscarCiudad(ciudad, frmBus, ob, id)
{

    var span = document.getElementById(ob);
    var length = ciudad.length;

    if (length >= 3)
    {
        $.post("process/procesoObtieneCiudad.php",
                {
                    post_ciudad: ciudad,
                    post_frmBus: frmBus,
                    post_span: ob,
                    post_idTxt: id
                }, function (data) {
            $("#" + ob).html(data);
            span.style.display = 'block';
        });
    }
    else
    {
        span.style.display = 'none';
        ciudad = '';
        $.post("process/procesoObtieneCiudad.php", {post_ciudad: ciudad, post_frmBus: frmBus}, function (data) {
            $("#" + ob).html(data);
        });
    }
}


function getCiudad(ciudad, span, txt)
{
    document.getElementById(txt).value = ciudad;
    document.getElementById(span).style.display = 'none';
}




function procesoCargaDiv(valor, div, php)
{
    $("#" + div).html('');
    if (valor != 0)
    {
        $.post(php,
                {
                    post_f_valor: valor
                }, function (data)
        {
            $("#" + div).html(data);
        });
    }
}

function habitaciones(table, num)
{
    for (var x = 1; x <= 3; x++)
    {
        $("#" + table + '_' + x).css("display", "none");
    }

    for (var x = 1; x <= num; x++)
    {
        var id = table + '_' + x;
        mostrado = 0;
        if ($('#' + id).css('display') === 'block')
        {
            mostrado = 1;
            $('#' + id).css('display', 'none');
        }
        if (mostrado !== 1)
        {
            $('#' + table + '_' + x).fadeIn(1000);
            $('#' + table + '_' + x).animate({
                'display': 'block'
            });
        }
    }
}




function habilitaEdadChild(id, hab)
{
    var i, x;
    status_1 = new Array(true, false, false);
    status_2 = new Array(true, true, false);

    for (i = 0; i < 3; i++)
    {
        if (id == i)
        {
            for (x = 1; x < 4; x++)
            {
                if (hab == x)
                {
                    $("#mL_edadChild_1_" + x).prop('disabled', status_1[i]);
                    $("#mL_edadChild_2_" + x).prop('disabled', status_2[i]);
                }
            }
        }
    }
}


function muestraOculta(id, estado)
{
    if (estado === 1)
    {
        $('#' + id).delay(10).fadeIn(500);
        $('#' + id).animate({
            'display': 'block'
        });
    }
    else
    {
        $('#' + id).delay(10).fadeOut(500);
        $('#' + id).animate({
            'display': 'none'
        });
    }
}


function soloRut(evt, par)
{
    var ini;
    var charCode = (evt.which) ? evt.which : event.keyCode
    //alert(charCode);
    if ((charCode >= 48 && charCode <= 57) || (charCode == 45) || (charCode == 107) || (charCode == 75)) {
        return true;
    } else {
        return false;
    }
}


function checkServ(idChk, nConf, fPPago)
{
    if ($("#" + idChk).is(':checked')) {
        if ($.trim($("#" + nConf).val()) === "" && $.trim($("#" + fPPago).val()) === "")
        {
            $("#" + idChk).prop("checked", "");
        }
    } else {
        if ($.trim($("#" + nConf).val()) !== "" || $.trim($("#" + fPPago).val()) !== "")
        {
            $("#" + idChk).prop("checked", "checked");
        }
    }
}


function abrePopup(div, docPHP, idTitulo, titulo, val)
{
    initLoad();
    $("#" + div).html('');
    $("#" + idTitulo).html(titulo);
    $.post(docPHP,
            {
                varCenterBox: val
            }, function (data)
    {
        $("#" + div).html(data);
        endLoad();
    });
}

function exito() {//  
    endLoad();
    $('#divAlertExito').delay(1000).fadeIn(500);
    $('#divAlertExito').animate({
        'display': 'block'
    });
    

    $('#divAlertExito').delay(1000).fadeOut(500);
    $('#divAlertExito').animate({
        'display': 'none'
    });
    
}
function noExito(data) {
    endLoad();
    $('#divAlertWar').delay(500).fadeIn(500);
    $('#divAlertWar').animate({
    
        'display': 'block'
    });
    $("#msjWar").html(data);    

    $('#divAlertWar').delay(500).fadeOut(500);
    $('#divAlertWar').animate({
        'display': 'none'
    });
}





