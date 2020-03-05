//esta capa solo se dedica a consultar,eliminar,modificar,agregar funcionalidades para el operador
$(function () {
    getCampaingsUser();
});

function statusChangeCallback(response) {
    console.log("method statusChangeCallback");
    //devolvera un objeto json solo si inicias sesion
    if (response.status === "connected") {
        //se mostratara solo si la persona inicia sesion en tu aplicacion
        testAPIUser();

        getCampaingsUser();
    } else {
        // Se mostrara si la persona no ha iniciado sesion en la aplicacion
        console.log("sesion cerrada");
    }
}

function checkLoginState() {  //metodo para checar el estado devuelta en un callback 
    FB.getLoginStatus(function (response) {
        statusChangeCallback(response);
        setTimeout(() => {
            $("#close_modal").trigger('click');
        }, 600);

    });
}


function testAPIUser() { //metodo que te devuelve el perfil de facebook adjuntar access_token
    console.log("method testAPI ");
    FB.api("/me?fields=first_name,last_name,link,picture{url}", function (response) {

        info = `<li class="nav-item avatar">
                            <a class="nav-link p-0 float-left" href="${response.link}" target="_blank">
                            <p class="float-left mt-1 mr-2 text-primary">${response.first_name} ${response.last_name}</p>
                                <img class="float-left rounded-circle" src="${response.picture.data.url}"
                                    class="rounded-circle z-depth-0" alt="avatar image" height="35">
                            </a>
                            <button type="button" class="btn btn-warning btn-sm float-left ml-1" onclick="logout()">
                            <i class="fas fa-sign-in-alt text-light"></i>
                            </button>          
                </li>`;

        $("#profile_facebook").html(info).fadeIn(600);
        $("#btn_facebook_modal").attr('disabled', true);
    });
}




function testApiPageCommentsAndStates(id_page) { //metodo que te devuelve las publicaciones de la pagina 
    console.log("testApiPageCommentsAndStates");
    FB.api(
        '/' + id_page + '/',
        'GET',
        { "fields": "feed{message,id,full_picture,created_time},picture{url},name" },
        function (response) {

            var getPublished = "";
            getimg = "";

            for (i = 0; i < response.feed.data.length; i++) {
                if (response.feed.data[i].full_picture == null) {
                    getimg = `${response.feed.data[i].message}`;
                    $(".postcontentText").val(getimg);
                } else {
                    getimg = `${response.feed.data[i].message}
                        <div class="tc">
                            <img src="${response.feed.data[i].full_picture}" class="card-img w-50 h-50">
                        </div> `;
                    $(".postcontentText").val(getimg);
                }

                getPublished += `
                <div class="recentcontainer">
                <div class="newpostheader">
                    <a href="javascript:void(0)">
                        <img src="${response.picture.data.url}"/>
                        <span class="name">${response.name}</span>
                    </a>
                </div>
                <div class="newpost">
                    <div class="postcontentText">
                       ${getimg}
                    </div>
                </div>
                <ul class="newpostfooter nav nav-tabs nav-justified">
                    <li>
                        <a href="javascript:void(0)">
                            <i class="fa fa-thumbs-up"></i>
                            <span>Like</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" title="Leave a comment">
                            <i class="fa fa-comment-o"></i>
                            <span>Comentar</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" title="Send this to friends or post it to your timeline">
                            <i class="fa fa-share"></i>
                            <span>Compartir</span>
                        </a>
                    </li>
                </ul>
                <div class="commentpost">
                    <div class="input-group">
                        <a href="javascript:void(0)">
                            <img src="${response.picture.data.url}" />
                        </a>

                        <textarea class="form-control" placeholder="Write a comment..."></textarea>
                        <div class="input-group-btn">
                            <a class="btn btn-default" href="javascript:void(0)">
                                <i class="fa fa-smile-o"></i>
                            </a>
                            <a class="btn btn-default" href="javascript:void(0)">
                                <i class="fa fa-picture-o"></i>
                            </a>
                            <a class="btn btn-default" href="javascript:void(0)">
                                <i class="fa fa-gift"></i>
                            </a>
                        </div>
                    </div>
                </div>
                </div>`;
            }

            $("#getPublishedFacebook").html(getPublished);
        }
    );
}

function logout() { //metodo para cerrar la sesion de facebook
    console.log("method logout");
    FB.logout(function (response) {
        statusChangeCallback(response);
        $("#profile_facebook").fadeOut(600);
        $("#btn_facebook_modal").attr('disabled', false);
    });
}

function getCampaingsUser() { //metodo que obtiene las campañas del usuario 
    var id = $("#id_user").val();

    $.ajax({
        type: "GET",
        url: './json/user.php',
        data: { 'user': 'readCampaingsUser', 'id_user': id },
        dataType: 'json',
        success: function (response) {
            var data = response['CampaingsUser'];
            var i;
            var info = "";
            var iconFacebook = "", iconTwitter = "", iconInstagram = "", iconPinterest = "", iconWhatapp = "", iconMessenger = "", iconSms = "", iconTelegram = "";

            for (i = 0; i < data.length; i++) {
                if (data[i].es_facebook == 1) {
                    iconFacebook = '<i class="fab fa-facebook-f p-3 m-1 text-light" style="background-color:#4267B2; font-size:15px;"></i>';
                } else {
                    iconFacebook = '';
                }
                if (data[i].es_twitter == 1) {
                    iconTwitter = '<i class="fab fa-twitter text-light p-3 m-1" style = "background-color:#31c6f7;font-size:15px;cursor: pointer" ></i >';
                } else {
                    iconTwitter = '';
                }

                if (data[i].es_instagram == 1) {
                    iconInstagram = '<i class="fab fa-instagram p-3 m-1 text-light" style = "font-size:15px;background-image: linear-gradient(to bottom right, #533fd0, #bd2594, #ea1c41,#ed8f53 , #f7bb51);cursor: pointer" ></i>';
                } else {
                    iconInstagram = '';
                }

                if (data[i].es_messenger == 1) {
                    iconMessenger = '<i class="fab fa-facebook-messenger p-3 m-1 text-light"' +
                        'style="background-color:#009DF8;font-size:15px;cursor: pointer"' +
                        'data-toggle="collapse" href="#collapseMessenger" role="button"' +
                        'aria-expanded="false" aria-controls="collapseMessenger"></i >';
                } else {
                    iconMessenger = '';
                }

                if (data[i].es_whatsapp == 1) {
                    iconWhatapp = '<i class="fab fa-whatsapp p-3 m-1 text-light" style="background-color: #22CF64;font-size:15px;cursor: pointer"></i>';
                } else {
                    iconWhatapp = '';
                }

                if (data[i].es_telegram == 1) {
                    iconTelegram = '<i class="fab fa-telegram-plane text-light p-3 m-1" style="background-color:#42a2e5;font-size:15px;cursor: pointer"></i>';
                } else {
                    iconTelegram = "";
                }

                if (data[i].es_pinterest == 1) {
                    iconPinterest = '<i class="fab fa-pinterest-p p-3 m-1 text-light" style="background-color:#e00022;font-size:15px;cursor: pointer"></i>';
                } else {
                    iconTwitter = '';
                }

                if (data[i].es_sms == 1) {
                    iconSms = '<i class="far fa-envelope p-3 m-1 text-light" style="background-color:#f8b900;font-size:15px;cursor: pointer"></i>';
                } else {
                    iconSms = "";
                }
                info += `<div class="col-sm-6">
                                            <div class="card" onclick="getCampaingsOneUser(${i});entrarCampaing()">
                                                <div class="row no-gutters">
                                                    <div class="col-md-4">
                                                        <img width="231px" height="153px" src="${data[i].img_campana}" class="card-img">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body p-0">
                                                            <h5 class="card-title">${data[i].nombre_campana}</h5>
                                                            <p class="card-text">${iconFacebook}${iconMessenger}${iconInstagram}${iconWhatapp}${iconTelegram}${iconTwitter}${iconPinterest}${iconSms}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                        </div>`;
            }

            $("#getCampaingsUser").html(info);
        }
    })
}

function entrarCampaing() { //metodo para desaparecer todas las campañas
    $("#facebook_ocult").fadeOut();
    $("#getCampaingsOneUser").fadeIn();
    $("#chatContent").fadeIn();
    $("#btn_volver").fadeOut();
}

function getCampaingsOneUser(id_campaing) { //metodo para visualizar una campaña
    var id = $("#id_user").val();

    $.ajax({
        type: "GET",
        url: './json/user.php',
        data: { 'user': 'readCampaingsUser', 'id_user': id },
        dataType: 'json',
        success: function (response) {
            var data = response['CampaingsUser'];
            info = "";
            publishedContent = "";

            info = `<div class="col-sm-4">
                            <div class="card shadow-lg p-1 mb-1 btn-sm btn-lg bg-white rounded">
                                <div class="card-body">
                                <button type="button" class="btn btn-danger float-left" onclick="atras()">Atras</button>
                                    <button type="button" class="btn btn-success float-right" data-toggle="modal"
                                        data-target="#publishedModal">Agregar publicacion</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                         <div class="card shadow-lg p-1 mb-1 btn-sm btn-lg bg-white rounded">
                           <div class="    
                           }
                           feed-content" id="getPublishedFacebook">
                            </div> 
                          </div>
                            
                        </div>
                        `;
            publishedContent = `  <div class="row" id="chat_disable">
                            <div class="col-md-4">
                                <div class="inbox_people">
                                    <div class="headind_srch">
                                        <div class="recent_heading">
                                            <h4>Mensajes</h4>
                                        </div>
                                        <div class="srch_bar">
                                          <button type="button" id="btn_volver" class="btn btn-danger btn-sm" onclick="volverchat()"><i class="fas fa-angle-left"></i></button>
                                        </div>
                                    </div>
                                    <div class="inbox_chat" id="getChatPage">
                                    </div>

                                    <div class="mesgs">


                                    </div>
                                </div>`;

                               


            setTimeout(() => {
                $("#getCampaingsOneUser").html(info);
                $("#chatContent").html(publishedContent);
                testApiPageCommentsAndStates(data[id_campaing].id_page);
                pageInformationConstToken(data[id_campaing].id_page);
                $("#btn_volver").fadeOut();
            }, 500)
        }
    });
}

function atras() { //metodo para regresar a todas las campañas
    $("#facebook_ocult").fadeIn();
    $("#getCampaingsOneUser").fadeOut();
    $("#chatContent").fadeOut();
}



function pageInformationConstToken(id_page) { //metodo para obtener el token constante porque si no recibe un token en constante cambio la aplicaciones 
    //se quedara trabada 
    FB.api(
        '/' + id_page + '/',
        'GET',
        { "fields": "access_token,name" },
        function (response) {

            var html = `<div id="publishedModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
           aria-hidden="true">
               <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header" style="background-color:#ECF0F1;">
                    <h5 class="modal-title" id="exampleModalLabel">Publicaciones para ${response.name}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">  
                    <form>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label ">Escriba lo que desea publicar</label>
                            <textarea class="form-control border border-dark" id="message-text"></textarea>
                        </div>
                    </form>
                    
                   

                    <input type="hidden" id="valueIMG">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="postStatePage(${id_page})">Publicar</button>
                </div>
            </div>
        </div>
         </div>`;

            $("#access_token_page").val(response.access_token);

            $("#modalPublishedPage").html(html);

            conversationChat(id_page);
        }
    );
}

function postStatePage(id_page) { //metodo para publicar el estado con diferentes opciones con foto y sin foto.
    console.log('postStatePage');
    switch ($("#valueIMG").val() != "" || $("#valueIMG").val() == "") {
        case $("#valueIMG").val() == "":
            FB.api(
                "/" + id_page + "/feed",
                'POST',
                { "message": $("#message-text").val(), 'access_token': $("#access_token_page").val() },
                function (response) {
                    testApiPageCommentsAndStates(id_page);
                });
            break;
        case $("#valueIMG").val() != "":
            FB.api(
                "/" + id_page + "/photos",
                'POST',
                { "caption": $("#message-text").val(), "url": $("#valueIMG").val(), "access_token": $("#access_token_page").val() },
                function (response) {
                    testApiPageCommentsAndStates(id_page);
                }
            );
            break;
    }
}



function uploadImagen() { //funcion para subir una imagen al servidor
    var formData = new FormData();
    var files = $('#inputGroupFile04')[0].files[0];
    formData.append('file', files);
    $.ajax({
        url: './json/user.php?user=uploadServer',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response != 0) {
                $("#valueIMG").val(response);
            } else {
                console.log("Formato de imagen incorrecto.");
            }
        }
    });
    return false;
}


function conversationChat(id_page) { //funcion para iniciar el chat en el home-user<
    console.log('conversationChat');
    FB.api(
        '/' + id_page + '/',
        'GET',
        { "fields": "conversations{id,senders,unread_count}", "access_token": $("#access_token_page").val() },
        function (response) {

            var published = "";

            for (i = 0; i < response.conversations.data.length; i++) {
                if (response.conversations.data[i].unread_count == 0) {
                    var v = `<span class="badge badge-info">Sin mensajes</span>`;
                } else {
                    var v = `<span class="badge badge-warning">${response.conversations.data[i].unread_count} Mensajes Nuevos</span>`;
                }
                published += `<div class="chat_list">
                                            <div class="chat_people">
                                                <div class="chat_img"> 
                                                <img src="https://ptetutorials.com/images/user-profile.png"
                                                        alt="sunil"> </div>
                                                <div class="chat_ib">
                                                    <h5>${response.conversations.data[i].senders.data[0].name}${v}</h5>
                                                    <h5><span><button type="button" class="btn btn-primary btn-sm" onclick="chatPerson('${response.conversations.data[i].id}','${id_page}');"><i class="fas fa-arrow-circle-right"></i></button></span></h5>
                                                </div>
                                            </div>
                                        </div>`
            }
            $("#getChatPage").html(published);
        }
    );
}

function volverchat(){ //vuelve de chat individual por persona a un chat general de muchas personas
    $("#getChatPage").fadeIn(); 
    $(".mesgs").fadeOut();
    $("#btn_volver").fadeOut();
}


function chatPerson(id_chat,id_page){ //inicializar el chat individual entre pagina y usuario
    console.log("chatPerson");
    console.log(id_chat);
    console.log(id_page);
    FB.api(
        '/'+id_chat,
        'GET',
        { "fields": "participants,messages{message,id,to}", "access_token": $("#access_token_page").val()},
        function (response) {
            
            var chat="";
            
            for (i = 0; i < response.messages.data.length; i++) {
                console.log(response.messages.data[i].to.data[0]);
                if(response.messages.data[i].to.data[0].id != id_page){
                    var messengeClient = `
                        <div class="incoming_msg">
                                    <div class="incoming_msg_img"> <img  
                                            src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
                                    </div>
                                    <div class="received_msg">
                                        <div class="received_withd_msg">
                                            <p>${response.messages.data[i].message}</p>
                                            <span class="time_date"> 11:01 AM | Yesterday</span>
                                        </div>
                                    </div>
                        </div>
                    `;
                }else{
                    var menssengePage = `<div class="outgoing_msg">
                                    <div class="sent_msg">
                                        <p>${response.messages.data[i].message}</p>
                                        <span class="time_date"> 11:01 AM | Today</span>
                                    </div>
                        </div>`; 
                   
                }
                chat = `    <div class="msg_history">  
                                ${messengeClient}
                                ${menssengePage} 

                            </div>
                            <div class="type_msg">
                                <div class="input_msg_write">
                                    <input type="text" id="messageChat" class="write_msg" placeholder="Escriba su mensaje"/>
                                    <button class="msg_send_btn" type="button" onclick="responseChat('${id_chat}')"><i class="fas fa-paper-plane"></i></button>
                                </div>
                            </div>`;
            }
            $(".mesgs").html(chat);
            $(".mesgs").fadeIn();
            $("#getChatPage").fadeOut();
            $("#btn_volver").fadeIn();
        }
    )
}

function responseChat(id_chat){ //responde el chat individual
    console.log("responseCaht");
    FB.api(
        '/'+id_chat+'/messages',
        'POST',
        { "message": $("#messageChat").val(), "access_token": $("#access_token_page").val()},
        function (response) {
            console.log(response);
            $("#messageChat").val("")
        }
    );
}