"use strict";

function toggleChatRobot() {
  document.getElementById('chat-robot-frame').classList.toggle('active');			
}

// var starter = document.createElement('img');
// starter.id = 'chat-robot-start';
// starter.classList.add('active');
// starter.src = "https://www.bonelliempreendimentos.com.br/chat/images/chat-robot.png";
// starter.onclick = toggleChatRobot;

var chat = document.createElement('div');
chat.id = "chat-robot-frame";

var iframe = document.createElement('iframe');
iframe.id = "chat-robot";
iframe.src = "https://www.bonelliempreendimentos.com.br/chat/chat-single.php";

var closer = document.createElement('img');
closer.src = "https://www.bonelliempreendimentos.com.br/chat/images/close-chat.png";
closer.classList.add('chat-close');
closer.onclick = toggleChatRobot;

var css = document.createElement('link');
css.rel = "stylesheet";
css.type = "text/css";
css.href = "https://www.bonelliempreendimentos.com.br/chat/css/insert-chat.css";

var head = document.getElementsByTagName('HEAD')[0];
head.appendChild(css);
// document.body.appendChild(starter);
document.body.appendChild(chat);
document.getElementById('chat-robot-frame').appendChild(iframe);
document.getElementById('chat-robot-frame').appendChild(closer);
document.getElementById('chat-robot-frame').classList.toggle('');			
