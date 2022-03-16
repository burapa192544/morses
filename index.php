<html>

<head>
  <style>
    body {

      margin: 0;
      padding: 0;
      background-color: rgb(255, 255, 255);
    }

    nav .topic {
      text-align: center;
      background-color: #9fdfff;

      padding: 10px;

      font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;

      color: #3b3b3b;
    }

    .translator {
      font-size: 30px;
      text-align: center;
    }

    .ip_translator {
      width: 80%;
      font-size: 20px;
    }



    .detail_topic {
      text-align: center;
      background-color: #0baeff;
    }



    .body_chat {
      width: 80%;
      /* font-family: calibri; */
      margin-left: auto;
      margin-right: auto;
      margin-top: 10px;
      background-color: #ffffff;
    }

    .error {
      color: #ff0000;
    }

    .chat-connection-ack {
      font-size: 1px;
      color: #000000;
    }

    .chat-message {
      border-bottom-left-radius: 4px;
      border-bottom-right-radius: 4px;
    }

    #btnSend {
      width: 100%;

      background: #b0efff;
      border: #c9f0ff 1px solid;
      border-radius: 8px;
      color: #fff;
      display: block;
      margin: 15px 0px;
      padding: 10px 50px;
      cursor: pointer;

    }

    #chat-box {
      background: #e7f4fa;
      border: 1px solid #ffffff;
      border-radius: 10px;
      border-bottom-left-radius: 0px;
      border-bottom-right-radius: 0px;
      min-height: 500px;
      padding: 10px;
      overflow: auto;
    }

    .chat-box-html {
      color: rgb(168, 168, 168);
      margin: 10px 0px;
      font-size: 0.8em;
    }

    .chat-box-message {
      color: rgb(0, 0, 0);
      padding: 5px 10px;
      background-color: rgb(255, 255, 255);
      border: 1px solid #ffffff;

      border-radius: 50px;
      display: inline-block;
    }

    .chat-input {
      border: 1px solid #e7f4fa;
      border-top: 0px;
      width: 100%;
      box-sizing: border-box;
      padding: 10px 8px;
      color: #191919;
    }


    #btnSend:hover {
      background-color: #000000;
    }
  </style>
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script>
    function showMessage(messageHTML) {
      $("#chat-box").append(messageHTML);
    }

    $(document).ready(function() {
      var websocket = new WebSocket(
        "ws://localhost:8090/demo/php-socket.php"
      );
      websocket.onopen = function(event) {
        showMessage("<div class='chat-connection-ack'>!connection</div>");
      };
      websocket.onmessage = function(event) {
        var Data = JSON.parse(event.data);
        showMessage(
          "<div class='" + Data.message_type + "'>" + Data.message

          +
          "</div>"
        );
        $("#chat-message").val("");
      };

      websocket.onerror = function(event) {
        showMessage("<div class='error'>ERROR!!</div>");
      };
      websocket.onclose = function(event) {
        showMessage("<div class='chat-connection-ack'>disconnection</div>");
      };

      $("#frmChat").on("submit", function(event) {
        event.preventDefault();
        $("#chat-user").attr("type", "hidden");
        var messageJSON = {
          chat_user: $("#chat-user").val(),
          chat_message: $("#chat-message").val(),
        };
        websocket.send(JSON.stringify(messageJSON));
      });
    });
  </script>
</head>


<body>
  <nav>
    <h1 class="topic">OPEN MORSE</h1>
    <!-- <p class="detail_topic">morse code open chat</p> -->
  </nav>



  <div class="body_chat">
    <form name="frmChat" id="frmChat">
      <div id="chat-box"></div>
      <input type="text" name="chat-user" id="chat-user" placeholder="Name" class="chat-input" required />
      <input type="text" name="chat-message" id="chat-message" placeholder="Message" class="chat-input chat-message" required />
      <input type="submit" id="btnSend" name="send-chat-message bt" value="Send" />
    </form>
  </div>






</body>

</html>