const Pusher = require('pusher');
const express = require('express');
const mongoose = require('mongoose');
const bodyParser = require('body-parser');
const cors = require('cors');
const Mensaje = require('./Mensaje'); // Asegúrate de que la ruta sea correcta

const app = express();
const port = process.env.PORT || 3000;

// Configuración de Pusher
const pusher = new Pusher({
  appId: "1780507",
  key: "06fa0cffb1b0f09fcb94",
  secret: "b321cd6eeee4ea45d3fe",
  cluster: "us2",
  useTLS: true
});

mongoose.connect('mongodb+srv://ema:pollofrito@cluster0.geprfzg.mongodb.net/', { useNewUrlParser: true, useUnifiedTopology: true });

app.use(bodyParser.json());
app.use(cors());

app.get('/buscar', async (req, res) => {
  const { q } = req.query;
  try {
    const resultados = await Mensaje.find({
      $or: [{ mensaje: { $regex: q, $options: 'i' } }, { nombre: { $regex: q, $options: 'i' } }],
    });

    // Emitir los resultados a través de Pusher
    pusher.trigger('chat-development', 'chat-development', {
      mensajes: resultados,
    });

    res.json(resultados);
  } catch (error) {
    res.status(500).send(error);
  }
});

app.listen(port, () => {
  console.log(`http://127.0.0.1:8000/${port}`);
});
