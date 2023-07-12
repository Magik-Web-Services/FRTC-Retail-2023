
<script src="https://api.lovense.com/api/cam/model/model.js?mToken=770ccf3d55112a662101f490ca0a1262"></script>

<script> var messageListener = function (data) {
            console.log(data);
            switch (data.type) {
                case "message":
                    if (data.to) {
                        //send private message to the tipper
                        console.error("sending private message to Jack...");
                    } else {
                        //send a message to public chat
                        console.error("sending message to public room...");
                    }
                    break;
                case "tip":
                    //tip has been handled
                    break;
                case "cLink":
                    //send a control link to a tipper
                    console.error("sending cLink to Jack...");
                    break;
                case "toy":
                    //toy status update
                    if (data.status == "on") {
                        //Model at least connected to one toy
                    } else {
                        //Model doesn't have any toy connected
                    }
                    break;
                case "settings":
                    //Model settings
                    break;
            }
        };
        lovense.addMessageListener(messageListener);
        lovense.getSettings();
        lovense.getToys();
lovense.receiveTip('test',7);</script> 