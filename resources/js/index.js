import express from 'express';
import { Server } from 'http';
import { Server as SocketIOServer } from 'socket.io';
import path from 'path';
import { fileURLToPath } from 'url';

const app = express();
const server = new Server(app);
const io = new SocketIOServer(server);

const __dirname = path.dirname(fileURLToPath(import.meta.url));

app.set('port', process.env.PORT || 3000);

//Ejecutamos la función de sockets.js
import socketHandler from './sockets.js'; // Asegúrate de que la ruta sea correcta.

socketHandler(socketio);

//Archivos estáticos
app.use(express.static(path.join(__dirname, '../views/apps/chat')));

//Lanzamos el servidor
server.listen(app.get('port'), () =>{
    console.log("Servidor en el puerto ", app.get('port'));
});
