//esta capa solo se dedica a consultar,eliminar,modificar,agregar funcionalidades para el administrador
$(function() {
    loadActivitiesAdministrator();
    loadUserAdministrator();
    loadCampaingsAdministrator();
    getOneUser();
    $("#resultOperator").hide();
    $("#resultCampanas").hide();
    getCampaingsUser();

});


function statusChangeCallback(response) {
    console.log("method statusChangeCallback");
    console.log(response); //devolvera un objeto json solo si inicias sesion
    if (response.status === "connected") {
        //se mostratara solo si la persona inicia sesion en tu aplicacion
        testApiPage();


    } else {
        // Se mostrara si la persona no ha iniciado sesion en la aplicacion
        console.log("sesion cerrada");

    }
}

function checkLoginState() { //metodo para checar el status del inicio de sesion.
    console.log("checkLoginState");
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
}


function logout() { //metodo para cerrar sesion de facebook
    console.log("method logout");
    FB.logout(function(response) {
        console.log(response);
        statusChangeCallback(response);
    });
}


function getDataImg() { //metodo para obtener la directiva data.
    var x = $("#loadDataUserPage option:selected").data('id');
    $("#campImg").val(x);
}

function getSocial(social) { //obtiene la red social a la que sera publicada dependiendo del estado
    $('#' + social).on('click', function() {
        if ($(this).is(':checked')) {
            $(this).attr('value', 'true');
            console.log($('#' + social + '').val());
        } else {
            $(this).attr('value', 'false');
            console.log($('#' + social).val());
        }
    });
}

function getOneUser() { //metodo para obtener al usuario que ha dado de alta el administrador para asignarle la pagina.
    var id = $("#id_admin").val();

    $.ajax({
        type: "GET",
        url: './json/administrator.php',
        data: { 'administrator': 'readOperator', 'id_administrator': id },
        dataType: 'json',
        success: function(response) {
            var data = response['AdministratorUser'];
            var i;
            var info = '<option value=""></option>';

            for (i = 0; i < data.length; i++) {
                info += '<option value="' + data[i].id_usuario + '">' + data[i].nombre + '</option>';
            }

            $("#loadDataUserCheckBox").html(info);

        }
    })


}


function loadActivitiesAdministrator() { //metodo para obtener las actividades del usuario de su entrada y salida de la aplicacion
    var id = $("#id_admin").val();

    $.ajax({
        type: "GET",
        url: './json/administrator.php',
        data: { 'id_administrator': id, 'administrator': 'read' },
        dataType: 'json',
        success: function(response) {
            var i;
            var info = "";
            var data = response['EntryAndExitLog'];

            for (i = 0; i < data.length; i++) {
                info += '<tr>' +
                    '<td>' + data[i].nombre + '</td>' +
                    '<td>' + data[i].apellidos + '</td>' +
                    '<td>' + data[i].date_entrada + '</td>' +
                    '<td>' + data[i].date_salida + '</td>' +
                    '</tr>';
            }

            $("#loadDataActivities").html(info);

        }
    })
}

function loadUserAdministrator() { //metodo que carga a los operador que ha dado de alta el administrador
    var id = $("#id_admin").val();
    $.ajax({
        type: "GET",
        url: './json/administrator.php',
        data: { 'administrator': 'readOperator', 'id_administrator': id },
        dataType: 'json',
        success: function(response) {
            var data = response['AdministratorUser'];
            var i;
            var info = "";
            for (i = 0; i < data.length; i++) {
                info += '<tr>' +
                    '<td>' + data[i].nombre + '</td>' +
                    '<td>' + data[i].apellidos + '</td>' +
                    '<td>' + data[i].usuario + '</td>' +
                    '<td>' +
                    '<button type="button"  class="btn btn-warning fas fa-pen" data-toggle="modal" data-target="#updUser" onclick="getData(\'' + data[i].id_usuario + '\',\'' + data[i].nombre + '\',\'' + data[i].apellidos + '\',\'' + data[i].usuario + '\',\'' + data[i].contrasena + '\')"></button>' +
                    '<button type="button" class="btn btn-danger fas fa-trash-alt" data-toggle="modal" data-target="#delOperator" onclick=getDataId(\'' + data[i].id_usuario + '\')></button>' +
                    '</td>' +
                    '</tr>';
            }
            $("#loadDataUser").html(info);
        }
    })
}

$("#updUser").submit(function(event) { //metodo para actualizar al operador
    var id_user = $("#UpdateidOperator").val()
    var UpdateOperatorName = $("#UpdateOperatorName").val();
    var UpdateOperatorLastName = $("#UpdateOperatorLastName").val();
    var UpdateOperatorUser = $("#UpdateOperatorUser").val();
    if ($("#UpdateOperatorPassword").val() == "") {
        var UpdateOperatorPassword = $("#UpdateOperatorPasswordGet").val();
    } else {
        var UpdateOperatorPassword = $("#UpdateOperatorPassword").val();
    }
    $.ajax({
        type: 'GET',
        url: './json/administrator.php',
        data: {
            'administrator': 'updateOperator',
            'name': UpdateOperatorName,
            'lastname': UpdateOperatorLastName,
            'user': UpdateOperatorUser,
            'password': UpdateOperatorPassword,
            'id_user': id_user
        },
        beforeSend: function(event) {
            $("#resultOperator").html("Enviando...");
            $("#resultOperator").show();
        },
        success: function(data) {
            $("#closeUpd").trigger('click');
            setTimeout(function() {
                $("#resultOperator").hide(1500);
                $("#resultOperator").html("Actualizando Datos...");
                loadUserAdministrator();
            }, 2000);
        }
    });
    event.preventDefault();
})


$("#delOperator").submit(function(event) { //metodo para eliminar al operador
    var id = $("#DeleteOperatorId").val();
    $.ajax({
        type: 'GET',
        url: './json/administrator.php',
        data: { 'administrator': 'deleteOperator', 'id_user': id },
        beforeSend: function(event) {
            $("#resultOperator").html("Eliminando...");
            $("#resultOperator").show();
        },
        success: function(data) {
            $("#closeOperatorDelete").trigger('click');
            setTimeout(function() {
                $("#resultOperator").hide(1500);
                loadUserAdministrator();

            }, 2000);
        }
    });
    event.preventDefault();
});

$("#addUser").submit(function(event) { //metodo para agregar al operador
    var id = $("#id_admin").val();
    var OperatorName = $("#AddOperatorName").val();
    var OperatorLastName = $("#AddOperatorLastName").val();
    var OperatorUser = $("#AddOperatorUser").val();
    var OperatorPassword = $("#AddOperatorPassword").val();

    $.ajax({
        type: 'GET',
        url: './json/administrator.php',
        data: {
            'administrator': 'insertOperator',
            'name': OperatorName,
            'lastname': OperatorLastName,
            'user': OperatorUser,
            'password': OperatorPassword,
            'id_admin': id
        },
        beforeSend: function(event) {
            $("#resultOperator").html("Enviando...");
            $("#resultOperator").show();
        },
        success: function(data) {
            $("#AddOperatorName").val("");
            $("#AddOperatorLastName").val("");
            $("#AddOperatorUser").val("");
            $("#AddOperatorPassword").val("");
            $("#cerrar").trigger('click');
            setTimeout(function() {
                $("#resultOperator").hide(1500);
                $("#resultOperator").html("Guardado...");
                loadUserAdministrator();
            }, 2000);
        }
    });
    event.preventDefault();
});

$("#addArmazon").submit(function(event) {
    var id = $("#id_admin").val();
    var stock = parseInt($("#insertstock").val());
    var marca = $("#insertmarca").val();
    var descripcion = $("#insertdescripcion").val();
    var precio = $("#insertprecio").val();
    var imagen = $("#insertImage").val();

    $.ajax({
        type: 'GET',
        url: './json/administrator.php',
        data: {
            'administrator': 'insertArmazon',
            'instock': stock,
            'insmarca': marca,
            'insdescripcion': descripcion,
            'insprecio': precio,
            'insimagen': imagen
        },
        beforeSend: function(event) {
            $("#resultOperator").html("Enviando...");
            $("#resultOperator").show();
        },
        success: function(data) {
            $("#insertstock").val("");
            $("#insertmarca").val("");
            $("#insertdescripcion").val("");
            $("#insertprecio").val("");
            $("#insertImage").val("");
            $("#cerrar").trigger('click');
            setTimeout(function() {
                $("#resultOperator").hide(1500);
                $("#resultOperator").html("Guardado...");
                loadUserAdministrator();
            }, 2000);
        }
    });
    event.preventDefault();
});

$("#addCampaings").submit(function(event) { //metodo para agregar la campaña y a su operador
    var id_user = parseInt($("#loadDataUserCheckBox").val());
    var CampaingName = $("#campName").val();
    var CampaingImg = $("#campImg").val();
    var CampaingIdPage = $("#loadDataUserPage").val();

    if ($("#switchFacebook").val() == "false") {
        var switchFacebook = 0;
    } else {
        var switchFacebook = 1;
    }

    if ($("#switchTwitter").val() == "false") {
        var switchTwitter = 0;
    } else {
        var switchTwitter = 1;
    }

    if ($("#switchTwitter").val() == "false") {
        var switchTwitter = 0;
    } else {
        var switchTwitter = 1;
    }

    if ($("#switchInstagram").val() == "false") {
        var switchInstagram = 0;
    } else {
        var switchInstagram = 1;
    }

    if ($("#switchPinterest").val() == "false") {
        var switchPinterest = 0;
    } else {
        var switchPinterest = 1;
    }

    if ($("#switchPinterest").val() == "false") {
        var switchPinterest = 0;
    } else {
        var switchPinterest = 1;
    }

    if ($("#switchWhatsapp").val() == "false") {
        var switchWhatsapp = 0;
    } else {
        var switchWhatsapp = 1;
    }

    if ($("#switchMessenger").val() == "false") {
        var switchMessenger = 0;
    } else {
        var switchMessenger = 1;
    }

    if ($("#switchSms").val() == "false") {
        var switchSms = 0;
    } else {
        var switchSms = 1;
    }

    if ($("#switchTelegram").val() == "false") {
        var switchTelegram = 0;
    } else {
        var switchTelegram = 1;
    }

    $.ajax({
        type: 'GET',
        url: './json/administrator.php',
        data: {
            'administrator': 'insertCampaings',
            'name': CampaingName,
            'id_page': CampaingIdPage,
            'img_camp': CampaingImg,
            'id_user': id_user,
            'es_facebook': switchFacebook,
            'es_twitter': switchTwitter,
            'es_instagram': switchInstagram,
            'es_pinterest': switchPinterest,
            'es_whatsapp': switchWhatsapp,
            'es_messenger': switchMessenger,
            'es_sms': switchSms,
            'es_telegram': switchTelegram
        },
        beforeSend: function(event) {
            $("#resultCampanas").html("Enviando...");
            $("#resultCampanas").show();

        },
        success: function(data) {
            console.log(data)
            $("#campName").val("");
            $("#switchFacebook").attr('disable')
            $("#closeCampaings").trigger('click');
            setTimeout(function() {
                $("#resultCampanas").hide(1500);
                $("#resultCampanas").html("Guardado...");
                loadCampaingsAdministrator();
            }, 2000);

        },
        error: function(data) {
            console.log(data);
        }
    });
    event.preventDefault();
});



function getData(id_usuario, name, lastname, user, contrasena) { //metodo para mandar informacion a los modales de los operadores
    $("#UpdateidOperator").val(id_usuario);
    $("#UpdateOperatorName").val(name);
    $("#UpdateOperatorLastName").val(lastname);
    $("#UpdateOperatorUser").val(user);
    $("#UpdateOperatorPasswordGet").val(contrasena);
}

function getDataId(id) { //metodo que manda el id del operador al modal de eliminar
    $("#DeleteOperatorId").val(id);
}

function mostrarHome() {
    document.getElementById("tablaUser").style.display = "none";
    document.getElementById("tablaCampanas").style.display = "none";
    document.getElementById("tablaHome").style.display = "block";
}

function mostrarUsuarios() {
    document.getElementById("tablaUser").style.display = "block";
    document.getElementById("tablaCampanas").style.display = "none";
    document.getElementById("tablaHome").style.display = "none";
}

function mostrarCampanas() {
    document.getElementById("tablaUser").style.display = "none";
    document.getElementById("tablaCampanas").style.display = "block";
    document.getElementById("tablaHome").style.display = "none";
}