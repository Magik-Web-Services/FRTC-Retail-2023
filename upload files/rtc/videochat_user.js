
function GetStreamerByName(roomName) {
    for (var i = 0; i < Users.length; i++) {
        if (Users[i].Username === roomName && Users[i].IsStreamer === true) {
            return Users[i];
        }
    }
    return null;
}

function GetQueryParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

/* End Database Logic */







var connection = new RTCMultiConnection();
forcefullyleft = false;
var VideoChat =
{
    SocketUrl: "",   // Location of the server and the port
    MyChatId: null, // Chat Id
    Lovenset: null, // lovense

    ActiveUser: null, // Database user (member or model), null if loged in as guest
    Streamer: null, // null if streamer is off-line, or the streamer is loged in himself
    Admin: null, //admin status

    micEnabled: true,
    camEnabled: true,
    


    MAX_CALLERS: 100, // Max number of people in stream/chat
    MAX_MESSAGES: 50, // Max number of messages shown in chat before cleaning the oldest at the top
    MAX_MESSAGE_Length: 256, // The max number of character in chat per message

    IsPrivateChat: false,
    PrivateChatMode: 0, // 0 - not part of the private chat, 1- is spectator of the private chat (can only see the video of model, no sound,no chat), 2 - is in private chat

    CurrentPage: 0, // 0 - Homepage, 1- Chat Rooms, 2- Chat Room User, 3- Chat Room Streamer

    CurrentRoomName: null, // Name of the Room I'm in (Jasmin, Cat, ...)
    CurrentRoomUsers: [], // Current users in the chat Room
    ChatGroup: null, // List of user Id to send a message (for later use if needed, sending a message to 3 people of 10, ... )
    SelectedUserId: null, // User selected from the user list to send a private message

    PendingPrivateChatRequest: null, // There is a active private chat request (id of user if so, null if none)
    ActivePrivateChatUserId: null, // Id of the user we have the private chat with

    IamReconnecting: false, // For private chat logic, to reconnect the user and switch from normal to private chat and the other way

    timeOutID: 0, //regular billing interval
    ptimeOutID: 0, //private user billing interval

    connection: "",
    model: "",
    Session: "",
    Countdown: 0, // timer till notification removal
    CountdownTimeOutID: 0,


    Init: function () {
        console.log("<---------- Init");

        //check if socket url was set in php
        if (mediaUrl != '') {
            VideoChat.SocketUrl = mediaUrl;
        }
        //if(lovense_token != ''){
        //  VideoChat.Lovenset = lovense_token;
        //}

		
        connection.socketURL = mediaUrl;
        
        connection.extra.userFullName = udata;

        connection.publicRoomIdentifier = "Your-Password-Change-This-NOW";

        connection.socketMessageEvent = 'canvas-dashboard-demo';
        //connection.autoCreateMediaElement = false;

 
        connection.iceServers = [{
            urls: ["stun:your-stun-URL.com:3478" ] 
         }, {
            username: "username",
            credential: "password", 
            urls: [
            "turn:your-turn-URL.com:3478"
            ]
         }];



        connection.autoCloseEntireSession = true;
         connection.maxParticipantsAllowed = 30;

        connection.session = {
            audio: true,
            video: true,
            data: true 
        };
        connection.sdpConstraints.mandatory = {
            OfferToReceiveAudio: true,
            OfferToReceiveVideo: true
        };
          
     

        connection.onUserStatusChanged = function (event) {
            var infoBar = document.getElementById('onUserStatusChanged');
            var names = [];
            connection.getAllParticipants().forEach(function (pid) {
            console.log(pid);
                names.push(pid);
            });
            console.log(names);

//            if (!names.length) {
//                names = ['Only You'];
//            } else {
//                names = [connection.extra.userFullName || 'You'].concat(names);
//            }

           // infoBar.innerHTML = '<b>Active users:</b> ' + names.join(', ');

          //  $("#active-users").text(names.length);

                
          VideoChat.HTML_NewUserInRoom(connection.sessionid,names);

        };

        connection.onopen = function (event) {

            connection.onUserStatusChanged(event);
            console.log("new user joined");
            

        };




        connection.onclose = connection.onerror = connection.onleave = function (event) {

            

            if(event.extra.roomOwner == true)
            {
                
                if(VideoChat.PrivateChatMode ==2)
                {
                
                VideoChat.HTML_NotificationOneButton("Private Chat!", "The private chat with " + VideoChat.CurrentRoomName + " has ended.", "OK", "#", null);
                connection.leave();
                setTimeout(function () { window.location.reload(); }, 1500); // Disconnect user from private chat
                }
                else
                {            
                window.location.reload();
                }

            }

             if (event.type == "close" && event.extra.userFullName != undefined)
                console.log("User left");

            connection.onUserStatusChanged(event);
        };


        connection.onmessage = function (event) {
            if (event.data.showMainVideo) {



                // $('#main-video').show();
                $('#screen-viewer').css({
                    top: $('#widget-container').offset().top,
                    left: $('#widget-container').offset().left,
                    width: $('#widget-container').width(),
                    height: $('#widget-container').height()
                });
                $('#screen-viewer').show();
                return;
            }

            if (event.data.leaveMyRoom) {

                if (event.data.remoteUserId !== connection.userid) return;
                // room owner asked to leave his room
                if (event.data.leaveMyRoom === true) {
                  VideoChat.HTML_AddToConversation("", "kick", event.data.msg, "","") 
                }

                return;
            }
              if (event.data.Refresh) {
                
                if (event.data.pcchatid == connection.userid) return;
                  // room owner asked to refresh other than private chat user his room
                if (event.data.Refresh === true) {
                    setTimeout(function(){  location.reload(); },2000);
                }

                return;
            }

            if (event.data.MuteUnmuteVideo) {

                if (event.data.remoteUserId !== connection.userid) return;
                // room owner asked to mute cam of this user
                if (event.data.MuteVideo === true) {
                    ShowToasterMsg("", "Admin has muted your cam", "info");
                    muteVideo();
                } else {
                    ShowToasterMsg("", "Admin has unmuted your cam", "info");
                    UnmuteVideo();

                }

                return;
            }
            if (event.data.MuteUnmuteAudio) {

                if (event.data.remoteUserId !== connection.userid) return;
                // room owner asked to mute cam of this user
                if (event.data.MuteAudio === true) {
                    ShowToasterMsg("", "Admin has muted your mic", "info");
                    muteAudio();
                } else {
                    ShowToasterMsg("", "Admin has unmuted your mic", "info");
                    unmuteAudio();

                }

                return;
            }



            if (event.data.hideMainVideo) {
                // $('#main-video').hide();
                $('#screen-viewer').hide();
                return;
            }

            if (event.data.typing === true) {
                $('#key-press').show().find('span').html(event.extra.userFullName + ' is typing');
                return;
            }

            if (event.data.typing === false) {
                $('#key-press').hide().find('span').html('');
                return;
            }

            if (event.data.chatMessage) {
                appendChatMessage(event);
                return;
            }

            if (event.data.checkmark === 'received') {
                var checkmarkElement = document.getElementById(event.data.checkmark_id);
                if (checkmarkElement) {
                    checkmarkElement.style.display = 'inline';
                }
                return;
            }

            if (event.data === 'plz-sync-points') {
                designer.sync();
                return;
            }

            if (event.data.speaking || event.data.silent) {
                var streamObject = document.getElementById(event.data.streamid);
                if (event.data.speaking && streamObject) {

                    console.log('speaking');
                    console.log(event.data.streamid);
                  //  document.getElementById(event.data.streamid).style.border = "2px solid red";


                }
                else {
                    console.log('speaking end');
                   // document.getElementById(event.data.streamid).style.border = "none";
                }
            }

            if (event.data.hand) {

                var div_id = event.data.userid;

                if (event.data.raised == true)
                    $("img[class='img_hand']", "#" + div_id).show();
                else
                    $("img[class='img_hand']", "#" + div_id).hide();
            }

            if (event.data.notifications) {
                ShowToasterMsg("Hand Raised/Lower", event.data.text, "info");
            }

            if (event.data.Starttranscription) {
                transcription_on_off = true;
                startSpeaking();

            }

            if (event.data.Stoptranscription) {
                transcription_on_off = false;


            }


            if (event.data.filetext) {
                user = event.data.UserId;
                span = document.createElement("span");
                span.className = user;
                span.innerText = event.data.ttext;

                document.getElementById("div_text").appendChild(span);

                console.log(event.data.ttext + ' ' + event.data.UserId);

            }



        };

        connection.onstream = function (event) {
          if(!event.stream.isScreen)
        {
            console.log("<-------------onstream");

             
//            if (easyrtc.idToName(chatId) === VideoChat.CurrentRoomName) 
//            { // The source of the stream is the streamer/model to user

//               
//                easyrtc.setVideoObjectSrc(document.getElementById("streamerVideo"), stream); // connect the video tag with the stream


//            } else if (easyrtc.idToName(VideoChat.MyChatId) === VideoChat.CurrentRoomName) { // The source of the stream is the user to streamer/model
//                if (VideoChat.PrivateChatMode === 2) {
//                    $("#streamerVideo").removeClass("hidden");
//                    $("#streamerVideo").addClass("mainVideo");

//                    $("#selfVideo").removeClass("mainVideo");
//                    $("#selfVideo").removeClass("hidden");

//                    VideoChat.SelectedUserId = chatId;
//                    VideoChat.CloseNotification();
//                    easyrtc.setVideoObjectSrc(document.getElementById("streamerVideo"), stream);
//                }

//            }

//            //Call custom HTML modifications
//            VideoChat.HTML_Custom_Changes();
//            VideoChat.HTML_UpdateInterface();

//            $(".request").remove();











            if (event.extra.roomOwner === true) 
            {
                
                console.log("<event-------------roomOwner");
             
                if (event.type === 'local') {
//                    event.mediaElement.muted = true;
//                    event.mediaElement.volume = 0;
                    $("#streamerVideo").prop('muted','muted');
                }
                else {
              //      event.mediaElement.muted = false;
              //      event.mediaElement.volume = 1;
                }
                 event.mediaElement.muted = true;
                 event.mediaElement.volume = 0;

                $("#streamerVideo").removeClass("hidden"); // show the streamer video tag
                $("#streamerVideo").addClass("mainVideo"); // set it as the main window

                $("#selfVideo").removeClass("mainVideo"); // set my video as secondary (at the bottom right corner)

                if (VideoChat.PrivateChatMode === 2  && connection.extra.roomOwner) { // I'm in private chat mode, so show my video too
                   console.log("VideoChat.PrivateChatMode === 2  && connection.extra.roomOwner   self video set");
                    $("#selfVideo").removeClass("hidden");
                     document.getElementById("selfVideo").srcObject = event.stream;
                } 
                else if (VideoChat.PrivateChatMode === 2 && !connection.extra.roomOwner) {
                     console.log("Else of VideoChat.PrivateChatMode === 2  && connection.extra.roomOwner streamer video set");
                     document.getElementById("streamerVideo").srcObject = event.stream;
                }
                else
                {
                     $("#selfVideo").addClass("hidden");
                     document.getElementById("streamerVideo").srcObject = event.stream;
                
                }

               
                
            }
             
            else {
   
                 event.mediaElement.muted = true;
                 event.mediaElement.volume = 0;

             if (VideoChat.PrivateChatMode === 2) {
                    forcefullyleft = false;
                    $("#streamerVideo").removeClass("hidden");
                    $("#streamerVideo").addClass("mainVideo");

                    $("#selfVideo").removeClass("mainVideo");
                    $("#selfVideo").removeClass("hidden");

                    if(connection.extra.roomOwner)
                    {
                    console.log("connection.extra.roomOwner member's stream streamervideo ");
                    document.getElementById("selfVideo").srcObject = document.getElementById("streamerVideo").srcObject;
                    document.getElementById("streamerVideo").srcObject = event.stream;
                    }
                    else
                    document.getElementById("selfVideo").srcObject = event.stream;

                    VideoChat.SelectedUserId = connection.userid;
                    VideoChat.CloseNotification();

                     
                }
                

            }


           




        }
           // connection.onUserStatusChanged(event);

        };

        connection.onstreamended = function (event) {


         console.log("<---------- setOnStreamClosed");

          //  easyrtc.setVideoObjectSrc(document.getElementById("streamerVideo"), ""); // close the connection of stream and video tag

            // Private chat ends here since one of the participants ended it or disconnected/closed the chat or browser


            if (connection.extra.roomOwner) 
            {
                if (VideoChat.PrivateChatMode === 2) 
                {
                    console.log("<---------- VideoChat.PrivateChatMode === 2");
                    // Set back streamer/model vido to publick mode (self video as the main video without the secondary video

                     document.getElementById("streamerVideo").srcObject = document.getElementById("selfVideo").srcObject;
                     document.getElementById("selfVideo").srcObject = null;

                    $("#selfVideo").addClass("hidden");
                    $("#selfVideo").removeClass("mainVideo");

                    $("#streamerVideo").addClass("mainVideo");
                    $("#streamerVideo").removeClass("hidden");
                     

                    var usr_spyshow = "usr_spyshow";
                    var post_data = {
                        'modelname': usr_spyshow
                    };
                    $.ajax({
                        type: "POST",
                        url: "token_message.php",
                        data: post_data,
                        success: function (data) {

                        }
                    });
                    VideoChat.HTML_NotificationOneButton("Private Chat!", "The private chat with user has ended. Taking you back to normal broadcast", "OK", "#", null);
                   
                    connection.leave();
                    VideoChat.HTML_Setup_ChatRoomStreamer();

                    VideoChat.PrivateChatMode = 0;
            VideoChat.SelectedUserId = null;
            VideoChat.IsPrivateChat = false;
                     
                }
            }
            else if (VideoChat.PrivateChatMode === 2 && forcefullyleft === false) 
             {
                 
               // easyrtc.setVideoObjectSrc(document.getElementById("selfVideo"), ""); // close the connection of stream and video tag of the user from private chat
                $("#selfVideo").addClass("hidden");

                var usr_spyshow = "usr_spyshow";
                var post_data = {
                    'modelname': usr_spyshow
                };
                $.ajax({
                    type: "POST",
                    url: "token_message.php",
                    data: post_data,
                    success: function (data) {

                    }
                });
                VideoChat.HTML_NotificationOneButton("Private Chat!", "The private chat with " + VideoChat.CurrentRoomName + " has ended.", "OK", "#", null);
                connection.leave();
                setTimeout(function () { window.location.reload(); }, 1500); // Disconnect user from private chat
                //setTimeout(function () { VideoChat.HTML_Setup_ChatRoomUser(); }, 3000); // Connect back to public chat


             VideoChat.PrivateChatMode = 0;
            VideoChat.SelectedUserId = null;
            VideoChat.IsPrivateChat = false;
            }

             
           
            
              VideoChat.HTML_UpdateInterface();
            
        };


//        easyrtc.setPeerListener(VideoChat.HTML_AddToConversation); // New message/request



//        easyrtc.setRoomOccupantListener(VideoChat.HTML_NewUserInRoom); // New user in chat or someone left the chat room

//        easyrtc.setAcceptChecker(function (chatId, callback) {
//            console.log("<---------- setAcceptChecker");
//            //callback(false); // will let the user only use the chat without having access to the video of the streamer
//            callback(true); // Accept any incoming calls
//            console.log("chatId<---------- " + easyrtc.idToName(chatId));
//        });

//        easyrtc.setStreamAcceptor(function (chatId, stream) {
//            console.log("<---------- setStreamAcceptor");
//            console.log("var 1<---------- " + easyrtc.idToName(chatId));
//            console.log("var 2<---------- " + easyrtc.idToName(VideoChat.MyChatId));
//            if (easyrtc.idToName(chatId) === VideoChat.CurrentRoomName) { // The source of the stream is the streamer/model to user

//                $("#streamerVideo").removeClass("hidden"); // show the streamer video tag
//                $("#streamerVideo").addClass("mainVideo"); // set it as the main window

//                $("#selfVideo").removeClass("mainVideo"); // set my video as secondary (at the bottom right corner)

//                if (VideoChat.PrivateChatMode === 2) { // I'm in private chat mode, so show my video too
//                    $("#selfVideo").removeClass("hidden");

//                } else {
//                    $("#selfVideo").addClass("hidden");
//                }
//                easyrtc.setVideoObjectSrc(document.getElementById("streamerVideo"), stream); // connect the video tag with the stream


//            } else if (easyrtc.idToName(VideoChat.MyChatId) === VideoChat.CurrentRoomName) { // The source of the stream is the user to streamer/model
//                if (VideoChat.PrivateChatMode === 2) {
//                    $("#streamerVideo").removeClass("hidden");
//                    $("#streamerVideo").addClass("mainVideo");

//                    $("#selfVideo").removeClass("mainVideo");
//                    $("#selfVideo").removeClass("hidden");

//                    VideoChat.SelectedUserId = chatId;
//                    VideoChat.CloseNotification();
//                    easyrtc.setVideoObjectSrc(document.getElementById("streamerVideo"), stream);
//                }

//            }

//            //Call custom HTML modifications
//            VideoChat.HTML_Custom_Changes();
//            VideoChat.HTML_UpdateInterface();

//            $(".request").remove();
//        }); // Stream activated, broadcasting from streamer or private chat stream

//        easyrtc.setOnStreamClosed(function (chatId) {
//            console.log("<---------- setOnStreamClosed");

//            easyrtc.setVideoObjectSrc(document.getElementById("streamerVideo"), ""); // close the connection of stream and video tag

//            // Private chat ends here since one of the participants ended it or disconnected/closed the chat or browser


//            if (easyrtc.idToName(VideoChat.MyChatId) === VideoChat.CurrentRoomName) {
//                if (VideoChat.PrivateChatMode === 2) {
//                    // Set back streamer/model vido to publick mode (self video as the main video without the secondary video

//                    $("#streamerVideo").addClass("hidden");
//                    $("#streamerVideo").removeClass("mainVideo");

//                    $("#selfVideo").addClass("mainVideo");
//                    $("#selfVideo").removeClass("hidden");


//                    var usr_spyshow = "usr_spyshow";
//                    var post_data = {
//                        'modelname': usr_spyshow
//                    };
//                    $.ajax({
//                        type: "POST",
//                        url: "token_message.php",
//                        data: post_data,
//                        success: function (data) {

//                        }
//                    });
//                    VideoChat.HTML_NotificationOneButton("Private Chat!", "The private chat with user has ended.", "OK", "#", null);
//                    VideoChat.HTML_Setup_ChatRoomStreamer();

//                    //easyrtc.setVideoObjectSrc(document.getElementById("selfVideo"), easyrtc.getLocalStream());
//                    //setTimeout(function () { easyrtc.disconnect(); }, 1500); // Disconnect user from private chat
//                    //setTimeout(function () { easyrtc.connect(); }, 1500); // Disconnect user from private chat
//                    //setTimeout(function () { VideoChat.HTML_Setup_ChatRoomUser(); }, 3000); // Connect back to public chat
//                }
//            } else if (VideoChat.PrivateChatMode === 2) {
//                easyrtc.setVideoObjectSrc(document.getElementById("selfVideo"), ""); // close the connection of stream and video tag of the user from private chat
//                $("#selfVideo").addClass("hidden");

//                var usr_spyshow = "usr_spyshow";
//                var post_data = {
//                    'modelname': usr_spyshow
//                };
//                $.ajax({
//                    type: "POST",
//                    url: "token_message.php",
//                    data: post_data,
//                    success: function (data) {

//                    }
//                });
//                VideoChat.HTML_NotificationOneButton("Private Chat!", "The private chat with " + VideoChat.CurrentRoomName + " has ended.", "OK", "#", null);
//                setTimeout(function () { easyrtc.disconnect(); }, 1500); // Disconnect user from private chat
//                setTimeout(function () { VideoChat.HTML_Setup_ChatRoomUser(); }, 3000); // Connect back to public chat

//            }
                
//            VideoChat.PrivateChatMode = 0;
//            VideoChat.SelectedUserId = null;
//            VideoChat.IsPrivateChat = false;
//        });  // Stream closed, broadcasting from streamer or private chat stream

        this.HTML_UpdateInterface();
    },

    Reset: function () {
        console.log("<---------- Reset");

       // easyrtc.disconnect();
       connection.leave();

        VideoChat.MyChatId = null;
        VideoChat.ActiveUser = null;
        VideoChat.Streamer = null;

        VideoChat.IsPrivateChat = false;
        VideoChat.PrivateChatMode = 0;

        VideoChat.CurrentPage = 0;

        VideoChat.CurrentRoomName = null;
        VideoChat.CurrentRoomUsers = [];
        VideoChat.ChatGroup = null;
        VideoChat.SelectedUserId = null;

        VideoChat.PendingPrivateChatRequest = null;
        VideoChat.ActivePrivateChatUserId = null;

        VideoChat.IamReconnecting = false;

        $(".request").remove();
        VideoChat.HTML_UpdateInterface();
    },

    LogIn: function (username, password) {
        console.log("<---------- LogIn");

        for (var i = 0; i < Users.length; i++) {
            if (Users[i].Username === username && Users[i].Password === password) {
                VideoChat.ActiveUser = Users[i];

               // easyrtc.setUsername(VideoChat.ActiveUser.Username);
               // easyrtc.setCredential({ "password": VideoChat.ActiveUser.Password });

                if (VideoChat.ActiveUser.IsStreamer) {
                    VideoChat.HTML_Setup_ChatRoomStreamer(); // prepare the interface for the streamer/model
                } else {
                   $(".mic,.mute,.cam").hide();
                    VideoChat.HTML_Setup_ChatRoomUser(); // prepare the interface for the registered user
                }
                return;
            }
        }
    },

    LogInAsGuest: function () {

        $(".mic,.mute,.cam,.requestPrivateChat").hide();
        console.log("<---------- LogInAsGuest");
        VideoChat.HTML_Setup_ChatRoomUser();
        //easyrtc.setVideoObjectSrc(document.getElementById("streamerVideo"), stream);

    },

    LogOut: function () {
        console.log("<---------- LogOut");
//        easyrtc.hangupAll();
//        easyrtc.disconnect();
//        easyrtc.setVideoObjectSrc(document.getElementById('selfVideo'), "");
//        easyrtc.setVideoObjectSrc(document.getElementById('streamerVideo'), "");
            connection.leave();
        VideoChat.Reset();
    },

    ConnectStreamer: function () {
        console.log("<---------- ConnectStreamer");

        //easyrtc.setVideoDims(1280,720);
    //    easyrtc.enableAudio(true);
      //  easyrtc.enableVideo(true);
        //easyrtc.setVideoDims(800,600);
   //     easyrtc.joinRoom(VideoChat.ActiveUser.Username);
        VideoChat.CurrentRoomName = VideoChat.ActiveUser.Username;

        //        easyrtc.initMediaSource(
        //            function () { // success callback
        //                $("#streamerVideo").addClass("hidden");
        //                $("#streamerVideo").removeClass("mainVideo");

        //                $("#selfVideo").removeClass("hidden");
        //                $("#selfVideo").addClass("mainVideo");

        //                easyrtc.setVideoObjectSrc(document.getElementById("selfVideo"), easyrtc.getLocalStream());
        //                console.log("<---------- ConnectStreamer 1");
        //                easyrtc.connect("VideoChatDemo", VideoChat.HTML_LoginSuccess, VideoChat.HTML_LoginFailure);
        //                console.log("<---------- ConnectStreamer 2");
        //            },
        //            VideoChat.HTML_LoginFailure
        //        );

        connection.extra.roomOwner = true;
        connection.open(udata+''+connection.publicRoomIdentifier, function (isRoomOpened, roomid, error) {
            if (error) {
                if (error === connection.errors.ROOM_NOT_AVAILABLE) {
                    alert('Someone already created this room. Please either join or create a separate room.');
                    return;
                }

            }

            VideoChat.HTML_LoginSuccess(roomid);

            connection.socket.on('disconnect', function () {
                location.reload();
            });
        });




    },

    ConnectUser: function () {
        console.log("<---------- ConnectUser");

        easyrtc.enableAudio(false);
        easyrtc.enableVideo(false);
        //easyrtc.setVideoDims(1280,720);
        easyrtc.connect("VideoChatDemo", VideoChat.HTML_LoginSuccess, VideoChat.HTML_LoginFailure);
    },

    ConnectUserForPrivateChat: function () {
        console.log("<---------- ConnectUserForPrivateChat");
        console.log(VideoChat.PrivateChatMode);
      
       // easyrtc.joinRoom(VideoChat.CurrentRoomName);
      
      
        if (VideoChat.PrivateChatMode === 2) {
            //private chat mode

            // show member video and connect to model
//            easyrtc.setVideoObjectSrc(document.getElementById("selfVideo"), easyrtc.getLocalStream());
//            easyrtc.connect("VideoChatDemo", VideoChat.HTML_LoginSuccess, VideoChat.HTML_LoginFailure);

//            forcefullyleft = true;
//            connection.leave();
//            connection.dontCaptureUserMedia = false;
//            connection.join(VideoChat.CurrentRoomName);


            navigator.mediaDevices.getUserMedia({
                      audio: true,
                      video: true
            }).then(function(stream) {
                // third step
                stream.isVideo = true;
              //  connection.attachStreams.push(stream);
                });

            connection.addStream({
    audio: true,
    video: true 
});

    
 



            //update user cpm displayed
            $("a.cpm").html("&nbsp;CPM: " + VideoChat.model.perMin);
            //init private billing
            VideoChat.StartBilling('show');

        } else if (VideoChat.PrivateChatMode === 1) {
            
            $("#messages").hide();
            $(".requestPrivateChat").hide();
            //spectator mode
//            easyrtc.enableAudio(false);
//            easyrtc.enableVideo(false);
//            easyrtc.enableAudioReceive(false); // block audio receiving for spectators
//            easyrtc.connect("VideoChatDemo", VideoChat.HTML_LoginSuccess, VideoChat.HTML_LoginFailure);

            
            //update user cpm displayed
            $("a.cpm").html("&nbsp;CPM: " + VideoChat.model.scpm);
            //init spectator billing
            VideoChat.StartBilling('spectator');

        } else if (VideoChat.PrivateChatMode === 3) {
            //admin mode
//            easyrtc.enableAudio(false);
//            easyrtc.enableVideo(false);
//            //easyrtc.enableAudioReceive(false); // block audio receiving for spectators
//            easyrtc.connect("VideoChatDemo", VideoChat.HTML_LoginSuccess, VideoChat.HTML_LoginFailure);

        }
    },

    JoinPrivatChatAsViewr: function () {
        console.log("<---------- JoinPrivatChatAsViewr");
       // easyrtc.disconnect();
       VideoChat.CloseNotification();
       $("#streamerVideo").show();
       $("#streamerVideo").get(0).play();
        VideoChat.PrivateChatMode = 1;
        setTimeout(function () { VideoChat.ConnectUserForPrivateChat(); }, 2000);
    },

    JoinPrivatChatAsAdmin: function () {
        console.log("<---------- JoinPrivatChatAdmin");
        easyrtc.disconnect();
        VideoChat.PrivateChatMode = 3;
        setTimeout(function () { VideoChat.ConnectUserForPrivateChat(); }, 2000);
    },

    UpdateStreamerStatus: function (value) 
    {
        console.log("<---------- UpdateStreamerStatus");
        console.log(value);
        if (value === 0) {
            console.log("<---------- Stop billing");
            clearInterval(VideoChat.timeOutID);
        }
        if (value === 2) 
        {
            VideoChat.IsPrivateChat = true;
            if (VideoChat.PrivateChatMode === 0) 
            {
                if (VideoChat.ActiveUser) 
                {
                    if (VideoChat.ActiveUser.tokens > VideoChat.model.scpm) 
                    {
                        $("#streamerVideo").hide();
                        $("#streamerVideo").get(0).pause();
                        $(".requestPrivateChat").hide();
                        $("#messages").hide();

                        VideoChat.HTML_NotificationOneButton("<b>" + getFullName(VideoChat.Streamer) + "</b> is in a private chat!",
                        "You can join the chat as a spectator for " + VideoChat.model.scpm + " Tokens per minute.",
                        "JOIN", "#", "VideoChat.JoinPrivatChatAsViewr();", true, true);

                    } else {
                        var from = 'Me';
                        var msg = 'Cant start private chat';
                        VideoChat.HTML_NotificationOneButton("Spectator Chat Request", "You don't have enough tokens to join the chat as a spectator!", "OK", "login_member.php", "VideoChat.LogOut();", true, true);
                        return;
                    }
                } else {
                        $(".requestPrivateChat").hide();
                        $("#messages").hide();
                        $("#streamerVideo").hide();
                        $("#streamerVideo").get(0).pause();
                    VideoChat.HTML_NotificationOneButton("<b>" + getFullName(VideoChat.Streamer) + "</b> is in a private chat!",
                        "You can join the chat as a spectator for " + VideoChat.model.scpm + " Tokens per minute.<br/>To do so, you need to register an account and login.",
                        "REGISTER", "registration/user.php", "VideoChat.LogOut();", true, true);
                }

            } 
            else {
//                if (easyrtc.getConnectStatus(VideoChat.Streamer) == easyrtc.NOT_CONNECTED) 
//                {
//                    console.log("Calling " + easyrtc.idToName(VideoChat.Streamer) + " private mode");
//                    easyrtc.call(VideoChat.Streamer, VideoChat.HTML_CallSuccess, VideoChat.HTML_CallFailure);
//                }
            }
        }
         else 
        {
         $("#streamerVideo").show();

            // check if user is connected to chat and join if not connected
        //            if (easyrtc.getConnectStatus(VideoChat.Streamer) == easyrtc.NOT_CONNECTED) {
        //                VideoChat.IsPrivateChat = false;
        //                console.log(VideoChat.PrivateChatMode + "<---------- PrivateChatMode");
        //                console.log("Calling " + easyrtc.idToName(VideoChat.Streamer) + " non-private mode");
        //                easyrtc.call(VideoChat.Streamer, VideoChat.HTML_CallSuccess, VideoChat.HTML_CallFailure);
        //            }
        }
    },
    /* Tasks */

    ToggleUsers: function () {
        if ($(".chatWindow").hasClass("showUsers")) {
            $(".chatWindow").removeClass("showUsers");
        } else {
            $(".chatWindow").addClass("showUsers");
        }
    },

    ToggleChat: function () {
        if ($(".col-sm").css('display') == 'none') {
            $(".col-sm").css('display', 'block');
            //$(".col-lg").css("width", "75%");
        } else if ($(".col-sm").css('display') == 'block') {
            $(".col-sm").css('display', 'none');
            //$(".col-lg").css("width", "100%");
        }
    },

    ToggleSelfVideo: function () {
        $("#selfVideo").toggleClass("hidden");
    },

    ToggleModelSelfVideo: function () {
        $("#streamerVideo").toggleClass("hidden");
        $("#streamerVideo").toggleClass("mainVideo");

        //$("#selfVideo").removeClass("hidden");
        $("#selfVideo").toggleClass("mainVideo");
    },

    SelectUser: function (id) {
        console.log("<---------- SelectUser");
        if (VideoChat.SelectedUserId === id) {
            VideoChat.SelectedUserId = null;
            $("#users li[user-id=" + id + "]").removeClass("selected");
        } else {
            VideoChat.SelectedUserId = id;
            $("#users li").removeClass("selected");
            $("#users li[user-id=" + id + "]").addClass("selected");
        }
    },

    KickUser: function (id) {
        var notf = "<div class=\"request\" style=\"color:black\">";
        notf += "<h2>Suspend User!</h2>";
        notf += "<p>Please select the amount of time you want the user suspended:</p>";
        notf += "<select id=\"kickTime\" name=\"kickTime\"><option value=\"1\">1 hr</option><option value=\"2\">2 hrs</option><option value=\"5\">Forever</option></select>";
        notf += "<a href=\"#\" onclick=\"VideoChat.KickUserConfirm('" + id + "');\">Suspend</a>";
        notf += "<a href=\"#\" onclick=\"VideoChat.CloseNotification();\">Cancel</a>";
        notf += "</div>";
        $(".videoContainer").append(notf);
        //VideoChat.HTML_NotificationOneButton("Kick User", "Do you want to kick this user?", "Kick", null, "VideoChat.KickUserConfirm('" + id + "');", true);
    },

    KickUserConfirm: function (id) {
        //send data to php

        var member = getFullName(id);
        var kickTime = $("#kickTime").val();
        if (VideoChat.ActiveUser.IsStreamer) {
            var model = VideoChat.ActiveUser.Username;
        }

        var data = { member: member, model: model, kickTime: kickTime };


        if (member.indexOf("guest.") !== -1) {
            var hash = member.substring(6);
            //console.log(hash);
            data = { member: member, model: model, kickTime: kickTime, hash: hash };
        }

        VideoChat.Ajax('/suspend_user.php', 'POST', data, 'json', 'kick');

        //other js stuff
        VideoChat.CloseNotification();
        var dest = {};
        if (VideoChat.CurrentRoomName) {
            dest.targetRoom = VideoChat.CurrentRoomName;
        }
        dest.targetEasyrtcid = id;
        if (kickTime != 5) {
            connection.send({leaveMyRoom:true, remoteUserId:id, msg:"You have been kicked from room by " + model + ""});
             
           // VideoChat.SendCustomMessage(dest, "kick", "You have been kicked from room by &nbsp; " + model + "");
        } else {
            connection.send({leaveMyRoom:true, remoteUserId:id, msg:"You have been kicked from room by " + model + ""});
            //VideoChat.SendCustomMessage(dest, "kick", "You have been banned from this chatroom by " + model + " .");
        }
        
        setTimeout(function(){
        
        
        connection.onUserStatusChanged();
        
        },4000);
        //easyrtc.hangup(id);
    },

    SendMessage: function () {
        console.log("<---------- SendMessage");

        //check both inputt boxes
        $('.inputarea').html('');

        var msg_input = $("#messageText");
        var tokenss = $("#tockencount").val();



        if (msg_input.val() != "") {
            var text = msg_input.val();
                console.log("commented");
            //sendmessagesdb(text);
        } else if (msg_input.val() == "") {

            msg_input = $("#messageText1");
            var text = msg_input.val();
        }

        if (text.replace(/\s/g, "").length === 0) { // Don't send just whitespace
            return;
        }
        if (VideoChat.ActiveUser === null) { // Guest trying to send a message
            VideoChat.HTML_NotificationOneButton("Function not available!", "To use the chat and other features, please REGISTER and become a member.", "REGISTER", "/registration/user.php", null, true);
            return;
        }
        if (VideoChat.IsPrivateChat && VideoChat.PrivateChatMode !== 2) {
            VideoChat.HTML_NotificationOneButton("Function not available!", "You can't send messages as a SPECTATOR.", "OK", "#");
            return;
        }

        var dest;

        if (this.CurrentRoomName || this.ChatGroup) 
        {
            dest = {};
            if (this.CurrentRoomName) {
                dest.targetRoom = this.CurrentRoomName;
            }
            if (this.ChatGroup) {
                dest.targetGroup = this.ChatGroup;
            }
            if (this.SelectedUserId) {
                dest.targetEasyrtcid = this.SelectedUserId;
            } else if (this.IsPrivateChat && VideoChat.PrivateChatMode === 2) {
                var ids = easyrtc.usernameToIds(VideoChat.CurrentRoomName, VideoChat.CurrentRoomName);
                if (ids.length > 0) {
                    dest.targetEasyrtcid = ids[0].easyrtcid;
                } else {
                    return;
                }
            }
        } else {
            easyrtc.showError("user error", "no destination selected");
            return;
        }

//        easyrtc.sendDataWS(dest, "msg", text, function (reply) {
//            if (reply.msgType === "error") {
//                easyrtc.showError(reply.msgData.errorCode, reply.msgData.errorText);
//            }
//        });


    var chatMessage = text;
    if (!chatMessage || !chatMessage.replace(/ /g, '').length) return;

    var checkmark_id = connection.userid + connection.token();
    
    

    connection.send({
        chatMessage: chatMessage,
        type:"msg",
        checkmark_id: checkmark_id
    });
    this.HTML_AddToConversation("Me", "msg", text, "");
        //$("#messageText").val("");
        msg_input.val("");
    },

    SendMessageOnEnter: function (e) {

        console.log("<---------- SendMessageOnEnter");
        if (e.keyCode === 13) {
            VideoChat.SendMessage();
        }
    },

    SendCustomMessage: function (to, type, message) {
        

    var chatMessage = message;

    if(type != "satus_pc")
    if (!chatMessage || !chatMessage.replace(/ /g, '').length) return;
    
    
    var checkmark_id = connection.userid + connection.token();
    
    console.log("<---------- SendCustomMessage"+to+"---"+type+"----"+chatMessage);
    connection.send({
        chatMessage: chatMessage,
        to: to,
        from: connection.userid,
        type: type,
        checkmark_id: checkmark_id
    });




//    this.HTML_AddToConversation("Me", "msg", text, "");
//        //$("#messageText").val("");
//        msg_input.val("");
//    },

       
//        easyrtc.sendDataWS(to, type, message, function (reply) {
//            if (reply.msgType === "error") {
//                easyrtc.showError(reply.msgData.errorCode, reply.msgData.errorText);
//            }
//        });



    },

    RequestPrivateChat: function () {
        console.log("<---------- RequestPrivateChat");
        if (VideoChat.ActiveUser === null) { // Guest trying to send a message
            VideoChat.HTML_NotificationOneButton("Function not available!", "To use the chat and other features, please REGISTER and become a member.", "REGISTER", "/registration/user.php", null, true);
            return;
        }

        if (VideoChat.ActiveUser.tokens < VideoChat.model.perMin) {
            var from = 'Me';
            var msg = 'Cant start private chat';
            VideoChat.HTML_NotificationOneButton("Private Chat Request", "You don't have enough credits for a private chat!<p><a class=\"btn btn-primary\" href=\"cp/chatusers/buyminutes.php\">Get Tokens!</a></p>", "", null, "VideoChat.RejectPrivateChat('" + fromid + ", " + msg + "')", false, true);
            return;
        }
        var dest = {};
        if (VideoChat.ActiveUser && VideoChat.CurrentRoomName && VideoChat.Streamer) {
            dest.targetRoom = VideoChat.CurrentRoomName;
            dest.targetEasyrtcid = VideoChat.Streamer;

            //private chat mode
//            easyrtc.enableAudio(true);
//            easyrtc.enableVideo(true);
            //easyrtc.setVideoDims(1280,720); // hd video

            VideoChat.SendCustomMessage(VideoChat.Streamer, "req_pc", "Request for private chat!");
            // request mic / cam access, on success request chat with model
//            easyrtc.initMediaSource(
//                        function () { VideoChat.SendCustomMessage(dest, "req_pc", "Request for private chat!"); },
//                        VideoChat.PrivateChatFailure
//                    );
        }
    },
    AcceptPrivateChat: function (fromid) {
        //accpeted();
        console.log("<---------- AcceptPrivateChat");

        VideoAcceptRequest();

        VideoChat.CloseNotification();

        var dest = {};
        if (VideoChat.CurrentRoomName) {
            dest.targetRoom = VideoChat.CurrentRoomName;
        }
        //dest.targetEasyrtcid = fromid;

      //  easyrtc.hangupAll();

         
           
      connection.send({Refresh:true, pcchatid:fromid});
            


        VideoChat.PrivateChatMode = 2;
        VideoChat.PendingPrivateChatRequest = null;

        VideoChat.HTML_NotificationOneButton("Private Chat!", "Waiting for user...", "OK", "#", null);
        VideoChat.SendCustomMessage(fromid, "req_pc_acc", "Request for private chat ACCEPTED");





    },

    RejectPrivateChat: function (fromid, msg_default) {

        console.log("<---------- RejectPrivateChat");
        if (typeof msg_default === null || typeof msg_default === undefined) {
            msg_default = "Sorry! Your request for a private chat was REJECTED!";
        }
        msg_default = "Sorry! Your request for a private chat was REJECTED!";
        var dest = {};
        if (VideoChat.CurrentRoomName) {
            dest.targetRoom = VideoChat.CurrentRoomName;
        }
        //dest.targetEasyrtcid = id;

        VideoChat.PendingPrivateChatRequest = null;
        VideoChat.SendCustomMessage(fromid, "req_pc_rej", msg_default);
        VideoChat.CloseNotification();
    },

    EndPrivateChat: function () {
        VideoRejectRequest();
        // stop showing video to selected user
        //easyrtc.hangup(VideoChat.SelectedUserId);

document.getElementById("streamerVideo").srcObject = document.getElementById("selfVideo").srcObject;
document.getElementById("selfVideo").srcObject = null;

$("#selfVideo").addClass("hidden");
$("#selfVideo").removeClass("mainVideo");
VideoChat.PrivateChatMode=0;
connection.leave();
VideoChat.HTML_Setup_ChatRoomStreamer();
        
//        if (VideoChat.ActiveUser) {
//            // clear media stream for user
//            easyrtc.clearMediaStream(document.getElementById('selfVideo'));
//        }

    },

    GiveTip: function () {
        if (VideoChat.ActiveUser === null) { // Guest trying to send a message
            VideoChat.HTML_NotificationOneButton("Function not available!", "To use the chat and other features, please REGISTER and become a member.", "REGISTER", "/registration/user.php", null, true);
            return;
        } else {
            var notf = "<div class=\"request\">";
            notf += "<h2>Give a tip!</h2>";
            notf += "<p>Please enter the amount of tokens you want to TIP</p>";
            notf += "<input id=\"tipAmount\" type=\"number\" value=\"5\" min=\"1\" max=\"1000\"/>";
            notf += "<a href=\"#\" onclick=\"VideoChat.SendTip();\">TIP</a>";
            notf += "<a href=\"#\" onclick=\"VideoChat.CloseNotification();\">Cancel</a>";
            notf += "</div>";
            $(".videoContainer").append(notf);
        }
    },

    SendTip: function () {
        var tip = $("#tipAmount").val();
        if (VideoChat.ActiveUser.tokens < tip) {
            var from = 'Me';
            var msg = 'Cant tip';
            VideoChat.HTML_NotificationOneButton("Tipping failed", "You don't have enough tokens to send a $" + tip + " tip!", "OK", null);
            //return;
        } else {
            var dest = {};
            if (VideoChat.CurrentRoomName) {
                dest.targetRoom = VideoChat.CurrentRoomName;
            }
            VideoChat.SendCustomMessage(dest, "tip", $("#tipAmount").val());
            VideoChat.updateTokens('tip', $("#tipAmount").val());
            this.HTML_AddToConversation("You", "tip", $("#tipAmount").val(), dest);
            VideoChat.CloseNotification();
        }
    },

    /* Notifications */

    CloseNotification: function () {
        console.log("<---------- CloseNotification");
        var length = $(".request").length;
        if (length > 0) {
            $(".request").eq(length - 1).remove();
        }
        clearInterval(VideoChat.CountdownTimeOutID);
    },

    HTML_NotificationOneButton: function (title, message, buttonText, linkToRedirect, callback, showCancelButton, exitChatOnCancel, cancelButtontext, cancelCallback) {
        $(".request").remove();

        var notf = "<div class=\"request\">";
        notf += "<h2>" + title + "</h2>";
        notf += "<p>" + message + "</p>";

        if (buttonText) {
            // time till function executes
            VideoChat.Countdown = 5;
            if (buttonText == "OK" || buttonText == "Ok" && !VideoChat.ActiveUser.IsStreamer) {
                var text = buttonText + " (" + VideoChat.Countdown + ")";
            } else {
                var text = buttonText;
            }
            notf += "<a href=\"" + (linkToRedirect ? linkToRedirect : "#") + "\" onclick=\"" + (callback ? callback : "VideoChat.CloseNotification();") + "\">" + text + "</a>";
            if (showCancelButton === true) {
                notf += "<a href=\"#\" onclick=\"" + (exitChatOnCancel ? "VideoChat.ExitChatRoom();" : (cancelCallback ? cancelCallback : "VideoChat.CloseNotification();")) + "\">" + (cancelButtontext ? cancelButtontext : "Cancel") + "</a>";
            }
        }

        notf += "</div>";
        $(".videoContainer").append(notf);

        function notifyTimer() {

            VideoChat.Countdown--;
            var firstAnchor = $(".request a").first();
            firstAnchor.text(buttonText + " (" + VideoChat.Countdown + ")");
            if (VideoChat.Countdown == 0) {
                clearInterval(VideoChat.CountdownTimeOutID);
                if (callback) {
                    // run callback
                    callback();
                } else {
                    // close notification
                    VideoChat.CloseNotification();
                }

            }

        }

        if (buttonText == "OK" || buttonText == "Ok" && !VideoChat.ActiveUser.IsStreamer) {
            VideoChat.CountdownTimeOutID = setInterval(notifyTimer, 1000);
        }


    },

    /* Video Options */
    ToggleMicro: function () {


      connection.getUserMedia((e) => {
        e.getAudioTracks()[0].enabled = !e.getAudioTracks()[0].enabled;

       
        if (VideoChat.micEnabled) {
           
            VideoChat.micEnabled = false;
            $(".mic").css("color", "#FF0000");
        } else {
            
            VideoChat.micEnabled = true;
            $(".mic").css("color", "#FFFFFF");
        }

      });
        


        
    },

    ToggleCam: function () {


     connection.getUserMedia((e) => {
        console.log({ e });
        e.getVideoTracks()[0].enabled = !e.getVideoTracks()[0].enabled;
        if (e.getVideoTracks()[0].enabled) {
             VideoChat.camEnabled = false;
            $(".cam").css("color", "#FF0000");

        } else {
          VideoChat.camEnabled = true;
            $(".cam").css("color", "#FFFFFF");
        }
      });
         
       
    },

    ToggleMute: function () {
        var mute = $(".mainVideo").prop('muted');
        if (mute) {
            $(".mainVideo").prop('muted', false);
            $(".mute").css("color", "#FFF");
        } else {
            $("video").prop('muted', true);
            $(".mute").css("color", "#ed1616");
        }
    },

    ToggleVolume: function () {
        var mute = $(".mainVideo").prop('muted');
        if (mute) {
            $(".mainVideo").prop('muted', false);
            $(".volume i").removeClass().addClass('fa fa-volume-up fa-lg');
        } else {
            $(".mainVideo").prop('muted', true);
            $(".volume i").removeClass().addClass('fa fa-volume-down fa-lg');
        }
    },

    TogglePlay: function () {
        var paused = $("#streamerVideo").get(0).paused;
        if (paused) {
           $("#streamerVideo").get(0).play();
            $(".play i").removeClass().addClass('fa fa-pause fa-lg');
        } else {
             $("#streamerVideo").get(0).pause();
            $(".play i").removeClass().addClass('fa fa-play fa-lg');
        }
    },

    ToggleFullScreen: function () {
        var elem = document.getElementsByClassName("mainVideo")[0];
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) {
            elem.webkitRequestFullscreen();
        }
    },
    ExitChatRoom: function () {
        if (VideoChat.ActiveUser && VideoChat.ActiveUser.IsStreamer) {
            VideoChat.HTML_NotificationOneButton("Exit Chat Room!", "Are you sure you want to exit this chat room.", "EXIT", "/cp/chatmodels/index.php", null, true);
        } else {
            var model = VideoChat.CurrentRoomName;
            VideoChat.HTML_NotificationOneButton("Exit Chat Room!", "Are you sure you want to exit this chat room.", "EXIT", "index.php", null, true);
            ///$(".vdchat-overlay").addClass("hidden");
        }
    },

    /* HTML Generator */

    HTML_SetupMenu: function () {
        var html = "<div class=\"slide-bar\">";
        html += "<ul>";
        html += "<li class=\"active\"><a class=\"loc\" href=\"/\">Home</a></li>";
        html += "<li><a class=\"partner\" href=\"/livechatrooms.html\">Live Chats</a></li>";
        if (VideoChat.ActiveUser && VideoChat.ActiveUser.IsStreamer) { // Show Menu option just for Streamers // EXAMPLE
            html += "<li><a class=\"wts-new start-stream\" href=\"/chatroom_user.html\" >Stream</a></li>";
        }
        html += "</ul>";
        html += "</div>";
        $(".slide-bar").remove();
        $("#main").append(html);
    },

    HTML_UpdateInterface: function () {
        if (VideoChat.MyChatId) {
            $(".noLogIn").addClass("hidden");
            $(".room").removeClass("hidden");

            $(".login").addClass("hidden");
            $(".loginData").removeClass("hidden");
            $(".loginData .activeUser").html(getFullName(VideoChat.MyChatId));

            $(".mic").addClass("hidden");
            $(".cam").addClass("hidden");

            var mute = $(".mainVideo").prop('muted');
            if (mute) {
                $(".mute").css("color", "#ed1616");
            } else {
                $(".mute").css("color", "#FFF");
            }

            if (VideoChat.PrivateChatMode === 2) {
                $(".endPrivateChat").removeClass("hidden");
                $(".mute").removeClass("hidden");
                $(".selfvd").removeClass("hidden");
            } else {
                $(".mainVideo").prop('muted',true);
                $(".endPrivateChat").addClass("hidden");
                 $(".mute").addClass("hidden");
                $(".selfvd").addClass("hidden");
            }


            if (VideoChat.ActiveUser && VideoChat.ActiveUser.IsStreamer) {
                $(".mic").removeClass("hidden");
                $(".cam").removeClass("hidden");

                if (VideoChat.PrivateChatMode === 0) {
                    $(".mute").addClass("disabled");
                    $(".mute").css("color", "#ed1616");
                    $("#selfVideo").prop('muted', true);
                } else {
                    $(".mute").removeClass("disabled");
                    $("#selfVideo").prop('muted', true);
                }


                $(".requestPrivateChat").addClass("hidden");
                $(".tip").addClass("hidden");
            } else {
                if (VideoChat.IsPrivateChat || VideoChat.PrivateChatMode === 2) {
                    $(".mic").removeClass("hidden");
                    $(".cam").removeClass("hidden");
                    $(".requestPrivateChat").addClass("hidden");
                } else {

                    //hide private request and tip if not enough money
                    /* if( !isNaN(VideoChat.ActiveUser.tokens) && VideoChat.ActiveUser.tokens <= VideoChat.model.perMin){
                    $(".requestPrivateChat").addClass("hidden");
                    $(".tip").addClass("hidden");
                    }else{*/
                    $(".requestPrivateChat").removeClass("hidden");
                    $(".tip").removeClass("hidden");
                    //}
                }
            }

        } else {
            $(".room").addClass("hidden");
            $(".noLogIn").removeClass("hidden");

            $(".login").removeClass("hidden");
            $(".loginData .activeUser").html("None");
            $(".loginData").addClass("hidden");
        }

        VideoChat.HTML_SetupMenu();
    },
    HTML_Custom_Changes: function () {

        //Lets style the video chat... 
        $(".vdchat-overlay").addClass("m-t-xxl");
    },
    HTML_Setup_ChatRoomUser: function () {
        console.log("<---------- HTML_Setup_ChatRoomUser");
        VideoChat.CurrentPage = 2;
        var room = GetQueryParameterByName("model"); // Get The room from the queryString LINK?room=Jasmin

        if (room) {
            var streamer = VideoChat.model = GetStreamerByName(room); // Is the room a valid room (is there a streamer with that username)
            if (streamer) {
                console.log(streamer);
  
                 $("#streamerVideo").attr("poster", streamer.ImageUrl); 
 

//                easyrtc.joinRoom(room);
                 VideoChat.CurrentRoomName = room;
//                this.ConnectUser();
//                console.log("joined");
  
                   connection.dontCaptureUserMedia = true;
                   connection.join(room+''+connection.publicRoomIdentifier,function(isRoomJoined, roomid, error) {
                        
                        $("#streamerVideo").hide();
                        //$("#streamerVideo").get(0).pause();


                    setTimeout(function(){
                     VideoChat.SendCustomMessage("", "satus_pc_req", "dummy");
                     },3000);
                 
                 
                  });
                    
                 
                    //  VideoChat.HTML_LoginSuccess(room);
                //  VideoChat.HTML_UpdateInterface();

            } else { // NOT A VALID ROOM NAME
                VideoChat.LogOut();
            }
        }
    },

    HTML_Setup_ChatRoomStreamer: function () {
        console.log("<---------- HTML_Setup_ChatRoomStreamer");
        VideoChat.CurrentPage = 3;
        VideoChat.HTML_UpdateInterface();
        this.ConnectStreamer();
    },

    HTML_Setup_ChatRooms: function () {
        console.log("<---------- HTML_Setup_ChatRooms");
        VideoChat.CurrentPage = 1;
        this.ConnectUser();
    },

    /** Events **/

    HTML_LoginSuccess: function (id) {
        console.log("<---------- HTML_LoginSuccess");
        VideoChat.MyChatId = id;
        VideoChat.CurrentRoomUsers = [];
        if (VideoChat.CurrentPage === 1) {
            VideoChat.HTML_SetupRoomList();
        }

        VideoChat.HTML_UpdateInterface();
    }, // Login to the Chat Server, not the site

    PrivateChatFailure: function (errorCode, errorText) {
        console.log('Private chat failed! Code: ' + errorCode + ' Msg: ' + errorText);

        VideoChat.HTML_NotificationOneButton("Webcam Access Failed!", "Please ensure your webcam is working and that permissions to access mic and webcam have been granted!", "Close");

    },

    HTML_LoginFailure: function (errorCode, errorText) {
        console.log("<---------- HTML_LoginFailure" + errorCode + " " + errorText);
    },

    HTML_CallSuccess: function () {
        console.log("<---------- HTML_CallSuccess");
    },

    HTML_CallFailure: function (errorCode, errorText) {
        console.log("<---------- HTML_CallFailure");
    },

    HTML_NewUserInRoom: function (roomName, otherPeople) {

        //console.log("<---------- HTML_NewUserInRoom");
        //var tempUsers = VideoChat.CurrentRoomUsers.slice(0);
        
        //VideoChat.CurrentRoomUsers = [];
        $("#users").html("");

       // console.log(otherPeople);
        var state = 0;
        VideoChat.Streamer = null;
    
         if(!connection.extra.roomOwner) 
            VideoChat.Streamer = getRoomOwnerID();
        else
            VideoChat.Streamer = connection.userid;

    
        otherPeople.forEach(function(pid) {
            easyrtcid = pid;

            if (connection.extra.roomOwner) 
                VideoChat.Streamer = connection.userid;
                
                       
            fname  =  getFullName(easyrtcid);
             

//            $.ajax({
//                url: "rtc/gettocken.php?username=" + fname,
//                type: "GET",
//                data: '',
//                success: function (response) {
//                          
//                    tokenss = response;
//                        if (tokenss != '') {

//                        if (tokenss >= 200) {
//                            color = 'green';
//                        } else if (tokenss >= 100 && tokenss <= 199) {

//                            color = 'purple';

//                        } else if (tokenss >= 50 && tokenss <= 99) {

//                            color = 'magenta';

//                        } else if (tokenss >= 1 && tokenss <= 49) {

//                            color = 'blue';
//                        } else if (tokenss == 0) {
//                            color = 'grey';
//                        } else {
//                            color = 'red';
//                        }


//                    } else {

//                        color = 'red';

//                    }


//                    var html = "<li user-id=\"" + easyrtcid + "\" class=\"" + (VideoChat.PrivateChatMode === 2 && VideoChat.ActiveUser.IsStreamer && VideoChat.SelectedUserId === easyrtcid ? "selected privateChat " : "") + (fname === VideoChat.CurrentRoomName ? "streamerIcon" : "") + "\">";
//                 
//                 
//                 
//                    if ((getFullName(VideoChat.MyChatId) === VideoChat.CurrentRoomName && VideoChat.PrivateChatMode !== 2) || (fname === VideoChat.CurrentRoomName && VideoChat.ActiveUser && VideoChat.PrivateChatMode === 0)) {
//                        html += "<a href=\"#\" style='color:" + color + ";' class=\"chatUser\" onclick=\"return VideoChat.SelectUser('" + easyrtcid + "');\"><i style='color:" + color + ";' class=\"fa fa-user" + (fname !== easyrtcid ? "" : "-secret") + "\" title=\"" + fname + "\"></i> " + fname + "</a>";
//                    } else {
//                        html += "<a href=\"#\" style='color:" + color + ";' style='color:" + color + ";' class=\"chatUser\"><i class=\"fa fa-user" + (fname !== easyrtcid ? "" : "-secret") + "\" title=\"" + fname + "\"></i> " + fname + "</a>";
//                    }

//                    if (getFullName(VideoChat.MyChatId) === VideoChat.CurrentRoomName) {
//                        html += "&nbsp;&nbsp;<a href=\"#\" onclick=\"return VideoChat.KickUser('" + easyrtcid + "');\"><i class=\"fa fa-ban\"></i></a>";
//                    }
//                    html += "</li>";
//                    if (fname === VideoChat.CurrentRoomName) {
//                        $("#users").html(html);
//                    } else {
//                        $("#users").html(html);
//                    }


//                }
//            });
            

                color = "red";
               var html = "<li user-id=\"" + easyrtcid + "\" class=\"" + (VideoChat.PrivateChatMode === 2 && VideoChat.ActiveUser.IsStreamer && VideoChat.SelectedUserId === easyrtcid ? "selected privateChat " : "") + (fname === VideoChat.CurrentRoomName ? "streamerIcon" : "") + "\">";
                 
                 
                 
                    if ((getFullName(VideoChat.MyChatId) === VideoChat.CurrentRoomName && VideoChat.PrivateChatMode !== 2) || (fname === VideoChat.CurrentRoomName && VideoChat.ActiveUser && VideoChat.PrivateChatMode === 0)) {
                        html += "<a href=\"#\" style='color:" + color + ";' class=\"chatUser\" onclick=\"return VideoChat.SelectUser('" + easyrtcid + "');\"><i style='color:" + color + ";' class=\"fa fa-user" + (fname !== easyrtcid ? "" : "-secret") + "\" title=\"" + fname + "\"></i> " + fname + "</a>";
                    } else {
                        html += "<a href=\"#\" style='color:" + color + ";' style='color:" + color + ";' class=\"chatUser\"><i class=\"fa fa-user" + (fname !== easyrtcid ? "" : "-secret") + "\" title=\"" + fname + "\"></i> " + fname + "</a>";
                    }

                    if (getFullName(VideoChat.MyChatId) === VideoChat.CurrentRoomName) {
                        html += "&nbsp;&nbsp;<a href=\"#\" onclick=\"return VideoChat.KickUser('" + easyrtcid + "');\"><i class=\"fa fa-ban\"></i></a>";
                    }
                    html += "</li>";
                    if (fname === VideoChat.CurrentRoomName) {
                        $("#users").prepend(html);
                    } else {
                        $("#users").append(html);
                    }
             
            });


       

       VideoChat.HTML_UpdateInterface();

    },

    HTML_AddToConversation: function (from, type, content, to, fromid) {
        console.log("<---------- HTML_AddToConversation : " + type + content);

        if (type === "msg") { // CHAT MESSAGE
            // content = content.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;"); // Clear Message
            content = content.replace(/\n/g, "<br />");

            if ($("#messages li").length >= VideoChat.MAX_MESSAGES) { // Remove the oldest message if maximum reached
                $("#messages li").first().remove();
            }


            var color;

            var tokenss = '';

             

                    var html = "<li" + (from === "Me" ? " class=\"me\"" : (from === VideoChat.CurrentRoomName) ? " class=\"streamer\"" : "") + ">";
                    html += "<b id='" + color + "' class=\"from\">" + (from === "Me" ? from : from) + "</b>" + (to && VideoChat.PrivateChatMode !== 2 ? "&nbsp;to&nbsp;<b class=\"to\">" + to + "</b>" : "") + "&nbsp;:&nbsp;" + content;
                    html += "</li>";


                    $("#messages").append(html);
                    $("#messages").animate({ scrollTop: $("#messages").height() * VideoChat.MAX_MESSAGES }, "slow"); // scroll to bottom	




        }
        else if (type === "req_pc" && from !== "Me") { // REQUEST FOR PRIVATE CHAT
            get_user_gender(from);
            if (VideoChat.PendingPrivateChatRequest === null) {
                VideoChat.HTML_NotificationOneButton("Private Chat Request", "User <b>" + from + "</b> requests a private chat.", "Accept", null, "VideoChat.AcceptPrivateChat('" + fromid + "')", true, false, "Reject", "VideoChat.RejectPrivateChat('" + fromid + "')");


                VideoChat.PendingPrivateChatRequest = from;
                /* Response that the model got the request */
                var dest = {};
                if (VideoChat.CurrentRoomName) {
                    dest.targetRoom = VideoChat.CurrentRoomName;
                }
                //dest.targetEasyrtcid = fromid;
                VideoChat.SendCustomMessage(fromid, "req_pc_rec", "Your request was received!");
            } else {
                /* There is a request pending */
                var dest = {};
                if (VideoChat.CurrentRoomName) {
                    dest.targetRoom = VideoChat.CurrentRoomName;
                    dest.targetEasyrtcid = from;
                    VideoChat.SendCustomMessage(fromid, "req_pc_full", "A request for the private chat is already pending!");
                }
            }
        }
        else if (type === "req_pc_rec") { // Request for private chat RECIVED
            VideoChat.HTML_NotificationOneButton("Request Status", content, "Ok");
        }
        else if (type === "req_pc_full") { // Request for private chat REJECTED (because there is already one request)
            VideoChat.HTML_NotificationOneButton("Request Status", content, "Ok");
        }
        else if (type === "req_pc_acc") { // Request for private chat ACCEPTED
            VideoChat.HTML_NotificationOneButton("Request Status", content, "Ok");

            VideoChat.PrivateChatMode = 2;
            VideoChat.SelectedUserId = VideoChat.Streamer;
            
            $(".requestPrivateChat").attr("onclick", "").unbind("click");
            $(".requestPrivateChat").click(function(){ return VideoChat.ExitChatRoom(); });
            $(".requestPrivateChat span").text("End Private chat");

          //  easyrtc.disconnect();

            setTimeout(function () { VideoChat.ConnectUserForPrivateChat(); }, 2000);
        }
        else if (type === "req_pc_rej") { // Request for private chat REJECTED
            VideoChat.HTML_NotificationOneButton("Request Status", content, "Ok");
        }
        else if (type === "satus_pc_req") {
            var dest = {};
            if (connection.extra.roomOwner) {
                dest = fromid;
                console.log("satus_pc_req : pc_mode"+VideoChat.PrivateChatMode);
                VideoChat.SendCustomMessage(dest, "satus_pc",  VideoChat.PrivateChatMode.toString());
            }
        }
        else if (type === "satus_pc") {
            VideoChat.UpdateStreamerStatus(parseInt(content));
        }
        else if (type === "kick") {
            connection.leave();
            VideoChat.CurrentRoomName = null;
            setTimeout(function () {
                window.location.href = "index.php";
            }, 5000);
            VideoChat.HTML_NotificationOneButton("Kick!!!", content, "Back to Lobby", "/index.php");
        } else if (type === "tip") {
            /* Create the html for the message */


            if (VideoChat.ActiveUser.IsStreamer == true) {
                console.log('calling lovense');
                var tok = VideoChat.Lovenset;
                console.log(tok);
                //var frm = getFullName(from);
                var amt = parseInt(content);
                //tipping(frm,amt);
                if (tok != null) {
                    lovense.receiveTip(from, amt);
                }
            }
            var html = "<li class=\"system\">";
            html += "<span class='boldit' style='font-weight: 600; color:#e5eb34;'>" + from + " tipped " + content + " tokens</span>";
            html += "</li>";

            /* Add the message to the list */
            $("#messages").append(html);
            $("#messages").animate({ scrollTop: $("#messages").height() * VideoChat.MAX_MESSAGES }, "slow"); // scroll to bottom
        }
    },

    HTML_SetupRoomList: function () {
        console.log("<---------- HTML_SetupRoomList");
        var streamers = document.getElementById("streamers");
        $(streamers).html("");
        easyrtc.getRoomList(
            function (roomList) {
                for (roomName in roomList) {
                    var streamer = GetStreamerByName(roomName);
                    if (streamer) {
                        var html = " <div class=\"col-sm-4\"><div class=\"client-grid\" style=\"background-image:url('" + streamer.ImageUrl + "'); background-size:cover;\">";
                        html += "<a href=\"/chatroom_user.html?room=" + roomName + "\"></a>";
                        html += "<div class=\"desc\">";
                        html += "<h3>";
                        html += "<a href=\"/chatroom_user.html?room=" + roomName + "\">" + roomName + "</a>";
                        html += "</h3><br/>";
                        html += "<p>";
                        html += "<a href=\"/chatroom_user.html?room=" + roomName + "\">Join Live Video Chat</a>";
                        html += "</p>";
                        html += "</div>";
                        html += "</div></div>";
                        $(streamers).append(html);
                    }
                }
            },
        function (errorCode, errorText) {
            easyrtc.showError(errorCode, errorText);
        }
    );
    },

    StartBilling: function (mode) {
        //if( !isNaN(VideoChat.ActiveUser.tokens) && VideoChat.ActiveUser.tokens >= VideoChat.model.perMin){
        console.log("<---------- Billing started");
//        easyrtc.setRoomEntryListener(function (entry, roomName) {
           
            if (mode) {
                //console.log("entering room " + roomName);

                //stop private billing
                clearInterval(VideoChat.timeOutID);

                //update token value every minute
                VideoChat.timeOutID = setInterval(Function("VideoChat.updateTokens('" + mode + "','0');"), 60000);


            }
            else {
                //console.log("leaving room " + roomName);
                clearInterval(VideoChat.timeOutID);
            }
   //     });

    },

    updateTokens: function (mode, cost) {
        //set data to be sent to php page

        var post = { member: VideoChat.ActiveUser.Username, ptype: mode, cpm: VideoChat.model.perMin, model: VideoChat.model.Username, amount: cost, sessionstring: VideoChat.Session };
        var suspend = null;
        //post data via ajax to update token balance
        VideoChat.Ajax('videochat_billing.php', 'POST', post, 'json', suspend);

    },

    Ajax: function (url, method, data, datatype, suspend) {

        //jquery ajax object
        $.ajax({
            url: url,
            type: method,
            data: data,
            dataType: datatype,
            cache: false,
            success: function (response) {

                if (suspend == null) {
                    console.log(response);
                    //update user display
                    VideoChat.updateTokensHTML(response);
                    //save session
                    VideoChat.Session = response.session;
                }
            },
            error: function (response) {
                console.log(response);
            }
        });
    },

    updateTokensHTML: function (Response) {
        //update html
        if (Response.bill_status == 'success' && Response.bal != 0) {
            console.log(" updating balance");
            //update user token balance displayed
            $("a.bal i").html(Response.bal);

        } else if (Response.bill_status == 'success' && Response.bal == 0) {
            //log error 
            console.log(" Not enough money in your account! Please add money");
            VideoChat.ActiveUser.tokens = 0;
            $("a.bal i").html(Response.bal);
            // check if user is in private chat or not...
            if (VideoChat.PrivateChatMode == 0) {
                VideoChat.HTML_NotificationOneButton("Zero Balance!", "Your account is now empty! Please add money.", "OK", null);
                var modelname = VideoChat.ActiveUser.Username;
                var usersname = VideoChat.model.Username;
                setTimeout(function () {
                    var post_data = {
                        'modelname': modelname,
                        'useramme': usersname
                    };
                    $.ajax({
                        type: "POST",
                        url: "token_message.php",
                        data: post_data,
                        success: function (data) {
                        }
                    });
                }, 3000);
            } else {
                VideoChat.HTML_NotificationOneButton("Zero Balance!", "Your account is now empty! Please add money.", "OK", null, "VideoChat.EndPrivateChat()", false, true);
                // refresh if user doesn't click
                var modelname = VideoChat.model.Username;
                var usersname = VideoChat.ActiveUser.Username;
                setTimeout(function () {
                    var post_data = {
                        'modelname': modelname,
                        'useramme': usersname
                    };
                    $.ajax({
                        type: "POST",
                        url: "token_message.php",
                        data: post_data,
                        success: function (data) {
                            //alert(data);
                            window.location.href = "cp/chatusers/buyminutes.php";
                        }
                    });
                }, 3000);
            }



        } else if (Response.bill_status == 'acc_error') {
            // check if user is in private chat or not...
            if (VideoChat.PrivateChatMode == 0) {
                VideoChat.HTML_NotificationOneButton("Low Balance!", Response.msg, "OK", null);
            } else {
                VideoChat.HTML_NotificationOneButton("Low Balance!", Response.msg, "OK", null, "VideoChat.EndPrivateChat()", false, true);
                // refresh if user doesn't click
                window.location.reload(5);
            }

        } else if (Response.bill_status == 'error') {
            VideoChat.LogOut();
            //log error
            console.log(" An error occured while processing your data!");
            VideoChat.HTML_NotificationOneButton("Error!", "An error occurred while processing request.", "OK", null);
        }

    }
};

function VideoAcceptRequest() {
    input_data = "accept";
    //alert(input_data);
    var post_data = {
        'action': input_data
    };
    $.ajax({
        type: "POST",
        url: "cp/chatmodels/button_action.php",
        data: post_data,
        success: function (data) {
        }
    });
}

function VideoRejectRequest() {
    input_data = "close_chat";
    //alert(input_data);
    var post_data = {
        'action': input_data
    };
    $.ajax({
        type: "POST",
        url: "cp/chatmodels/button_action.php",
        data: post_data,
        success: function (data) {
        }
    });
}
function sendmessagesdb(getmessages) {
    var members = VideoChat.ActiveUser.Username;
    var performers = VideoChat.model.Username;

    var post_data = {
        'get_messages': getmessages,
        'members': members,
        'performers': performers
    };
    $.ajax({
        type: "POST",
        url: "send_messages.php",
        data: post_data,
        success: function (data) {
        }
    });
}
function get_user_gender(get_userss) {
    var post_data = {
        'get_username': get_userss
    };
    $.ajax({
        type: "POST",
        url: "get_usser_gender.php",
        data: post_data,
        success: function (data) {
            $(".request a").addClass(data);
        }
    });
}


function getFullName(userid) {
    var _userFullName = userid;
  
    if(connection.peers[userid]==undefined)
    return _userFullName;
    if(connection.peers[userid].extra==undefined)
    return _userFullName;

    if (connection.peers[userid] && connection.peers[userid].extra.userFullName) {
        _userFullName = connection.peers[userid].extra.userFullName;
    }
    return _userFullName;
}

function getRoomOwnerID()
{
    var _roomownerid;
   connection.peers.forEach(function(peer){
    if(peer.extra.roomOwner)
       _roomownerid=  peer.userid;
    });

    return _roomownerid;

}
function appendChatMessage(event, checkmark_id) {

    from = event.extra.userFullName;
    fromid = event.data.from;
    type= event.data.type;
    content = event.data.chatMessage;
    to=event.data.to;

    if(type=="msg" || type=="tip" || type=="satus_pc_req")
   {
    VideoChat.HTML_AddToConversation(from,type,content,to,fromid);
   }
   else
    {
        if(to==connection.userid)
        VideoChat.HTML_AddToConversation(from,type,content, to, fromid);

    }
   

}


$(document).ready(function () {
    console.log("document ready");


    VideoChat.Init();

    if (udata == '') {
        VideoChat.LogInAsGuest();

    } else {

        VideoChat.LogIn(udata, udata);
    }
});
