import express from "express";

const app = express();
app.use(express.json());
app.use(express.static("."));

const API_KEY = "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";

app.post("/preguntar", async (req, res) => {
  try {
    const { mensaje } = req.body;

    const response = await fetch("https://openrouter.ai/api/v1/chat/completions", {
      method: "POST",
      headers: {
        "Authorization": `Bearer ${API_KEY}`,
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        model: "openai/gpt-3.5-turbo",
        messages: [
  {
    role: "system",
    content: "Eres un chef experto. Responde siempre con recetas claras, con ingredientes y pasos, debes priorisar dar recetas que sean claras con pasos claros de seguir y con el objetivo de enseñar a cocinar, podrias dar lar recetas en 3 pasos, ingredientes, instruciones de elvaoracion , y explicar el nivel de difucltad, asi como tips de q"
  },
  {
    role: "user",
    content: mensaje
  }
]
      })
    });

    const data = await response.json();

    console.log(data);

    const text = data?.choices?.[0]?.message?.content || "Sin respuesta";

    res.json({ respuesta: text });

  } catch (error) {
    console.error(error);
    res.json({ error: error.message });
  }
});

app.listen(3000, () => {
  console.log("http://localhost:3000");
}); 